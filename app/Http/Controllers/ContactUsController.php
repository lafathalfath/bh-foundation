<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Mail\ContactUsNotificationMail;

class ContactUsController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validasi input
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Ambil data dari form
        $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'message']);

        // Kirim email ke admin
        Mail::to('pr@bh-foundation.org')->send(new ContactUsMail($data));

        // Kirim email notifikasi ke pengirim
        Mail::to($data['email'])->send(new ContactUsNotificationMail($data));

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
