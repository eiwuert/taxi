<?php

namespace Tests\Feature\Api\Location;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DriverTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;
    private $accessToken;

    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(11111, 99999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'country' => 'Iran',
            'state' => 'Isfahan'
        ]);

        $this->accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                       $response->getOriginalContent()['data'][0]['access_token'];
    }

    private function successful($lat, $long, $version = 'v1')
    {
        $this->json('POST', 'api/' . $version . '/driver/location', 
            ['lat' => $lat, ($version == 'v1') ? 'long' : 'lng' => $long,], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true])
          ->assertJsonStructure(['success', 'data' => [['latitude', 'longitude', 
            'name', 'user_id', 'updated_at', 'created_at', 'id']]]);
    }

    private function unsuccessful($lat, $long, $version = 'v1', $status = 422)
    {
        $this->json('POST', 'api/' . $version . '/driver/location', 
            ['lat' => $lat, ($version == 'v1') ? 'long' : 'lng' => $long,], [
            'Authorization' => $this->accessToken,
        ])->assertStatus($status)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false])
          ->assertJsonStructure(['success', 'data' => [['title', 'detail', 'status']]]);
    }

    /**
     * Test setting location for driver.
     *
     * @return void
     */
    public function testSettingLocation()
    {
        $this->successful('0.0', '0.0');
        $this->successful('30.0', '30.0');
        $this->successful('-30.0', '-30.0');
        $this->successful('-30.0', '30.0');
        $this->successful('-30.0', '30.0');

        $this->successful('0.0', '0.0', 'v2');
        $this->successful('30.0', '30.0', 'v2');
        $this->successful('-30.0', '-30.0', 'v2');
        $this->successful('-30.0', '30.0', 'v2');
        $this->successful('-30.0', '30.0', 'v2');
    }

    /**
     * Test setting location for driver.
     *
     * @return void
     */
    public function testValidationFailed()
    {
        $this->unsuccessful('abc', '0.0');
        $this->unsuccessful('', '0.0');
        $this->unsuccessful('', '');
        $this->unsuccessful('12378547548248937785478348752809.78523489523780987987', 
                    '48172892138478917324780947814278.8741827784132870879');
        $this->unsuccessful('∆ß˚∆˚∂∆˚', '≈ç∆ß∆˜ß¬');

        // Wrong version parameters
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '0.0',
                'lng' => '30.0',
            ], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // abc, 0.0 - v2
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => 'abc',
                'long' => '0.0',
            ], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        $this->unsuccessful('', '0.0', 'v2');
        $this->unsuccessful('', '', 'v2');
        $this->unsuccessful('12378547548248937785478348752809.78523489523780987987', 
                    '48172892138478917324780947814278.8741827784132870879', 'v2');
        $this->unsuccessful('∆ß˚∆˚∂∆˚', '≈ç∆ß∆˜ß¬', 'v2');

        // Wrong version parameters
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '0.0',
                'long' => '30.0',
            ], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);
    }
}
