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
        $zones = Zone::where('name', '!=', 'default')->get();
        $cities = [];
        foreach ($zones as $zone) {
            $cities[] = [
                'center' => ['lat' => $zone->latitude, 'lng' => $zone->longitude],
                'radius' => $zone->radius * (($zone->unit == 'kilometer') ? 1000 : 1609.33999997549),
            ];
        }
        return js_json($cities);
    }
}
