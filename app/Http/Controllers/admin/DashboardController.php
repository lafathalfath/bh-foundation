<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\AboutPage;
use App\Models\Member;
use App\Models\mMemberLevel;
use App\Models\mProgramType;
use App\Models\mCategory;
use App\Models\Partner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalArticles = Program::count();
        $totalArticlesCat = mCategory::count();
        $totalArticlesType = mProgramType::count();
        $totalMember = Member::count();
        $totalPartner = Partner::count();
        return view('admin.dashboard.index', compact('totalArticles', 'totalArticlesCat', 'totalArticlesType', 'totalMember', 'totalPartner'));
    }
}
