<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Shows fa frontend index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function fa()
    {
        return view('frontend.index');
    }

    /**
     * Shows fa frontend terms page.
     *
     * @return \Illuminate\Http\Response
     */
    public function faTerms()
    {
        return view('frontend.terms');
    }

    /**
     * Shows en frontend index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function en()
    {
        return view('frontend.en.index');
    }
    
    /**
     * Shows en frontend terms page.
     *
     * @return \Illuminate\Http\Response
     */
    public function enTerms()
    {
        return view('frontend.en.terms');
    }
}
