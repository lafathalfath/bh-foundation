<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Ideas;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function index() {
        $ideas = Ideas::first();
        return view('public.ideas', [
            'ideas' => $ideas
        ]);
    }
}
