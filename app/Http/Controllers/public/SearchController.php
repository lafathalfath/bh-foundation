<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\AboutPage;
use App\Models\Program;
use App\Models\mProgramType;
use App\Models\Ideas;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type', '');
        $settings = AppSettings::first();

        $query = Program::where('published', true);

        $resolvedType = $type;

        if ($type && strtolower($type) !== 'all') {
            $programType = mProgramType::where('name', ucfirst($type))->first();
            if (!$programType) {
                return back()->with('error', 'Jenis pencarian tidak ditemukan.');
            }

            $query->where('type_id', $programType->id);
        }

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $results = $query->orderBy('id', 'desc')->paginate(9)->appends([
            'search' => $search,
            'type' => $type,
        ]);

        // Kalau type adalah 'all', kita coba cari type dari hasil pertama (jika ada)
        if (strtolower($type) === 'all' && $results->count() > 0) {
            $firstItem = $results->first();
            $typeModel = mProgramType::find($firstItem->type_id);
            if ($typeModel) {
                $resolvedType = strtolower($typeModel->name);
            }
        }

        return view('public.allnews', [
            'allnews' => $results,
            'programs' => $results,
            'scholarship' => $results,
            'results' => $results,
            'type' => $resolvedType, 
            'settings' => $settings,
        ]);
    }



    public function check(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $typesToSearch = [];

        if ($type && strtolower($type) !== 'all') {
            $typesToSearch = explode(',', $type);
        } else {
            $typesToSearch = ['news', 'programs', 'scholarship'];
        }

        foreach ($typesToSearch as $typeName) {
            $programType = mProgramType::where('name', ucfirst($typeName))->first();

            if (!$programType) {
                continue;
            }

            $found = Program::where('type_id', $programType->id)
                ->where('published', true)
                ->where('title', 'like', '%' . $search . '%')
                ->exists();

            if ($found) {
                return response()->json(['found' => true]);
            }
        }

        return response()->json(['found' => false]);
    }



}

