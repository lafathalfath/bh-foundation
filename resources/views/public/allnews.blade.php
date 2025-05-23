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

            <div class="flex justify-center mb-10">
                <form method="GET" action="{{ route('allnews') }}" class="flex flex-wrap items-center gap-4">
                    <label for="type" class="font-medium whitespace-nowrap">@lang('messages.category_filter') :</label>
                    <div class="relative w-full sm:w-64">
                        <select name="type" id="type" onchange="this.form.submit()"
                            class="block w-full px-4 py-2 border rounded appearance-none pr-10">
                            <option value="all" {{ $type === 'all' ? 'selected' : '' }}>@lang('messages.all')</option>
                            <option value="news" {{ $type === 'news' ? 'selected' : '' }}>@lang('messages.news')</option>
                            <option value="programs" {{ $type === 'programs' ? 'selected' : '' }}>@lang('messages.programs')
                            </option>
                            <option value="scholarship" {{ $type === 'scholarship' ? 'selected' : '' }}>
                                @lang('messages.scholarship')</option>
                        </select>

                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @forelse ($allnews as $nw)
                            @php
                                $views = strval($nw->views);
                                if (strlen($views) >= 4 && strlen($views) < 7)
                                    $views = substr($views, 0, strlen($views) - 3) . "K";
                                if (strlen($views) >= 7 && strlen($views) < 10)
                                    $views = substr($views, 0, strlen($views) - 6) . "M";
                                if (strlen($views) >= 10)
                                    $views = substr($views, 0, strlen($views) - 9) . "B";
                            @endphp
                            <div class="border rounded-lg overflow-hidden shadow-md hover-translate" data-aos="zoom-in">
                                <figure
                                    class="w-full h-60 bg-gray-300 overflow-hidden border rounded-t-xl flex items-center justify-center">
                                    <img src="{{ $nw->image_url }}" alt="Image" class="w-full h-full object-cover  ">
                                </figure>
                                <div class="card-body">
                                    <h3 class="card-title">{{ translate($nw->title, session('locale', 'en')) }}</h3>
                                    <p class="w-full h-7 overflow-hidden text-start text-gray-600">
                                        {{ translate($nw->description, session('locale', 'en')) }}</p>
                                    <p class="w-full text-start text-gray-500">{{ substr($nw->published_at, 0, 10) }}</p>
                                    <div class="w-full flex justify-end">
                                        {{ $views }} @lang('messages.views')
                                    </div>
                                    <a href="{{ route('article', [
                        'type' => strtolower($nw->type->name ?? 'news'),
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
                if ($lastpage == 1)
                    $show = $total;
                else {
                    $start = $current * $allnews->perPage() + 1;
                    $show = $total - ($allnews->perPage() * ($allnews->lastPage() - 1));
                }
                $startpage = 1;
                $endpage = 1;
                if ($lastpage <= 11)
                    $endpage = $lastpage;
                else {
                    if ($current <= 6)
                        $startpage = 1;
                    else
                        $startpage = $current - 6;

                    if ($current + 5 <= $lastpage)
                        $endpage = $lastpage;
                    else
                        $endpage = $current + 5;
                }
            @endphp
                <div>{{ translate(sprintf('Showing %d to %d of %d results', $start, $show, $allnews->total()), session('locale', 'en')) }}
            </div>
            <div class="flex items-center justify-center">
                <div class="flex items-center justify-center gap-2">
                    
                    <a href="{{ $first ? '#' : route('allnews', ['page' => 1, 'type' => request('type')]) }}"
                        class="px-2.5 pb-1 text-white font-bold {{ $first ? 'bg-gray-400 cursor-not-allowed' : "rounded bg-[$settings->primary_color] hover:scale-125" }}">
                        ««
                    </a>
                    <a href="{{ $first ? '#' : route('allnews', ['page' => $current - 1, 'type' => request('type')]) }}"
                        class="px-2.5 pb-1 text-white font-bold {{ $first ? 'bg-gray-400 cursor-not-allowed' : "rounded bg-[$settings->primary_color] hover:scale-125" }}">
                        «
                    </a>
                    <form action="{{ route('allnews') }}" method="GET" class="flex items-center">
                        <input type="hidden" name="type" value="{{ request('type') }}">
                        <input type="number" name="page" min="1" max="{{ $lastpage }}" value="{{ $current }}"
                            class="w-12 text-center border border-gray-400 rounded" onchange="this.form.submit()"
                            onkeydown="if(event.key==='Enter'){event.preventDefault();this.form.submit();}">
                    </form>
                    <a href="{{ $last ? '#' : route('allnews', ['page' => $current + 1, 'type' => request('type')]) }}"
                        class="px-2.5 pb-1 text-white font-bold {{ $last ? 'bg-gray-400 cursor-not-allowed' : "rounded bg-[$settings->primary_color] hover:scale-125" }}">
                        »
                    </a>
                    <a href="{{ $last ? '#' : route('allnews', ['page' => $lastpage, 'type' => request('type')]) }}"
                        class="px-2.5 pb-1 text-white font-bold {{ $last ? 'bg-gray-400 cursor-not-allowed' : "rounded bg-[$settings->primary_color] hover:scale-125" }}">
                        »»
                    </a>

                </div>
            </div>
        </section>
    </main>
@endsection