<?php

namespace Tests\Feature\Api\Trip;

use App\Client;
use App\Driver;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestTest extends TestCase
{
    private $phone;
    private $client;
    private $driver;
    private $clientAccessToken;
    private $driverAccessToken;

    public function setUp()
    {
        parent::setUp();
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => ($this->phone = rand(11111111, 999999999)),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => 'Esf',
            'country' => 'Iran',
        ]);

        $this->driverAccessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' .
                                   $response->getOriginalContent()['data'][0]['access_token'];

        $this->json('POST', '/api/v1/driver/verify',
                            ['code' => '55555'],
                            ['Authorization' => $this->driverAccessToken,
                             'Accept' => 'application/json']);

        ($this->driver = Driver::orderBy('id', 'desc')->first())->forceFill(['approve' => 'true'])->save();
        $this->refreshApplication();

        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => '12345',
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit'
        ]);
        $this->client = Client::orderBy('id', 'desc')->first();
        $this->clientAccessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' .
                                   $response->getOriginalContent()['data'][0]['access_token'];

        $this->refreshApplication();

        $response = $this->json('POST', '/api/v1/driver/verify',
                            ['code' => '55555'],
                            ['Authorization' => $this->clientAccessToken,
                             'Accept' => 'application/json']);

        $this->refreshApplication();
    }

    public function teardown()
    {
        $this->driver->forceDelete();
        $this->client->delete();
    }

    /**
     * Test request taxi v1 within the range.
     * @return void
     */
    public function testRequestTaxiV1WithinTheRange()
    {
        $this->driverGoesOnline();
        $this->driverSetsHerCurrentLocation();
        $this->clientCalculateTrip('41.410874', '2.157207', '41.435229', '2.171926');
        $this->post('/api/v1/client/trip',
            ['s_lat' => '41.410874', 's_long' => '2.157207',
             'd_lat' => '41.435229', 'd_long' => '2.171926'],
            ['Authorization' => $this->clientAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['content', 'eta_text',
                'eta_value', 'distance_text', 'distance_value', 'trip_status',
                'source_name', 'destination_name']]]);
        $this->refreshApplication();
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
    }

    /**
     * Make driver online.
     * @return void
     */
    private function driverGoesOnline()
    {
        $this->get('api/v1/driver/online', [
            'Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json']);
        $this->refreshApplication();
    }

    /**
     * Set driver location.
     * @param  float $lat
     * @param  float $long
     * @return void
     */
    private function driverSetsHerCurrentLocation($lat = '41.410874', $long = '2.157207')
    {
        $response = $this->post('api/v1/driver/location',
            ['lat' => $lat, 'long' => $long],
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json']);
        $this->refreshApplication();
    }

    /**
     * Driver Accepts the trip.
     * @return void
     */
    private function driverAcceptsTheTrip()
    {
        $response = $this->get('api/v1/driver/accept',
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }

    /**
     * Driver arrives to the start point.
     * @return void
     */
    public function driverArrivesToTheStartPoint()
    {
        $this->get('/api/v1/driver/arrived',
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }

    /**
     * Driver starts to the trip.
     * @return void
     */
    public function driverStartsTheTrip()
    {
        $this->get('/api/v1/driver/start',
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }

    /**
     * Client choose the payment mode
     * @return void
     */
    public function clientChooseThePayment()
    {
        $this->get('/api/v1/client/pay/cash',
            ['Authorization' => $this->clientAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }

    /**
     * Driver ends to the trip.
     * @return void
     */
    public function driverEndsTheTrip()
    {
        $this->get('/api/v1/driver/end',
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }

    /**
     * Driver rates the trip.
     * @return void
     */
    private function driverRatesTheTrip()
    {
        $this->post('/api/v1/driver/rate',
            ['stars'  => '5',
            'comment' => 'Sample comment from driver for client.'],
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title']]]);
        $this->refreshApplication();
    }

    /**
     * Client rates the trip.
     * @return void
     */
    private function clientRatesTheTrip()
    {
        $this->post('/api/v1/client/rate',
                    ['stars'  => '5',
                    'comment' => 'Sample comment from client for driver.'],
                    ['Authorization' => $this->clientAccessToken,
                    'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title']]]);
        $this->refreshApplication();
    }

    /**
     * Calculate trip cost by client.
     * @param  float $s_lat
     * @param  float $s_long
     * @param  float $d_lat
     * @param  float $d_long
     * @return void
     */
    private function clientCalculateTrip($s_lat, $s_long, $d_lat, $d_long)
    {
        $this->post('/api/v1/client/calculate',
            ['s_lat' => $s_lat, 's_long' => $s_long,
             'd_lat' => $d_lat, 'd_long' => $d_long],
            ['Authorization' => $this->clientAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['source', 'destination',
                'distance', 'duration', 'transactions']]]);
        $this->refreshApplication();
    }

    /**
     * Get client trip.
     * @return void
     */
    private function clientGetsCurrentTrip()
    {
        $this->get('/api/v1/client/trip',
            ['Authorization' => $this->clientAccessToken, 
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['paid', 'payment', 
                'driver', 'trip', 'status', 'car', 'type', 'source', 
                'destination', 'driver_location', 'total']]]);
        $this->refreshApplication();
    }

    /**
     * Get driver trip.
     * @return void
     */
    private function driverGetsCurrentTrip()
    {
        $this->get('/api/v1/driver/trip',
            ['Authorization' => $this->driverAccessToken, 
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['paid', 'payment', 
                'client', 'trip', 'status', 'source', 'destination', 'total']]]);
        $this->refreshApplication();
    }

    /**
     * Driver sees the new payment mode.
     * @return void
     */
    private function driverSeesThePaymentMode()
    {
        $this->get('/api/v1/driver/trip',
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['paid']]]);
        $this->refreshApplication();
    }
}
