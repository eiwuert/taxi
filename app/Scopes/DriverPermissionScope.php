<?php

namespace App\Scopes;

use Auth;
use App\User;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DriverPermissionScope implements Scope
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
            $builder->whereIn('state', $permissions)
                    ->whereIn('user_id', User::whereVerified(true)
                                            ->where('role', 'driver')
                                            ->get(['id'])->flatten());
        } else {
            $builder->whereIn('user_id', User::whereVerified(true)
                                        ->where('role', 'driver')
                                        ->get(['id']));
        }
    }
}
