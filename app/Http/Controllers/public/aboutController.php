<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\AppSettings;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $settings = AppSettings::first();
        $about = AboutPage::first();
        return view('public.about_us', [
            'settings' => $settings,
            'about' => $about,
        ]);
    }
}
