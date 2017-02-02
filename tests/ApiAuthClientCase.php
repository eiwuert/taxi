<?php

class ApiAuthClientCase extends TestCase
{
    private $accessToken;

    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/client/register', [
            'phone' => rand(11111111, 999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
        ]);

        $this->accessToken = $response->getOriginalContent()['data'][0]['token_type'] . ' ' . 
                             $response->getOriginalContent()['data'][0]['access_token'];
        \Log::info($this->accessToken);
    }

    /**
     * Send authorized request.
     * @param  array  $data
     * @param  string  $url
     * @param  string $method
     * @return MakesHttpRequests
     */
    public function request($url, $method = 'GET', $data = array())
    {
        return $this->json($method, 'api/client/' . $url, $data, [
            'Accept' => 'application/josn',
            'Authorization' => $this->accessToken,
        ]);
    }
}
