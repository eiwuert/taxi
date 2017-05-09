<?php

namespace Tests\Feature\Api\Payment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChargeTest extends TestCase
{
    use WithoutMiddleware;

    private $accessToken;

    public function setUp()
    {
        parent::setUp();
        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => ($this->phone = rand(1111111111, 9999999999)),
            'login_by' => 'manual',
            'lang' => 'en',
            'state' => '1',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
        ]);

        $this->accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' .
                             $response->getOriginalContent()['data'][0]['access_token'];
    }

    /**
     * Basic redirect OK to IPG.
     *
     * @return void
     */
    public function testRedirectOkToIPG()
    {
        $client = $this->json('GET', 'api/v1/client/profile', [], 
            ['Authorization' => $this->accessToken]);
        $clientId = $client->getOriginalContent()['data'][0]['id'];
        $this->refreshApplication();
        $this->get('payment/charge/' . $clientId . '/1000', [], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    }
}
