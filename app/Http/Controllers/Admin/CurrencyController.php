<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CurrencyRequest as Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::orderBy('id', 'desc')
                          ->paginate(config('admin.perPage'));
        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currency = Currency::create($request->all());
        flash(__('admin/general.Currency created'));
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view('admin.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $currency->update($request->all());
        flash(__('admin/general.Currency updated'));
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        flash(__('admin/general.Currency deleted'));
        return redirect()->route('currencies.index');
    }
}
