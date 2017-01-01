<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TripTest extends TestCase
{
	use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRequestTaxi()
    {
        $this->assertTrue(true);
    }
}
