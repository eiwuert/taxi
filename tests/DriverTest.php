<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DriverTest extends TestCase
{
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
}
