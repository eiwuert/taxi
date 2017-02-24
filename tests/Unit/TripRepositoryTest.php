<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\TripRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TripRepositoryTest extends TestCase
{
    /**
     * Test minMultiTripLimit
     *
     * @return void
     */
    public function testMinMultiTripLimit()
    {
        $this->assertTrue(TripRepository::minMultiTripLimit([1]));
        $this->assertFalse(TripRepository::minMultiTripLimit([1,2]));
    }

    /**
     * Test maxMultiTripLimit
     *
     * @return void
     */
    public function testMaxMultiTripLimit()
    {
        $this->assertFalse(TripRepository::maxMultiTripLimit(array_fill(0, 19, 'value')));
        $this->assertFalse(TripRepository::maxMultiTripLimit(array_fill(0, 20, 'value')));
        $this->assertTrue(TripRepository::maxMultiTripLimit(array_fill(0, 21, 'value')));
    }

    /**
     * Test is s_lat and s_long
     * @return void
     */
    public function testIsSlatAndSlong()
    {
        $location = ['s_lat' => 0.0, 's_long' => 0.0];
        $this->assertFalse(TripRepository::isSlatAndSlong(((object)$location)));
        $location = ['s_lat' => 0.0, 's_lng' => 0.0];
        $this->assertTrue(TripRepository::isSlatAndSlong(((object)$location)));
    }

    /**
     * Test d_lat and d_long
     * @return void
     */
    public function testIsDlatAndDlong()
    {
        $location = ['d_lat' => 0.0, 'd_long' => 0.0];
        $this->assertFalse(TripRepository::isDlatAndDlong(((object)$location)));
        $location = ['d_lat' => 0.0, 'd_lng' => 0.0];
        $this->assertTrue(TripRepository::isDlatAndDlong(((object)$location)));
    }

    /**
     * Test preg_match lat and long method
     * @return void
     */
    public function testPregMatchLatAndLong()
    {
        $location = ['lat' => '0.0', 'long' => '0.0'];
        $this->assertTrue(TripRepository::pregMatchLatAndLong(((object)$location)));

        $location = ['lat' => '-0.0', 'long' => '-0.0'];
        $this->assertTrue(TripRepository::pregMatchLatAndLong(((object)$location)));

        $location = ['lat' => '-0.0', 'long' => '+0.0'];
        $this->assertTrue(TripRepository::pregMatchLatAndLong(((object)$location)));

        $location = ['lat' => 'fafaf', 'long' => '0.gdfsg'];
        $this->assertFalse(TripRepository::pregMatchLatAndLong(((object)$location)));
    }

    /**
     * Test is destinations valid function.
     * @return void
     */
    public function testIsDestinationsValid()
    {
        $route = [
                    (object)(['s_lat' => '0.0', 's_long' => '0.0']),
                    (object)(['d_lat' => '0.0', 'd_long' => '0.0']),
                    (object)(['d_lat' => '0.0', 'd_long' => '0.0'])
                ];
        $this->assertTrue(TripRepository::isDestinationsValid($route));

        $route = [
                    (object)(['s_lat' => '0.0', 's_long' => '0.0']),
                    (object)(['d_lat' => '0.0', 'd_long' => '0.0']),
                    (object)(['d_lat' => '0.0', 'd_lng' => '0.0'])
                ];
        $this->assertFalse(TripRepository::isDestinationsValid($route));
    }
}
