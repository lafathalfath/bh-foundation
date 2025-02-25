<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ManageContactController extends Controller
{
    public function index() {
        $contact = Contact::first();
        return view('admin.contact.index', [
            'contact' => $contact
        ]);
    }

    public function update(Request $req){
        $req->validate([
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ]);

        $data = [
            'description' => $req->description,
            'address' => $req->address,
            'phone' => $req->phone,
            'email' => $req->email,
        ];

        $contact = Contact::first();
        $contact->update($data);
        return back()->with('success', 'Contact Updating Successful');
    }
}
