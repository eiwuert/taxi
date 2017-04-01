<?php
namespace Tests\Feature;

use Tests\TestCase;
use Tests\Unit\ApiAuthClientCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CarTypesTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Test getting car types.
     *
     * @return void
     */
    public function testGetCarTypes()
    {
        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(11111111, 999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
        ]);

        $accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                       $response->getOriginalContent()['data'][0]['access_token'];

        $response = $this->json('GET', 'api/v1/client/car/types', [], [
            'Authorization' => $accessToken,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonStructure(['success', 'data']);
    }
}
