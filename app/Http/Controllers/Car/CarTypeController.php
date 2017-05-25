<?php

namespace App\Http\Controllers\Car;

use App\CarType;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarTypeController extends Controller
{
    /**
     * Get all available car types.
     * @return json
     */
    public function all()
    {
        $types = [];
        $parents =  CarType::whereActive(true)
                            ->whereNull('car_type_id')->get(['name', 'icon', 'id']);
        foreach ($parents as $parent) {
            if ($parent->children()->whereActive(true)->exists()) {
                $parent->children = $parent->children()->whereActive(true)->get(['name', 'icon', 'id']);
                $types[] = $parent;
            } else {
                unset($parent);
            }
        }
        foreach ($parents as $parent) {
            unset($parent->id);
        }

        return ok($types);

        $types = [];
        $carTypes = CarType::whereActive(true)->parents();
        foreach ($carTypes->get() as $carType) {
            $types[$carType->name] = $carType;
        }
        foreach ($carTypes->get() as $carType) {
            foreach ($carType->children()->get() as $child) {
                if ($child->active) {
                    $types[$carType->name][] = $child;
                }
            }
        }

        return ok($types, 200, [], false);
    }
}
