<?php

namespace App;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Requests extends Model
{
    protected $fillable = ['duration', 'url', 'method', 'ip', 'locale', 'languages', 'charsets',
        'encodings', 'isXml', 'proxies', 'parameters', 'created_at'];

    protected $connection = 'mongodb';

    /**
     * Extracting time _id object
     * @param  string $value
     * @return string
     */
    public function getIdAttribute($value)
    {
        return Carbon::createFromTimestamp($value->getTimestamp())->diffForHumans();
    }
}
