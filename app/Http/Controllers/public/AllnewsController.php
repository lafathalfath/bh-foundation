<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class AllnewsController extends Controller
{
    public function index()
    {
        // Data Dummy
        $news = collect(range(1, 50))->map(function ($i) {
            return (object) [
                'title' => "Judul Berita $i",
                'description' => "Ini adalah deskripsi singkat dari berita nomor $i.",
                'date' => "2025-02-14",
                'image' => "https://stpbogor.ac.id/wp-content/uploads/2024/10/kerjasama-stp-bogor-quail-center-e1728016964606.jpg"
            ];
        });

        // Custom Pagination untuk Collection
        $perPage = 9;
        $currentPage = request()->get('page', 1);
        $currentItems = $news->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedNews = new LengthAwarePaginator(
            $currentItems,
            $news->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('public.allnews', ['allnews' => $paginatedNews]);
    }
}
