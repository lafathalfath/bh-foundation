@extends('layout.public')
@section('content')
<style>
.hover-translate:hover {
    transform: translateY(-10px) !important;
}
</style>

    <main class="container mx-auto px-5 md:px-9">
        <!-- Grid Berita -->
        <section class="py-20 ">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @forelse ($allnews as $nw)
                    @php
                        $views = strval($nw->views);
                        if (strlen($views) >= 4 && strlen($views) < 7) $views = substr($views, 0, strlen($views)-3)."K";
                        if (strlen($views) >= 7 && strlen($views) < 10) $views = substr($views, 0, strlen($views)-6)."M";
                        if (strlen($views) >= 10) $views = substr($views, 0, strlen($views)-9)."B";
                    @endphp
                    <div class="border rounded-lg overflow-hidden shadow-md hover-translate" data-aos="zoom-in">
                        <figure class="w-full h-60 bg-gray-300 overflow-hidden border rounded-t-xl flex items-center justify-center">
                            <img src="{{ $nw->image_url }}"
                                alt="News Image" class="w-full h-full object-cover  ">
                        </figure>
                        <div class="card-body">
                            <h3 class="card-title">{{ translate($nw->title, session('locale', 'en')) }}</h3>
                            <p class="w-full h-7 overflow-hidden text-start text-gray-600">{{ translate($nw->description, session('locale', 'en')) }}</p>
                            <p class="w-full text-start text-gray-500">{{ substr($nw->published_at, 0, 10) }}</p>
                            <div class="w-full flex justify-end">
                                {{ $views }} @lang('messages.views')
                            </div>
                            <a href="{{ route('article', [
                                'type' => 'news',
                                'id' => Crypt::encryptString($nw->id)
                            ]) }}" class="btn btn-outline btn-warning mt-4">
                                @lang('messages.read_more')
                            </a>
                        </div>
                    </div>
                @empty
                    <div>@lang('messages.empty')</div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @php
                $current = $allnews->currentPage();
                $lastpage = $allnews->lastPage();
                $first = $current == 1;
                $last = $current == $lastpage;
                $total = $allnews->total();
                $start = 1;
                $show = 0;
                if ($lastpage == 1) $show = $total;
                else {
                    $start = $current * $allnews->perPage() + 1;
                    $show = $total - ($allnews->perPage() * ($allnews->lastPage() - 1));
                }
                $startpage = 1;
                $endpage = 1;
                if ($lastpage <= 11) $endpage = $lastpage;
                else {
                    if ($current <= 6) $startpage = 1;
                    else $startpage = $current - 6;

                    if ($current + 5 <= $lastpage) $endpage = $lastpage;
                    else $endpage = $current + 5;
                }
            @endphp
            <div>{{ translate(sprintf('Showing %d to %d of %d results', $start, $show, $allnews->total()), session('locale', 'en')) }}</div>
            <div class="flex items-center justify-center">
                <div class="flex items-center justify-center gap-2">
                    <a @if (!$first)
                        href="{{ route('allnews', ['page' => $current-1]) }}"
                    @endif class="px-2.5 pb-1 text-white font-bold hover:scale-125 {{ $first ? 'bg-gray-400' : "rounded bg-[$settings->primary_color]" }}">«</a>
                    @if ($startpage > 1)
                        <div>...</div>
                    @endif
                    @for ($i = $startpage; $i <= $endpage; $i++)
                        <a href="{{ $current == $i ? route('allnews', ['page' => $i]) : '' }}" class="px-1 rounded {{ $current == $i ? "border-x-2 border-[$settings->primary_color]" : "hover:bg-[$settings->primary_color]/[0.5] hover:text-white" }}">{{ $i }}</a>
                    @endfor
                    @if ($endpage > $lastpage)
                        <div>...</div>
                    @endif
                    <a @if (!$last)
                        href="{{ route('allnews', ['page' => $current+1]) }}"
                    @endif class="px-2.5 pb-1 text-white font-bold hover:scale-125 {{ $last ? 'bg-gray-400' : "rounded bg-[$settings->primary_color]"}}">»</a>
                </div>
            </div>
        </section>
    </main>
@endsection
