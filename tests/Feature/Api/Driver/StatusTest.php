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
    private $driver;

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
        $this->driver = Driver::orderBy('id', 'desc')->first();
        $this->driver->forceFill(['approve' => 'true'])->save();
    }

    /**
     * Test driver going online V1.
     *
     * @return void
     */
    public function testGoOnlineV1()
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
     * Test driver going online V2
     *
     * @return void
     */
    public function testGoOnlineV2()
    {
        $response = $this->get('api/v2/driver/online', [
            'Authorization' => $this->accessToken])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true]);
        $this->refreshApplication();
        $response = $this->get('api/v2/driver/online', [
            'Authorization' => $this->accessToken])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true]);
        // TODO: Onway
    }

    /**
     * Test driver going offline.
     *
     * @return void
     */
    public function testGoOfflineV1()
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
     * Test driver going offline v2.
     *
     * @return void
     */
    public function testGoOfflineV2()
    {
        $response = $this->get('api/v2/driver/offline', [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
        $response = $this->get('api/v2/driver/offline', [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
    }

    /**
     * Test driver getting status V1.
     *
     * @return void
     */
    public function testStatusV1()
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

    /**
     * Test driver getting status v2.
     *
     * @return void
     */
    public function testStatusV2()
    {
        $this->get('api/v2/driver/online', [
            'Authorization' => $this->accessToken]);
        $this->refreshApplication();
        $this->json('GET', 'api/v2/driver/status', [], [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => true])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
        $this->get('api/v2/driver/offline', [
            'Authorization' => $this->accessToken]);
        $this->refreshApplication();
        $this->json('GET', 'api/v2/driver/status', [], [
            'Authorization' => $this->accessToken,])
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(['success' => false])
            ->assertJsonStructure(['success', 'data' => [['title', 'detail']]]);
        $this->refreshApplication();
    }

}
