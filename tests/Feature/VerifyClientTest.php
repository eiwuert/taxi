<?php
namespace Tests\Feature;

use Tests\TestCase;

class VerifyClientTest extends TestCase
{
    private $accessToken;

    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(11111, 99999),
            'login_by' => 'manual',
            'lang' => 'en',
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
            'Accept' => 'application/josn',
            'Authorization' => $this->accessToken,
        ]);
    }

    /**
     * Test client success verification.
     *
     * @return void
     */
    public function testClientSuccessVerification()
    {
        $response = $this->request([
                        'code' => '55555',
                    ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Test client double verification.
     *
     * @return void
     */
    public function testClientDoubleVerification()
    {
        $this->request([
                        'code' => '55555',
                    ]);
        $response = $this->request([
                        'code' => '55555',
                    ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Test client wrong code verification.
     *
     * @return void
     */
    public function testClientWrongCode()
    {
        $response = $this->request([
                        'code' => '00000',
                    ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }

    /**
     * Test client wrong code exceed verification.
     *
     * @return void
     */
    public function testClientWrongCodeExceed()
    {
        for ($i = 0; $i <= 5; $i++) {
            $response = $this->request([
                                            'code' => '00000',
                                        ]);
        }
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }
}
