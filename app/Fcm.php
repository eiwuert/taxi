<?php

namespace App;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Fcm extends Model
{
    /**
     * Fillable columns.
     * @var array
     */
    protected $fillable = [
        'multicast_id',
        'success',
        'failure',
        'canonical_ids',
        'results',
        'head',
        'device_token',
        'title',
        'message',
        'created_at',
    ];

    /**
     * Table name
     * @var string
     */
    protected $table = 'fcm';

    /**
     * MongoDB
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * Extracting time _id object
     * @param  string $value
     * @return string
     */
    public function getDateAttribute($value)
    {
        $id = new \MongoDB\BSON\ObjectID($this->id);
        $timestamp = hexdec(substr($id, 0, 8));
        return Carbon::createFromTimestamp($timestamp)->diffForHumans();
    }
}
