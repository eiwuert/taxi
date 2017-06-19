<?php

namespace App\Repositories;

use App\Zone;

class ZoneRepository
{
    /**
     * Send a new text message.
     * @param  numeric $to
     * @param  string $message
     * @return boolean
     */
    public static function cities()
    {
        $zones = \App\Zone::where('name', '!=', 'default')->get();
        $cities = [];
        foreach ($zones as $zone) {
            $coordinates = [];
            foreach ($zone->coordinates->geometries[0]->coordinates[0][0] as $c) {
                $coordinates[] = ['lat' => $c[1], 'lng' => $c[0]];
            }
            $cities[] = $coordinates;
        }
        return js_json($cities);
    }
}
