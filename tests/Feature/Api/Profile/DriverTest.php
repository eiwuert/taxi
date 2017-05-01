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
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => '1',
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

    /**
     * Test driver getting income.
     * 
     * @return void
     */
    public function testDriverIncome()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'state' => '1',
            'country' => 'Iran',
        ]);

        $accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                       $response->getOriginalContent()['data'][0]['access_token'];

        // GET driver income
        $this->json('GET', 'api/v1/driver/income', [], [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true])
          ->assertJsonStructure(['success', 'data' => [['income']]]);
    }
}
