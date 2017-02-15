<?php

namespace Tests\Feature\Api\Car;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class infoTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGettingCarInfo()
    {
        $response = $this->post('/api/v1/driver/register', [
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
        $this->get('api/v1/driver/car/info', [
            'Authorization' => $accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);
    }
}
