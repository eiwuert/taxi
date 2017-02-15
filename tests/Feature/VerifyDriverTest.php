<?php
namespace Tests\Feature;

use Tests\TestCase;

class VerifyDriverTest extends TestCase
{
    private $accessToken;

    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(11111, 99999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'country' => 'Iran',
            'state' => 'Isfahan'
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
            'Accept' => 'application/josn',
            'Authorization' => $this->accessToken,
        ]);
    }

    /**
     * Test driver success verification.
     *
     * @return void
     */
    public function testDriverSuccessVerification()
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
     * Test driver double verification.
     *
     * @return void
     */
    public function testDriverDoubleVerification()
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
     * Test driver wrong code verification.
     *
     * @return void
     */
    public function testDriverWrongCode()
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
     * Test driver wrong code exceed verification.
     *
     * @return void
     */
    public function testDriverWrongCodeExceed()
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
