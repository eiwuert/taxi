<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Test client success registration.
     *
     * @return void
     */
    public function testClientSuccessRegister()
    {
        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'state' => '1',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Test client phone missed registration. 
     * @return void
     */
    public function testClientPhoneMissedRegister()
    {
        $response = $this->json('POST', '/api/v1/client/register', [
            // 'phone' => rand(1111111111, 9999999999), Phone is missed
            'login_by' => 'manual',
            'lang' => 'en',
            'state' => '1',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }

    /**
     * Test client login by, lang, device type and device token are missed registration. 
     * @return void
     */
    public function testClientLoginByLangDeviceTypeAndDeviceTokenMissedRegister()
    {
        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(1111111111, 9999999999),
            // 'login_by' => 'manual',
            // 'lang' => 'en',
            // 'device_type' => 'ios',
            // 'device_token' => 'sample_device_token_from_phpunit',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }

    /**
     * Test client login by, lang, device type and device token are missed registration. 
     * @return void
     */
    public function testClientWithExtraFieldsRegister()
    {
        $response = $this->json('POST', '/api/v1/client/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'state' => '1',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'field' => 'data',
            'another_field' => 'another data',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Test driver success registration.
     *
     * @return void
     */
    public function testDriverSuccessRegister()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'country' => 'Iran',
            'state' => '1',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Test driver phone missed registration. 
     * @return void
     */
    public function testDriverPhoneMissedRegister()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            // 'phone' => rand(1111111111, 9999999999), Phone is missed
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'country' => 'Iran',
            'state' => '1',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }

    /**
     * Test driver login by, lang, device type and device token are missed registration. 
     * @return void
     */
    public function testDriverLoginByLangDeviceTypeCountryStateAndDeviceTokenMissedRegister()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(1111111111, 9999999999),
            // 'login_by' => 'manual',
            // 'lang' => 'en',
            // 'device_type' => 'ios',
            // 'device_token' => 'sample_device_token_from_phpunit',
            // 'country' => 'Iran',
            // 'state' => '1',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }

    /**
     * Test driver login by, lang, device type and device token are missed registration. 
     * @return void
     */
    public function testDriverWithExtraFieldsRegister()
    {
        $response = $this->json('POST', '/api/v1/driver/register', [
            'phone' => rand(1111111111, 9999999999),
            'login_by' => 'manual',
            'lang' => 'en',
            'device_type' => 'ios',
            'device_token' => 'sample_device_token_from_phpunit',
            'field' => 'data',
            'another_field' => 'another data',
            'country' => 'Iran',
            'state' => '1',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
