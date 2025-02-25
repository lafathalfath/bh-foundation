<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\AppSettings;
use App\Models\mMemberLevel;
use App\Models\mProgramType;
use App\Models\mCategory;
use App\Models\Partner;
use App\Models\Program;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $settings = AppSettings::first();
        $about = AboutPage::first();
        $member_level = mMemberLevel::get();
        // $programs = Program::paginate(4);
        $partners = Partner::paginate(8);
        $category = mCategory::select(['id', 'name'])->get();
        $program_type = mProgramType::where('name', 'Programs')->select('id')->first();
        $programs = $program_type->program()->select([
            'id',
            'title',
            'image_url', 
            'description',
            'published_at',
            'views',
        ])->where('published', true)->paginate(4);
        return view('public.about_us', [
            'settings' => $settings,
            'about' => $about,
            'member_level' => $member_level,
            'programs' => $programs,
            'partners' => $partners,
            'category' => $category,
        ]);
    }
}
