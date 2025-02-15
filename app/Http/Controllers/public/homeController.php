<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use Illuminate\Http\Request;


class homeController extends Controller
{
    public function index() {

        $settings = AppSettings::first();

        return view('public.index', [
            'settings' => $settings,
        ]);
    }

}
