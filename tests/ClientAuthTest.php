<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class ClientAuthTest extends TestCase
{
	/**
	 * Client instance.
	 * 
	 * @var App/User
	 */
	private $client;

	/**
	 * At the begining of the test.
	 * 
	 * @return void
	 */
	public function setUp()
	{
    	parent::createApplication();

		// Remove user test in setup
		User::where('email', 'phpunit@php.net')
			->delete();

		$this->client = $this->json('POST', 'api/client/register', [
							'first_name' => 'amirmasoud',
							'last_name'  => 'sheydaei',
							'sex'        => 'male',
							'email'		 => 'phpunit32@php.net',
							'password'   => '123456',
							'device_type'=> 'web',
						]);
	}

	/**
	 * At the end of the test.
	 * 
	 * @return void
	 */
	public function tearDown() {
		// Remove user test in teardown
		User::where('email', 'phpunit@php.net')
			->andWhere('role', 'client')
			->delete();
	}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTokenGenration()
    {
    	//ClientController::token();
        $this->assertTrue(true);
    }

    public function testRegistration()
    {
		$this->client->seeJson();
    }
}
