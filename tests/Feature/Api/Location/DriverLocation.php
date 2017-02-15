<?php

namespace Tests\Feature\Api\Location;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DriverLocation extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;

    /**
     * Test setting location for driver.
     *
     * @return void
     */
    public function testSettingLocation()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(11111111, 999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => 'Esfahan',
            'country' => 'Iran',
        ]);

        $accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                       $response->getOriginalContent()['data'][0]['access_token'];

        // 0.0, 0.0 - v1
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '0.0',
                'long' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // 30.0, 30.0 - v1
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '30.0',
                'long' => '30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // -30.0, -30.0 - v1
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '-30.0',
                'long' => '-30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // -30.0, 30.0 - v1
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '-30.0',
                'long' => '30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // 0.0, 0.0 - v2
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '0.0',
                'lng' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // 30.0, 30.0 - v2
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '30.0',
                'lng' => '30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // -30.0, -30.0 - v2
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '-30.0',
                'lng' => '-30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // -30.0, 30.0 - v2
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '-30.0',
                'lng' => '30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);
    }

    /**
     * Test setting location for driver.
     *
     * @return void
     */
    public function testValidationFailed()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(11111111, 999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => 'Esfahan',
            'country' => 'Iran',
        ]);

        $accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                       $response->getOriginalContent()['data'][0]['access_token'];

        // abc, 0.0 - v1
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => 'abc',
                'long' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // -, 0.0 - v1
        $this->json('POST', 'api/v1/driver/location', [
                //'lat' => 'abc',
                'long' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // -, - - v1
        $this->json('POST', 'api/v1/driver/location', [
                //'lat' => 'abc',
                //'long' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // long lat/long v1
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '12378547548248937785478348752809.78523489523780987987',
                'long' => '48172892138478917324780947814278.8741827784132870879',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // Invalid chars
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '≈ç∆ß∆˜ß¬',
                'long' => '∆ß˚∆˚∂∆˚',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // Wrong version parameters
        $this->json('POST', 'api/v1/driver/location', [
                'lat' => '0.0',
                'lng' => '30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // abc, 0.0 - v2
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => 'abc',
                'long' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // -, 0.0 - v2
        $this->json('POST', 'api/v2/driver/location', [
                //'lat' => 'abc',
                'long' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // -, - - v2
        $this->json('POST', 'api/v2/driver/location', [
                //'lat' => 'abc',
                //'long' => '0.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // long lat/long v2
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '12378547548248937785478348752809.78523489523780987987',
                'long' => '48172892138478917324780947814278.8741827784132870879',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // Invalid chars
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '≈ç∆ß∆˜ß¬',
                'long' => '∆ß˚∆˚∂∆˚',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        // Wrong version parameters
        $this->json('POST', 'api/v2/driver/location', [
                'lat' => '0.0',
                'long' => '30.0',
            ], [
            'Authorization' => $accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);
    }
}
