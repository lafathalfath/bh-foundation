<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\FrontPage;
use Illuminate\Http\Request;


class homeController extends Controller
{
    public function index() {

        $settings = AppSettings::first();
        $front_page = FrontPage::first();
        return view('public.index', [
            'settings' => $settings,
            'front_page' => $front_page,
        ]);
    }

}
