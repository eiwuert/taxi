<?php

namespace App;

use Carbon\Carbon;
use \MongoDB\BSON\ObjectID;
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
        $id = new ObjectID($this->id);
        $timestamp = hexdec(substr($id, 0, 8));
        return Carbon::createFromTimestamp($timestamp)->diffForHumans();
    }

    /**
     * Create MongoDB object ID
     * @param  string $timestamp
     * @return string
     */
    public static function createId($timestamp)
    {
        static $inc = 0;

        $ts = pack('N', $timestamp);
        $m = substr(md5(gethostname()), 0, 3);
        $pid = pack('n', posix_getpid());
        $trail = substr(pack('N', $inc++), 1, 3);

        $bin = sprintf("%s%s%s%s", $ts, $m, $pid, $trail);

        $id = '';
        for ($i = 0; $i < 12; $i++) {
            $id .= sprintf("%02X", ord($bin[$i]));
        }
        return new ObjectID($id);
    }
}
