<?php

namespace App\Http\Controllers\Admin;

use Cache;
use App\Zone;
use App\Fare;
use App\CarType;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FareRequest as Request;

class FareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fares = Fare::orderBy('id', 'desc')
                    ->paginate(config('admin.perPage'));
        return view('admin.fares.index', compact('fares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::pluck('name', 'id');
        $types = CarType::get();
        $currencies = Currency::pluck('name', 'id');
        $fare = Fare::where('zone_id', Zone::whereName('default')->first()->id)
                    ->where('currency_id', Currency::whereName('default')->first()->id)->first();
        if (is_null($fare)) {
            $fare = config('fare')['IRR'];
        }
        return view('admin.fares.create', compact('zones', 'types', 'currencies', 'fare'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zones = Zone::pluck('name', 'id');
        $types = CarType::get();
        $currencies = Currency::pluck('name', 'id');
        if (Fare::where('currency_id', $request->currency_id)
                ->where('zone_id', $request->zone_id)->exists()) {
            $fare = $request->all();
            flash(__('admin/general.Fare with this zone and currency already exists'));
            return view('admin.fares.create', compact('fare', 'currencies', 'zones', 'types'));
        } else {
            $fare = Fare::create($request->all());
            flash(__('admin/general.Fare created'));
            Cache::forever(config('app.name') . '_fare_' . $request->zone_id, $request->cost);
            return view('admin.fares.edit', compact('fare', 'currencies', 'zones', 'types'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function show(Fare $fare)
    {
        return view('admin.fares.show', compact('fare'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fare $fare
     * @return \Illuminate\Http\Response
     */
    public function edit(Fare $fare)
    {
        $zones = Zone::pluck('name', 'id');
        $types = CarType::get();
        $currencies = Currency::pluck('name', 'id');
        return view('admin.fares.edit', compact('fare', 'zones', 'currencies', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fare $fare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fare $fare)
    {
        $zones = Zone::pluck('name', 'id');
        $types = CarType::get();
        $currencies = Currency::pluck('name', 'id');
        if ($fare->zone->name == 'default' && $fare->currency->name == 'default' && 
           ($request->currency_id != $fare->currency->id || $request->zone_id != $fare->zone->id)) {
            flash(__('admin/general.Can\'t update default record'));
            return view('admin.fares.edit', compact('fare', 'currencies', 'zones', 'types'));
        }
        $fare->update($request->all());
        Cache::forever(config('app.name') . '_fare_' . $request->zone_id, $request->cost);
        flash(__('admin/general.Fare updated'));
        return view('admin.fares.edit', compact('fare', 'currencies', 'zones', 'types'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fare $fare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fare $fare)
    {
        $fare->delete();
        flash(__('admin/general.Fare has been deleted'));
        return redirect()->route('fares.index');
    }

    public function calculator()
    {
        return view('admin.fares.calculator');
    }
}
