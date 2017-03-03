<?php

namespace App\Http\Controllers;

use App\Client;
use App\Payment;
use Illuminate\Http\Request;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;

class PaymentController extends Controller
{
    private $trip;
    private $client;
    private $driver;
    private $payment;
    private $transaction;
    private $response;

    public function __construct(Request $response)
    {
        $this->response = $response;
    }

    /**
     * Show view of the payment result.
     *
     * @param  App\Http\Requests\Request $response
     * @return Illuminate\Http\Response
     */
    public function trip()
    {
        // Check incoming response url.

        // Response is fresh.
        if ($this->notFresh()) {
            return view('errors.403');
        }

        // If ResNum is not a valid trip_id
        // Revert back money if the state was OK

        $payment = $this->payment = Payment::forceCreate([
                        'trip_id' => $this->response->ResNum,
                        'paid' => false,
                        'type' => 'card',
                        'ref'  => $this->response->RefNum,
                        'detail' => $this->response->all(),
                    ]);

        $this->trip = $this->payment->trip;
        $this->driver = $this->trip->driver;
        $client = $this->client  = $this->trip->client;
        $payment->forceFill(['client_id' => $client->id])->save();
        $transaction = $this->transaction = $this->payment->trip->transaction;
        $response = $this->response;

        if ($this->response->State == 'OK') {
            if (!$repeat = $this->checkRepeat($this->response->transactionAmount)) {
                $amount = $this->checkAmount($this->transaction->total,
                            $this->response->transactionAmount, $payment, $client);
            } else {
                $amount = 0;
            }

            // Successful payment
            return view('payments.result',
                        compact('response', 'payment', 'amount', 'client', 'repeat'));
        } else {
            // Fail payment
            return view('payments.result',
                        compact('response', 'payment', 'client'));
        }
    }

    /**
     * Check paid amount against the trip cost.
     *
     * @param  integer $cost
     * @param  integer $paid
     * @return string
     */
    private function checkAmount($cost, $paid)
    {
        if ($cost > $paid) {
            // Paid less than trip cost.
            // Do not update trip transaction as paid.
            // Add paid amount to the client wallet.
            $this->client->updateBalance($paid);
            // Notify client about the wallet update by FCM
            dispatch(new SendClientNotification('balance_updated', '10', $this->client->device_token));
            return 'less';
        } elseif ($cost < $paid) {
            // Paid more than trip cost.
            // update trip transaction as paid.
            // Add margin of paid cost to the wallet.
            $this->payment->paid();
            $this->client->updateBalance((int)$paid - (int)$cost);
            // Notify client about the wallet update by FCM
            dispatch(new SendClientNotification('balance_updated', '10', $this->client->device_token));
            // Notify driver that invoice has been paid
            dispatch(new SendDriverNotification('balance_updated', '6', $this->driver->device_token));
            return 'more';
        } else {
            // just paid the trip cost.
            // update the trip's transaction as paid.
            $this->payment->paid();
            // Inform the client and driver that invoice has been paid.
            dispatch(new SendDriverNotification('balance_updated', '6', $this->driver->device_token));
            dispatch(new SendClientNotification('balance_updated', '10', $this->client->device_token));
            return 'equal';
        }
    }

    /**
     * Check repeated payment for a trip, in this case duplicated paid money will
     * charge the client wallet.
     *
     * @param  integer  $paid
     * @return boolean
     */
    private function checkRepeat($paid)
    {
        if ($this->trip->payments()->paid()->count()) {
            dispatch(new SendClientNotification('balance_updated', '10', $this->client->device_token));
            $this->client->updateBalance($paid);
            return true;
        } else {
            return false;
        }
    }

    /**
     * If RefNum already exists on ref col, so user tried to refresh the invoice page.
     *
     * @return void|view
     */
    private function notFresh()
    {
        if (Payment::whereRef($this->response->RefNum)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Charge the balance of the user.
     * 
     * @return void
     */
    public function charge()
    {
        // Check incoming response url.
        
        // Response is fresh.
        if ($this->notFresh()) {
            return view('errors.403');
        }

        // If ResNum is not a valid client_id
        // Revert back money if the state was OK
        $client = Client::find($this->response->ResNum);
        if (is_null($client)) {
            return view('errors.403');
        }

        if ($this->response->State == 'OK') {
            dispatch(new SendClientNotification('balance_updated', '10', $client->device_token));
            $client->updateBalance($this->response->transactionAmount);
            $payment = $this->payment = Payment::forceCreate([
                            'client_id' => $this->response->ResNum,
                            'paid' => true,
                            'type' => 'wallet',
                            'ref'  => $this->response->RefNum,
                            'detail' => $this->response->all(),
                        ]);
        } else {
            dispatch(new SendClientNotification('balance_failed_to_update', '11', $client->device_token));
            $payment = $this->payment = Payment::forceCreate([
                            'client_id' => $this->response->ResNum,
                            'paid' => false,
                            'type' => 'wallet',
                            'ref'  => $this->response->RefNum,
                            'detail' => $this->response->all(),
                        ]);
        }
        $response = $this->response;
        return view('payments.charge', compact('response', 'payment', 'client'));
    }
}
