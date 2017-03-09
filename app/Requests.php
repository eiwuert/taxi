<?php

namespace App;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Requests extends Model
{
    protected $fillable = [
        'duration',
        'url',
        'method',
        'ip',
        'locale',
        'languages',
        'charsets',
        'encodings',
        'isXml',
        'proxies',
        'parameters',
    ];

    protected $connection = 'mongodb';

    /**
     * Extracting time _id object
     * @param  string $value
     * @return string
     */
    public function getDiffAttribute($value)
    {
        // Extract timestamps from MongoDB ID
        $timestamps = hexdec(substr((string) $this->id, 0, 8));
        return Carbon::createFromTimestamp($timestamps)->diffForHumans();
    }
}
