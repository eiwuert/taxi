<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('user')->paginate(config('admin.perPage'));
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // client cannot be registered through web application at current moment they should go and
        // register through the mobile application.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // No creation.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // It's showing within the index page.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        flash('Client updated', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        flash('Client soft deleted', 'success');
        return redirect(route('clients.index'));
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function filter(Request $request, Client $clients)
    {
        $clients = $clients->with('user');
        if ($request->status == 'locked') {
            $clients = Client::locked();
        } else if ($request->status == 'unlocked') {
            $clients = Client::unlocked();
        }

        if (isset($request->sortby) && isset($request->orderby) && array_key_exists($request->sortby, Client::$sortable)) {
            $clients = $clients->orderBy($request->sortby, $request->orderby);
        }

        if (isset($request->count)) {
            if ($request->count == 15 || $request->count == 30) {
                $clients = $clients->paginate($request->count);
            } else {
                $clients = $clients->paginate(Client::count());
            }
        } else {
            $clients = $clients->paginate(config('admin.perPage'));
        }

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Lock a client.
     * @param  \App\CLient $client
     * @return redirect
     */
    public function lock(Client $client)
    {
        $client = Client::whereId($client->id)->firstOrFail();
        $client->lock = true;
        $client->update();
        flash('Client locked', 'success');
        return redirect()->route('clients.index');
    }

    /**
     * Unlock client.
     * @param  \App\Client $client
     * @return redirect
     */
    public function unlock(Client $client)
    {
        $client = CLient::whereId($client->id)->firstOrFail();
        $client->lock = false;
        $client->update();
        flash('Client unlocked', 'success');
        return redirect()->route('clients.index');
    }

    /**
     * Search on everything
     * @param  Request $request
     * @return view
     */
    public function search(Request $request)
    {
        // No space after and before the query
        $q = trim($request->q);

        $clients = Client::where('first_name', 'ilike', "%$q%")
                        ->orWhere('last_name', 'ilike', "%$q%")
                        ->orWhere('email', 'ilike', "%$q%")
                        ->orWhere('gender', 'ilike', "%$q%")
                        ->orWhere('state', 'ilike', "%$q%")
                        ->orWhere('country', 'ilike', "%$q%")
                        ->orWhere('address', 'ilike', "%$q%")
                        ->orWhere('zipcode', 'ilike', "%$q%")
                        ->orWhereIn('user_id', User::where('phone', 'ilike', "%$q%")
                                                    ->get(['id'])->flatten())
                        ->paginate(config('admin.perPage'));

        return view('admin.clients.index', compact('clients'));
    }
}
