<?php
namespace Tests\Feature;

use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ResendDriverTest extends TestCase
{
    use WithoutMiddleware;
    private $accessToken;

    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'country' => 'Iran',
            'state' => '1'
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
        return $this->json('POST', 'api/v1/driver/verify', $data, [
            'Accept' => 'application/json',
            'Authorization' => $this->accessToken,
        ]);
    }

    /**
     * Test driver for asking SMS resend while not verified And not passed time limit.
     *
     * @return void
     */
    public function testAskForResendWhileNotVerifiedAndNotPassedTimeLimit()
    {
        $this->request(['code' => '55555']);
        $this->refreshApplication();
        $response = $this->json('GET', 'api/v1/driver/resend', [
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
     * Test driver resend while not yet verified.
     *
     * @return void
     */
    public function testAskForResendWhileNotVerifiedAndTimeLimitPassed()
    {
        $response = $this->json('GET', 'api/v1/driver/resend', [
            'Accept' => 'application/json',
            'Authorization' => $this->accessToken,
        ]);
        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonStructure(['success', 'data' => [['content']]]);
    }
}
