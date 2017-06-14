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
            ->whereNull('car_type_id')->get(['name', 'icon', 'id', 'position','slug']);

        foreach ($parents as $parent) {
            if ($parent->children()->whereActive(true)->exists()) {
                $parent->position = (int) $parent->position;
                $parent->children = $parent->children()->whereActive(true)->get(['name', 'icon', 'id', 'position','slug']);
                foreach ($parent->children as $child) {
                    $child->parent_id = $parent->id;
                    $child->position = (int) $child->position;
                    $child->name = __('car_types.' . $child->slug);
                    unset($child->slug);
                }
                $parent->name = __('car_types.' . $parent->slug);
                unset($parent->slug);
                $types[] = $parent;
            } else {
                unset($parent);
            }
        }

        return ok($types, 200, [], false);

    }

}
