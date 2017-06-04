<?php

namespace Tests\Feature\Api\Trip;

use App\Client;
use App\Driver;
use Tests\TestCase;
use Tests\Feature\Api\Trip\TripTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class RequestTest extends TestCase
{
    use TripTrait;
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
        $this->clientGetsHisOrHerHistory();
    }
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
        $this->clientGetsHisOrHerHistory();
    }
    public function testRejectClientByDriverV1()
    {
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
    public function testRejectClientByDriverV2()
    {
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV2();
        $this->driverSetsHerCurrentLocation('41.435229', '2.171926');
        $this->clientGetsCurrentTrip();
        $this->driverGetsCurrentTrip();
        $this->driverCancelsTheTrip();
    }
    public function testNoDriverV1()
    {
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV1AndSeesNoDriver();
    }
    public function testNoDriverV2()
    {
        $this->clientCalculateTripV1('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientCalculateTripV2('41.410874', '2.157207', '41.435229', '2.171926');
        $this->clientRequestsATaxiV2AndSeesNoDriver();
    }
    public function testDriverRejectsStartedTrip()
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
        $this->driverCancelsTheTrip();
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
    public function testCancelOnwayDriverByClient()
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
        $this->clientCancelsTheTrip();
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientRequestsATaxiV2();
        $this->driverAcceptsTheTrip();
        $this->clientCancelsTheTrip();
    }

    public function testCancelOnwayDriverByDriver()
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
        $this->driverCancelsTheTrip();
        $this->driverSetsHerCurrentLocation();
        $this->clientRequestsATaxiV2();
        $this->driverAcceptsTheTrip();
        $this->driverCancelsTheTrip();
    }
    public function testClientCancelArrivedDriver()
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
        $this->clientCancelsTheTrip();
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
    public function testDriverCancelsTheTripWhenArrived()
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
        $this->driverCancelsTheTrip();
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
    public function testDriverCancelsTheTripAfterTheTripHasBeenStarted()
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
        $this->driverCancelsTheTrip();
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
