<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\LocationRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LocationRepoTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
    }

    public function testSet()
    {

        LocationRepository::set(0.0, 0.0);
    }
}
