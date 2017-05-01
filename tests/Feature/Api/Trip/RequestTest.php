<?php

namespace Tests\Feature\Api\Trip;

use App\Client;
use App\Driver;
use Tests\TestCase;
use Tests\Feature\Api\Trip\TripTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestTest extends TestCase
{
    /**
     * TODO: no_response, cancel_request_taxi
     */
    use TripTrait;

    /**
     * Test request taxi v1 within the range. (17)
     *
     * @return void
     */
    public function testRequestTaxiV1WithinTheRange()
    {
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverStartsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->clientChooseThePayment();
        $this->driverSeesThePaymentMode();
        $this->driverSetsHerCurrentLocation('41.435529', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverEndsTheTrip();
        $this->driverSetsHerCurrentLocation('41.434229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverRatesTheTrip();
        $this->driverSetsHerCurrentLocation('41.425229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->clientRatesTheTrip();
        //$this->driverGetsHisOrHerHistory();
        $this->clientGetsHisOrHerHistory();
    }


    /**
     * Test request taxi v1 within the range. (17) pay with wallet
     *
     * @return void
     */
    public function testRequestTaxiV1WithinTheRangeWithWallet()
    {
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverStartsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->clientChooseWalletAsThePayment();
        $this->driverSeesThePaymentMode();
        $this->driverSetsHerCurrentLocation('41.435529', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverEndsTheTrip();
        $this->driverSetsHerCurrentLocation('41.434229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverRatesTheTrip();
        $this->driverSetsHerCurrentLocation('41.425229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->clientRatesTheTrip();
        //$this->driverGetsHisOrHerHistory();
        $this->clientGetsHisOrHerHistory();
    }

    /**
     * test rejecting client by driver.
     *
     * @return void
     */
    public function testRejectClientByDriverV1()
    {
        // V1
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();
    }

    /**
     * test rejecting client by driver.
     *
     * @return void
     */
    public function testRejectClientByDriverV2()
    {
        // V2
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV2();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();
    }

    /**
     * test rejecting client by driver V1
     *
     * @return void
     */
    public function testNoDriverV1()
    {
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1AndSeesNoDriver();
    }

    /**
     * test rejecting client by driver V2
     *
     * @return void
     */
    public function testNoDriverV2()
    {
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV2AndSeesNoDriver();
    }

    /**
     * Test driver rejects the started trip.
     *
     * @return void
     */
    public function testDriverRejectsStartedTrip()
    {
        // V1
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverStartsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();

        // V2
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV2();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverStartsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();
    }

    /**
     * Client cancels the onway driver.
     *
     * @return void
     */
    public function testCancelOnwayDriverByClient()
    {
        // V1
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->clientCancelsTheTrip();

        // V2
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientRequestsATaxiV2();
        $this->driverAcceptsTheTrip();
        $this->clientCancelsTheTrip();
    }


    /**
     * Driver cancels the onway trip.
     *
     * @return void
     */
    public function testCancelOnwayDriverByDriver()
    {
        // v1
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();

        // v2
        $this->driverSetsHerCurrentLocation();
        $this->clientRequestsATaxiV2();
        $this->driverAcceptsTheTrip();
        $this->driverCancelsTheTrip();
    }

    /**
     * Test client cancel the arrived driver.
     *
     * @return void
     */
    public function testClientCancelArrivedDriver()
    {
        // V1
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->clientCancelsTheTrip();

        // V2
        $this->driverSetsHerCurrentLocation();
        $this->clientRequestsATaxiV2();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->clientCancelsTheTrip();
    }

    /**
     * Test client cancel the arrived driver.
     *
     * @return void
     */
    public function testDriverCancelsTheTripWhenArrived()
    {
        // v1 
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();

        // v2
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV2();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();
    }

    /**
     * Test driver cancels the trip after the trip has been started
     *
     * @return void
     */
    public function testDriverCancelsTheTripAfterTheTripHasBeenStarted()
    {
        // v1
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverStartsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();

        // v2
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV2();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverAcceptsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435329', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverArrivesToTheStartPoint();
        $this->driverSetsHerCurrentLocation('41.435429', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverStartsTheTrip();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();
    }
}
