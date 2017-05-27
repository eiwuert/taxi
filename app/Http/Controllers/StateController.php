<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        return ok(State::all());
    }

    public function active()
    {
        $activeStates = State::where('active',true)->get(['id','name']);
        return ok($activeStates);
    }

    public function get(State $state){
        return ok($state);
    }
}
