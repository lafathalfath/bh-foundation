<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function index() {
        return view('public.ideas');
    }
}
