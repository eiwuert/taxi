<?php

namespace Tests\Feature\Api\Profile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DriverTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;

    /**
     * Test GETting profile
     *
     * @return void
     */
    public function testProfile()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(11111111, 999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => 'Esf',
            'country' => 'Iran',
        ]);

        $accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                       $response->getOriginalContent()['data'][0]['access_token'];

        // GET driver profile
        $this->json('GET', 'api/v1/driver/profile', [], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true])
          ->assertJsonStructure(['success', 'data' => [['id', 'first_name', 
            'last_name', 'email', 'gender', 'device_token', 'device_type', 'lang', 
            'address', 'state', 'country', 'zipcode', 'picture', 'user_id', 'phone']]]);

        // Test picture upload
    }
}
