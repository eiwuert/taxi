<?php

namespace Tests\Feature\Api\Trip;

use App\Client;
use App\Driver;

trait TripTrait
{
    protected $client;
    protected $driver;
    protected $clientId;
    protected $clientAccessToken;
    protected $driverAccessToken;
    public function setUp()
    {
        parent::setUp();
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => '1',
            'country' => 'Iran',
        ]);
        $this->refreshApplication();

        $this->driverAccessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' .
                                   $response->getOriginalContent()['data'][0]['access_token'];
        $this->refreshApplication();
        $this->json('POST', '/api/v1/driver/verify',
                            ['code' => '55555'],
                            ['Authorization' => $this->driverAccessToken,
                             'Accept' => 'application/json']);

        $this->driver = Driver::orderBy('id', 'desc')->first();
        $this->driver->forceFill(['approve' => 'true'])->save();
        $this->refreshApplication();

        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'state' => '1',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit'
        ]);
        $this->client = Client::orderBy('id', 'desc')->first();
        $this->clientAccessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' .
                                   $response->getOriginalContent()['data'][0]['access_token'];
        \Log::debug($this->clientAccessToken);
        $this->refreshApplication();

        $response = $this->json('POST', '/api/v1/driver/verify',
                            ['code' => '55555'],
                            ['Authorization' => $this->clientAccessToken,
                             'Accept' => 'application/json']);

        $this->refreshApplication();

        $client = $this->json('GET', 'api/v1/client/profile', [], 
            ['Authorization' => $this->clientAccessToken]);
        $this->clientId = $client->getOriginalContent()['data'][0]['id'];

        $this->refreshApplication();
    }
    public function teardown()
    {
        $this->driver->forceDelete();
        $this->client->delete();
    }
    protected function driverGoesOnline()
    {
        $this->get('api/v1/driver/online', [
            'Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json']);
        $this->refreshApplication();
    }
    protected function driverSetsHerCurrentLocation($lat = '41.410874', $long = '2.157207')
    {
        $response = $this->post('api/v1/driver/location',
            ['lat' => $lat, 'long' => $long],
            ['Authorization' => $this->driverAccessToken,
            'Accept' => 'application/json']);
        $this->refreshApplication();
    }
    protected function driverAcceptsTheTrip()
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
    public function clientChooseWalletAsThePayment()
    {
        $this->get('/api/v1/client/pay/wallet',
            ['Authorization' => $this->clientAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => false])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
        Client::find($this->clientId)
            ->forceFill(['balance' => 99999999])
            ->save();
        $this->get('/api/v1/client/pay/wallet',
            ['Authorization' => $this->clientAccessToken,
            'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => 'true'])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }
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
    protected function driverRatesTheTrip()
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
    protected function clientRatesTheTrip()
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
    protected function clientCalculateTripV1($s_lat, $s_long, $d_lat, $d_long)
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
    protected function clientCalculateTripV2($s_lat, $s_lng, $d_lat, $d_lng)
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
    protected function clientGetsCurrentTrip()
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
    protected function driverGetsCurrentTrip()
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
    protected function driverSeesThePaymentMode()
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
    protected function clientRequestsATaxiV1()
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
    protected function clientRequestsATaxiV1AndSeesNoDriver()
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
    protected function clientRequestsATaxiV2()
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
    protected function clientRequestsATaxiV2AndSeesNoDriver()
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
    protected function clientCancelsTheTrip()
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
    protected function driverCancelsTheTrip()
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
    protected function driverGetsHisOrHerHistory()
    {
        $this->get('/api/v1/driver/history',
            ['Authorization' => $this->driverAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['status_id', 'source',
                'destination', 'eta_value', 'eta_text', 'distance_value', 'distance_text',
                'etd_value', 'etd_text', 'driver_location' => ['id', 'latitude', 'longitude',
                'name', 'user_id'], 'driver_distance_value', 'driver_distance_text', 'status_name',
                's_lat', 's_long', 'd_lat', 'd_long', 'transaction' => ['trip_id', 'car_type_id',
                'entry', 'distance', 'per_distance', 'distance_unit', 'distance_value', 'time',
                'per_time', 'time_unit', 'time_value', 'surcharge', 'currency', 'timezone', 'total'],
                'rate' => ['client', 'driver', 'client_comment', 'driver_comment', 'trip_id']]]]);
        $this->refreshApplication();
    }
    protected function clientGetsHisOrHerHistory()
    {
        $this->get('/api/v1/client/history',
            ['Authorization' => $this->clientAccessToken,
             'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['source', 'destination', 
                'driver_location' => [['lat', 'long', 'name']], 'status_name',
                's_lat', 's_long', 'd_lat', 'd_long', 'transaction' => [['trip_id', 'car_type_id',
                'entry', 'distance', 'per_distance', 'distance_unit', 'distance_value', 'time',
                'per_time', 'time_unit', 'time_value', 'surcharge', 'currency', 'timezone', 'total']],
                'rate' => [['client', 'client_comment']],
                'driver' => [['first_name', 'last_name', 'email', 'gender', 'car' => ['number', 'type', 'color'], 'phone']]]]]);
        $this->refreshApplication();
    }
}