<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accounting extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['balance', 'currency', 'debit', 'credit'];

    /**
     * A accounting record can belong to a driver.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }
}
