<?php

namespace Tests\Feature\Api\Driver;

use App\Driver;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StatusTest extends TestCase
{
    private $accessToken;
    private $phone;

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

        $this->accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                             $response->getOriginalContent()['data'][0]['access_token'];

        $this->json('POST', '/api/v1/driver/verify', 
                            ['code' => '55555'], 
                            ['Authorization' => $this->accessToken, 'Accept' => 'application/json']);

        $this->refreshApplication();
        Driver::orderBy('id', 'desc')->first()->forceFill(['approve' => 'true'])->save();
    }

    /**
     * Test driver going online.
     *
     * @return void
     */
    public function testGoOnline()
    {
        $response = $this->get('api/v1/driver/online', [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['result']]]);
        $this->refreshApplication();
        $response = $this->get('api/v1/driver/online', [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => false])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
    }

    /**
     * Test driver going offline.
     *
     * @depends testGoOnline
     * @return void
     */
    public function testGoOffline()
    {
        $response = $this->get('api/v1/driver/online', [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['result']]]);
        $this->refreshApplication();
        $response = $this->get('api/v1/driver/offline', [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['result']]]);
        $this->refreshApplication();
        $response = $this->get('api/v1/driver/offline', [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => false])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
    }

    /**
     * Test driver getting status.
     *
     * @return void
     */
    public function testStatus()
    {
        $this->get('api/v1/driver/online', [
            'Authorization' => $this->accessToken]);
        $this->refreshApplication();
        $this->json('GET', 'api/v1/driver/status', [], [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonFragment(['online' => true]);
        $this->refreshApplication();
        $this->get('api/v1/driver/offline', [
            'Authorization' => $this->accessToken]);
        $this->refreshApplication();
        $this->json('GET', 'api/v1/driver/status', [], [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonFragment(['online' => false]);
        $this->refreshApplication();
    }
}
