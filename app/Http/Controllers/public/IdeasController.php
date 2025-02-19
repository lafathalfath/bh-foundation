<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Ideas;
use App\Models\mProgramType;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function index() {
        $ideas = Ideas::first();
        $program_type = mProgramType::where('name', 'Scholarship')->select('id')->first();
        $scholarship = $program_type->program()->select([
            'id',
            'title',
            'image_url', 
            'description',
            'published_at',
            'views',
        ])->where('published', true)->paginate(10);
        return view('public.ideas', [
            'ideas' => $ideas,
            'scholarship' => $scholarship
        ]);
    }
}
