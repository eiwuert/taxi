<?php

namespace Tests\Feature\Api\Trip;

use App\Client;
use App\Driver;

trait TripTrait
{
    private $client;
    private $driver;
    private $clientAccessToken;
    private $driverAccessToken;

    /**
     * Set up methods.
     *
     * @return  void
     */
    public function setUp()
    {
        parent::setUp();
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(11111111, 999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => 'Esf',
            'country' => 'Iran',
        ]);
        $this->refreshApplication();

        $this->driverAccessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' .
                                   $response->getOriginalContent()['data'][0]['access_token'];

        $this->json('POST', '/api/v1/driver/verify',
                            ['code' => '55555'],
                            ['Authorization' => $this->driverAccessToken,
                             'Accept' => 'application/json']);

        $this->driver = Driver::orderBy('id', 'desc')->first();
        $this->driver->forceFill(['approve' => 'true'])->save();
        $this->refreshApplication();

        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(11111111, 999999999),
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

    /**
     * Remove created user.
     * 
     * @return void
     */
    public function teardown()
    {
        $this->driver->forceDelete();
        $this->client->delete();
    }

    /**
     * Make driver online.
     * 
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
     * 
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
     * 
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
     * 
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
     * 
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
     * Client choose the payment mode.
     * 
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
     * 
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
     * 
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
     * 
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
     * Calculate trip cost by client. V1
     * 
     * @param  float $s_lat
     * @param  float $s_long
     * @param  float $d_lat
     * @param  float $d_long
     * @return void
     */
    private function clientCalculateTripV1($s_lat, $s_long, $d_lat, $d_long)
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
     * Calculate trip cost by client. V2
     * 
     * @param  float $s_lat
     * @param  float $s_long
     * @param  float $d_lat
     * @param  float $d_long
     * @return void
     */
    private function clientCalculateTripV2($s_lat, $s_lng, $d_lat, $d_lng)
    {
        $this->post('/api/v2/client/calculate',
            ['s_lat' => $s_lat, 's_lng' => $s_lng,
             'd_lat' => $d_lat, 'd_lng' => $d_lng],
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
     * 
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
     * 
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
     * 
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

    /**
     * Client request a taxi V1.
     * 
     * @return void
     */
    private function clientRequestsATaxiV1()
    {
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
    }

    /**
     * Test no driver status V1.
     * 
     * @return void
     */
    private function clientRequestsATaxiV1AndSeesNoDriver()
    {
        $this->post('/api/v1/client/trip',
            ['s_lat' => '41.410874', 's_long' => '2.157207',
             'd_lat' => '41.435229', 'd_long' => '2.171926'],
            ['Authorization' => $this->clientAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => false])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail','trip_status']]]);
        $this->refreshApplication();
    }

    /**
     * Client request a taxi V2
     * 
     * @return void
     */
    private function clientRequestsATaxiV2()
    {
        $this->post('/api/v2/client/trip',
            ['s_lat' => '41.410874', 's_lng' => '2.157207',
             'd_lat' => '41.435229', 'd_lng' => '2.171926'],
            ['Authorization' => $this->clientAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['content', 'eta_text',
                'eta_value', 'distance_text', 'distance_value', 'trip_status',
                'source_name', 'destination_name']]]);
        $this->refreshApplication();
    }

    /**
     * Test no driver status V2
     * 
     * @return void
     */
    private function clientRequestsATaxiV2AndSeesNoDriver()
    {
        $this->post('/api/v2/client/trip',
            ['s_lat' => '41.410874', 's_lng' => '2.157207',
             'd_lat' => '41.435229', 'd_lng' => '2.171926'],
            ['Authorization' => $this->clientAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => false])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail','trip_status']]]);
        $this->refreshApplication();
    }

    /**
     * Client cancels the trip.
     * 
     * @return void
     */
    private function clientCancelsTheTrip()
    {
        $this->get('/api/v1/client/cancel',
            ['Authorization' => $this->clientAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }

    /**
     * Driver cancels the trip.
     * 
     * @return void
     */
    private function driverCancelsTheTrip()
    {
        $this->get('/api/v1/driver/cancel',
            ['Authorization' => $this->driverAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }
}