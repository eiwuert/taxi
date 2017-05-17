<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Get all contacts.
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')
                            ->paginate(config('admin.perPage'));
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show contact info.
     * 
     * @param  Contact $contact
     * @return Illuminate\Support\Facades\Redirect
     */
    public function destroy(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Delete a contact info
     * 
     * @param  Contact $contact
     * @return Illuminate\Support\Facades\Redirect
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        flash(__('admin/general.Contact deleted'), 'success');
        return redirect(route('contacts.index'));
    }
}
