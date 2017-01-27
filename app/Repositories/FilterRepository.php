<?php

namespace App\Repositories;

use DateTime;
use Carbon\Carbon;

class FilterRepository
{
    /**
     * Add where clause for including records between 2 dates.
     * @param  string $daterange d-m-Ytod-m-Y
     * @param  builder $builder
     * @return builder
     */
    public static function daterange($daterange, $builder)
    {
        $from = DateTime::createFromFormat('d-m-Y', substr($daterange, 0, 10));
        $to   = DateTime::createFromFormat('d-m-Y', substr($daterange, 12, 22));
        if ($from && $to) {
            $from = Carbon::instance($from)->startOfDay();
            $to   = Carbon::instance($to)->endOfDay();
            $builder = $builder->whereDate('created_at', '>=', $from)
                               ->whereDate('created_at', '<=', $to);
        }
        return $builder;
    }
}
