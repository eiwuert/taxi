<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DriverTest extends TestCase
{
	use WithoutMiddleware;

    /**
     * Test driver registeration.
     *
     * @return void
     */
    public function testRegisterDriver()
    {
        $this->json('POST', '/api/driver/register', [
        			'password' => '123456',
        			'phone' => '1234567890',
        			'lang' => 'fa',
        			'country' => 'iran',
        			'state' => 'esfahan',
        			'device_token' => 'jdh1432jJfhsdfjwo',
        			'device_type' => 'ios',
        			'login_by' => 'manual',
        		])
             ->seeJson([
                 'success' => true,
             ]);
    }

    /**
     * Test driver registeration.
     *
     * @return void
     */
    public function testRegisterDriverValidation()
    {
        $this->json('POST', '/api/driver/register', [
        			'password' => '123456',
        			'phone' => '1234567890',
        			'lang' => 'fa',
        			'country' => 'iran',
        			'state' => 'esfahan',
        			'device_token' => 'jdh1432jJfhsdfjwo',
        			'device_type' => 'ios',
        			'login_by' => 'manual',
        		])
             ->seeJson([
                 'success' => false,
             ]);
    }

    /**
     * Test driver registeration.
     *
     * @return void
     */
    public function testRegisterDriverValidationRequiredFields()
    {
        $this->json('POST', '/api/driver/register', [
        			'password' => '123456',
        			//'phone' => '1234567890',
        			'lang' => 'fa',
        			'country' => 'iran',
        			'state' => 'esfahan',
        			'device_token' => 'jdh1432jJfhsdfjwo',
        			'device_type' => 'ios',
        			'login_by' => 'manual',
        		])
             ->seeJson([
                 'success' => false,
             ]);
    }

    /**
     * Test driver successful login.
     *
     * @return void
     */
    public function testLoginDriver()
    {
        $this->json('POST', '/api/driver/login', [
        			'password' => '123456',
        			'phone' => '1234567890',
        		])
             ->seeJson([
                 'success' => true,
             ]);
    }

    /**
     * Test driver failure login.
     *
     * @return void
     */
    public function testFailureLoginDriver()
    {
        $this->json('POST', '/api/driver/login', [
        			'password' => '12345600000',
        			'phone' => '1234567890',
        		])
             ->seeJson([
                 'success' => false,
             ]);
    }

    /**
     * Test driver go online.
     *
     * @return void
     */
    public function testDriverGoOnline()
    {
    	$user = App\User::find(1);
    	$this->actingAs($user)
    		 ->json('GET', '/api/driver/online')
             ->seeJson([
                 'success' => true,
             ]);
    }

    /**
     * Test driver go onway.
     *
     * @return void
     */
    public function testDriverGoOnway()
    {
    	$user = App\User::find(1);
    	$this->actingAs($user)
    		 ->json('GET', '/api/driver/onway')
             ->seeJson([
                 'success' => true,
             ]);
    }

    /**
     * Test driver cannot go offline.
     *
     * @return void
     */
    public function testDriverCannotGoOffline()
    {
    	$user = App\User::find(1);
    	$this->actingAs($user)
    		 ->json('GET', '/api/driver/offline')
             ->seeJson([
                 'success' => false,
             ]);
    }

    /**
     * Test driver cannot go online.
     *
     * @return void
     */
    public function testDriverCannotGoOnline()
    {
    	$user = App\User::find(1);
    	$this->actingAs($user)
    		 ->json('GET', '/api/driver/online')
             ->seeJson([
                 'success' => false,
             ]);
    }

    /**
     * Test driver go available.
     *
     * @return void
     */
    public function testDriverGoAvailable()
    {
    	$user = App\User::find(1);
    	$this->actingAs($user)
    		 ->json('GET', '/api/driver/available')
             ->seeJson([
                 'success' => true,
             ]);
    }

    /**
     * Test driver go offline.
     *
     * @return void
     */
    public function testDriverGoOffline()
    {
    	$user = App\User::find(1);
    	$this->actingAs($user)
    		 ->json('GET', '/api/driver/offline')
             ->seeJson([
                 'success' => true,
             ]);
    }
}
