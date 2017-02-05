<?php
namespace Tests\Unit;

use Tests\TestCase;
use Tests\Unit\ApiAuthClientCase;

class CarTypesTest extends TestCase
{
    private $accessToken;
    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(11111111, 999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
        ], [
            'Accept' => 'application/josn',
        ]);

        $this->accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                             $response->getOriginalContent()['data'][0]['access_token'];
    }
    /**
     * Test getting car types.
     *
     * @return void
     */
    public function testGetCarTypes()
    {
        $response = $this->json('POST', '/api/v1/client/verify', [
            'code' => '55555',
        ], [
            'Accept' => 'application/josn',
            'Authorization' => $this->accessToken,
        ]);
        $response->assertStatus(200)
                 ->assertJson([
                    'success' => true,
                 ]);
        $response = $this->json('GET', 'api/v1/client/car/types', [], [
            'Accept' => 'application/josn',
            'Authorization' => $this->accessToken,
        ]);
        $response->assertStatus(200)
                 ->assertJson([
                    'success' => true,
                 ]);
    }
}
