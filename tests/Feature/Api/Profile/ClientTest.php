<?php

namespace Tests\Feature\Api\Profile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;

    private $accessToken;
    private $phone;

    public function setUp()
    {
        parent::setUp();
        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => ($this->phone = rand(11111111, 999999999)),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
        ]);

        $this->accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                             $response->getOriginalContent()['data'][0]['access_token'];
    }

    /**
     * Test GETting profile
     *
     * @return void
     */
    public function testProfile()
    {
        // GET client profile
        $this->json('GET', 'api/v1/client/profile', [], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // GET client balance
        $this->json('GET', 'api/v1/client/balance', [], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // GET client profile
        $this->json('GET', 'api/v1/client/profile', [], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true]);

        // Update client profile
        $this->json('POST', 'api/v1/client/profile', [
            'first_name' => 'new first name',
            'last_name' => 'new last name',
            'email' => 'newemail@email.com',
            'gender' => 'male',
            'address' => 'Sth St. 1st St. Iran',
            'state' => 'esf',
            'country' => 'Iran',
            'zipcode' => '123456',
            'login_by' => 'manual',
            'lang' => 'fa',
            'device_type' => 'android',
            'device_token' => 'sample_device_token_from_phpunit_new!',
        ], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => true,
                        'data' => [[
                            'first_name' => 'new first name',
                            'last_name' => 'new last name',
                            'email' => 'newemail@email.com',
                            'gender' => 'male',
                            'address' => 'Sth St. 1st St. Iran',
                            'state' => 'esf',
                            'country' => 'Iran',
                            'zipcode' => '123456',
                            'lang' => 'en',
                            'device_type' => 'ios',
                            'device_token' => 'sample_device_token_from_phpunit',
                            'phone' => $this->phone,
                        ]]]);
    }

    public function testValidations()
    {
        // Update client profile
        $this->json('POST', 'api/v1/client/profile', [
            'first_name' => 'new first name new first name new first name new first name new first name new first no
            new first name new first name new first name new first name new first name new first name new first name 
            new first name new first name new first name new first name new first name new first name new first name
            new first name new first name new first name new first name new first name new first name new first name
            new first name new first name new first name new first name new first name new first name new first name 
            new first name new first name new first name new first name new first name new first name new first name
            new first name new first name new first name new first name new first name new first name new first name
            new first name new first name new first name new first name new first name new first name new first name 
            new first name new first name new first name new first name new first name new first name new first name',
            'last_name' => 'new last name',
            'email' => 'newemail@email.com',
            'gender' => 'male',
            'address' => 'Sth St. 1st St. Iran',
            'state' => 'esf',
            'country' => 'Iran',
            'zipcode' => '123456',
            'login_by' => 'manual',
            'lang' => 'fa',
            'device_type' => 'android',
            'device_token' => 'sample_device_token_from_phpunit_new!',
        ], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(422)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);

        $this->json('POST', 'api/v1/client/profile', [

        ], [
            'Authorization' => $this->accessToken,
        ])->assertStatus(200)
          ->assertHeader('Content-Type', 'application/json')
          ->assertJson(['success' => false]);
    }
}
