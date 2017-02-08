<?php

namespace App;

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
}
