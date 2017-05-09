<?php
namespace Tests\Feature;

use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ResendClientTest extends TestCase
{
    use WithoutMiddleware;
    private $accessToken;

    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(1111111111, 9999999999),
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
     * Send authorized request.
     * @param  array  $data
     * @return MakesHttpRequests
     */
    private function request($data = array())
    {
        return $this->json('POST', 'api/v1/client/verify', $data, [
            'Accept' => 'application/json',
            'Authorization' => $this->accessToken,
        ]);
    }

    /**
     * Test client for asking SMS resend while not verified And not passed time limit.
     *
     * @return void
     */
    public function testAskForResendWhileNotVerifiedAndNotPassedTimeLimit()
    {
        $this->request(['code' => '55555']);
        $this->refreshApplication();
        $response = $this->json('GET', 'api/v1/client/resend', [
            'Accept' => 'application/json',
            'Authorization' => $this->accessToken,
        ]);
        $response->assertStatus(200)
                 ->assertJson(['success' => false])
                 ->assertJsonStructure([
                    'success',
                    'data' => [['title', 'detail']]
                ]);
    }

    /**
     * Test client resend while not yet verified.
     *
     * @return void
     */
    public function testAskForResendWhileNotVerifiedAndTimeLimitPassed()
    {
        $response = $this->json('GET', 'api/v1/client/resend', [
            'Accept' => 'application/json',
            'Authorization' => $this->accessToken,
        ]);
        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonStructure(['success', 'data' => [['content']]]);
    }
}
