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
                            ->whereNull('car_type_id')->get(['name', 'icon', 'id', 'position']);
        foreach ($parents as $parent) {
            if ($parent->children()->whereActive(true)->exists()) {
                $parent->position = (int) $parent->position;
                $parent->children = $parent->children()->whereActive(true)->get(['name', 'icon', 'id', 'position']);
                foreach ($parent->children as $child) {
                    $child->parent_id = $parent->id;
                    $child->position = (int) $child->position;
                }
                $types[] = $parent;
            } else {
                unset($parent);
            }
        }
        // Remove parent ID
        // foreach ($parents as $parent) {
        //     unset($parent->id);
        // }
        // 
        // TO BE FIXED
        // 
        $order = ['فلیپ', 'فلیپ لاکچری', 'فلیپ بانوان', 'فلیپ موتوری', 'فلیپ باربری'];
        usort($types, function ($a, $b) use ($order) {
            $pos_a = array_search($a['name'], $order);
            $pos_b = array_search($b['name'], $order);
            return $pos_a - $pos_b;
        });
        return ok($types, 200, [], false);

        // $types = [];
        // $carTypes = CarType::whereActive(true)->parents();
        // foreach ($carTypes->get() as $carType) {
        //     $types[$carType->name] = $carType;
        // }
        // foreach ($carTypes->get() as $carType) {
        //     foreach ($carType->children()->get() as $child) {
        //         if ($child->active) {
        //             $types[$carType->name][] = $child;
        //         }
        //     }
        // }

        // return ok($types, 200, [], false);
    }
}
