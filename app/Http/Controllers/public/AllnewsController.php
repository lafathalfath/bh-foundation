<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\mProgramType;
use App\Models\Program;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AllnewsController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'news');
        $category = $request->query('category'); // ✅ ambil category dari query
        $settings = AppSettings::select([
            'primary_color',
            'secondary_color',
            'accent_color',
            'info_color'
        ])->first();

        $query = Program::where('published', true);

        if (strtolower($type) !== 'all') {
            $programType = mProgramType::where('name', ucfirst($type))->first();

            if (!$programType) {
                return back()->with('error', 'Jenis pencarian tidak ditemukan.');
            }

            $query->where('type_id', $programType->id);
        }

        //  filter berdasarkan category jika ada
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', 'like', '%' . str_replace('-', ' ', $category) . '%');
            });
        }

        $allnews = $query->orderBy('id', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('public.allnews', [
            'allnews' => $allnews,
            'news' => $allnews,
            'programs' => $allnews,
            'scholarship' => $allnews,
            'type' => $type,
            'settings' => $settings,
            'category' => $category,
        ]);
    }
}