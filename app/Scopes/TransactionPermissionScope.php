<?php

namespace App\Scopes;

use Auth;
use App\Trip;
use App\Driver;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TransactionPermissionScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (is_null(Auth::user()) || Auth::user()->role != 'web') {
            return;
        }
        $permissions = Auth::user()->web->permissions;
        if (! in_array(0, $permissions)) {
            $drivers = Driver::whereIn('state', $permissions)
                            ->get(['id'])->flatten();
            $trips = Trip::whereIn('driver_id', $drivers)
                            ->get(['id'])->flatten();
            $builder->whereIn('trip_id', $trips);
        }
    }
}
