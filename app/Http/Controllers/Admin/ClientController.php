<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use DateTime;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FilterRepository;
use App\Http\Requests\Admin\ClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('user')
                        ->orderby('created_at', 'desc')
                        ->paginate(config('admin.perPage'));
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Admin\ClientRequest  $request
     * @param  App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->all());
        flash('Client updated', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        flash('Client soft deleted', 'success');
        return redirect(route('clients.index'));
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function filter(Request $request, Client $clients)
    {
        $clients = $clients->with('user');
        if ($request->status == 'locked') {
            $clients = Client::locked();
        } elseif ($request->status == 'unlocked') {
            $clients = Client::unlocked();
        }

        if (isset($request->sortby) && isset($request->orderby) && array_key_exists($request->sortby, Client::$sortable)) {
            $clients = $clients->orderBy($request->sortby, $request->orderby);
        }

        if (isset($request->ids)) {
            $ids = explode(',', str_replace(' ', '', $request->ids));
            // If ids are set of numbers separated with comma 1,2,3,4
            $validate = preg_match('/^[0-9,]+$/', $request->ids);
            if ($validate) {
                $clients = $clients->whereIn('id', $ids);
            }
            /**
             * Mark as read notifications for new clients
             */
            if (isset($request->markAsRead)) {
                Auth::user()->markNewClientsNotificationsAsRead();
            }
        }

        if (isset($request->date_range)) {
            $clients = FilterRepository::daterange($request->date_range, $clients);
        }

        if (isset($request->count)) {
            if ($request->count == 15 || $request->count == 30) {
                $clients = $clients->paginate($request->count);
            } else {
                $clients = $clients->paginate(Client::count());
            }
        } else {
            $clients = $clients->paginate(config('admin.perPage'));
        }

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Lock a client.
     * @param  App\Client $client
     * @return redirect
     */
    public function lock(Client $client)
    {
        $client = Client::whereId($client->id)->firstOrFail();
        $client->lock = true;
        $client->update();
        flash('Client locked', 'success');
        return back();
    }

    /**
     * Unlock client.
     * @param  App\Client $client
     * @return redirect
     */
    public function unlock(Client $client)
    {
        $client = CLient::whereId($client->id)->firstOrFail();
        $client->lock = false;
        $client->update();
        flash('Client unlocked', 'success');
        return back();
    }

    /**
     * Search on everything
     * @param  Illuminate\Http\Request $request
     * @return view
     */
    public function search(Request $request)
    {
        // No space after and before the query
        $q = trim($request->q);

        $clients = Client::where('first_name', 'ilike', "%$q%")
                        ->orWhere('last_name', 'ilike', "%$q%")
                        ->orWhere('email', 'ilike', "%$q%")
                        ->orWhere('gender', 'ilike', "%$q%")
                        ->orWhere('state', 'ilike', "%$q%")
                        ->orWhere('country', 'ilike', "%$q%")
                        ->orWhere('address', 'ilike', "%$q%")
                        ->orWhere('zipcode', 'ilike', "%$q%")
                        ->orWhereIn('user_id', User::where('phone', 'ilike', "%$q%")
                                                    ->get(['id'])->flatten())
                        ->paginate(config('admin.perPage'));

        return view('admin.clients.index', compact('clients'));
    }
}
