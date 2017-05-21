<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * Table name.
     * @var string
     */
    protected $table = 'currencies';

    /**
     * Mass assignable columns.
     * @var array
     */
    protected $fillable = ['name', 'symbol'];

    /**
     * A currency can have many fares.
     *
     * @return Illuminate\Database\Eloquent\Concerns\haveMany
     */
    public function fares()
    {
        return $this->haveMany('App\Fare');
    }
}
