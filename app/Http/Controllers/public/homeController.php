<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\FrontPage;
use App\Models\mProgramType;
use App\Models\Program;
use Illuminate\Http\Request;


class homeController extends Controller
{
    public function index() {

        $settings = AppSettings::first();
        $front_page = FrontPage::first();
        // $programs = Program::select(['id', 'image_url', 'title', 'description'])->get();
        $program_type = mProgramType::where('name', 'News')->select('name')->first();
        $news = $program_type->program->select([
            'id',
            'title',
            'image_url', 
            'description',
            'views'
        ]);
        return view('public.index', [
            'settings' => $settings,
            'front_page' => $front_page,
            'news' => $news,
        ]);
    }

}
