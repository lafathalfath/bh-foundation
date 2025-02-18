<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        $contact = Contact::first();
        return view('public.contact', [
            'contact' => $contact
        ]);
    }
}
