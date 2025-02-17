<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FrontPage;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index() {
        $front_page = FrontPage::first();
        return view('admin.front_page.index', [
            'front_page' => $front_page
        ]);
    }
}
