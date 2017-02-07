<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class Requests extends Model
{
    protected $fillable = ['duration', 'url', 'method', 'ip', 'locale', 'languages', 'charsets',
        'encodings', 'isXml', 'proxies', 'parameters'];

    protected $connection = 'mongodb';
}
