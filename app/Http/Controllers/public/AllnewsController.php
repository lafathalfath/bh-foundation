<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\mProgramType;
use App\Models\Program;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class AllnewsController extends Controller
{
    public function index()
    {
        $program_type_id = mProgramType::where('name', 'News')->first();
        if (!$program_type_id) return back();
        $program_type_id = $program_type_id->id;
        $allnews = Program::where('type_id', $program_type_id)
            ->where('published', true)
            ->orderBy('id', 'desc')
            ->paginate(9);
        $settings = AppSettings::select([
            'primary_color',
            'secondary_color',
            'accent_color',
            'info_color'
        ])->first();
        return view('public.allnews', [
            'allnews' => $allnews,
            'settings' => $settings,
        ]);
    }
}
