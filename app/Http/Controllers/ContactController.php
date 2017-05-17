<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest as Request;

class ContactController extends Controller
{
    /**
     * Create a new contact.
     * @param  Request $request
     * @return Illuminate\Support\Facades\Redirect
     */
    public function store(Request $request)
    {
        Contact::create($request->all());
        flash(__('contacts.Form has been submitted'));
        return redirect()->back();
    }
}
