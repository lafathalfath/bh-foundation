@extends('layout.public')
@section('content')
<style>
.hover-translate:hover {
    transform: translateY(-10px) !important;
}
</style>

    <div>
        @if ($front_page->is_hero_visible)
            <section class="bg-[{{ $front_page->hero_bg_color}}] text-white py-30" data-aos="fade-down">
                <div class="container mx-auto flex max-[450px]:flex-col-reverse h-screen items-center justify-center gap-20 md:gap-64 max-[450px]:gap-5">
                    <!-- Bagian Kiri: Judul dan Teks -->
                    <div class="w-1/3 max-[450px]:w-4/5 max-[450px]:w-1/2 flex flex-col items-center justify-center">
                        <h3 class="text-3xl max-[450px]:text-2xl text-center font-bold leading-tight">{{ translate($front_page->hero_title, session('locale', 'en')) }}</h3>
                        <p class="mt-4 md:text-lg text-center">{!! nl2br(e(translate($front_page->hero_description, session('locale', 'en')))) !!}.</p>
                    </div>

                    <div class="max-w-[500px] flex justify-end max-[450px]:justify-center max-[450px]:w-[250px]">
                        <img src="{{ $front_page->hero_image_url }}" alt="Gambar Yayasan"
                            class="w-full max-w-sm rounded-lg shadow-lg ml-auto">
                    </div>
                </div>
            </section>
        @endif

        <main class="container mx-auto px-5 max-[450px]:px-9">

        @if ($front_page->is_about_visible)
            <!-- About Us Section -->
            <section class="py-20">
                <div class="container mx-auto flex max-[450px]:flex-col items-center gap-10">
                    <!-- Bagian Kiri: Gambar -->
                    <div class="w-full max-[450px]:w-1/2 mb-8 max-[450px]:mb-0">
                        <img src="{{ $settings->logo_banner_url }}" alt="Logo" class="w-full max-w-sm mx-auto">
                    </div>

                    <!-- Bagian Kanan: Teks -->
                    <div class="w-full flex flex-col max-[450px]:pt-10 max-[450px]:items-center">
                        <h2 class="text-3xl max-[450px]:text-2xl font-bold mb-4">{{ translate($about->title, session('locale', 'en')) }}</h2>
                        <p class="text-gray-700 mb-6 max-w-md">&emsp;{{ translate(Str::words($about->description, 30, '...'), session('locale', 'en')) }}p>
                        <div>
                            <button class="btn btn-sm md:btn-md btn-outline btn-warning" onclick="window.location='{{ route('about') }}'">@lang('messages.read_more')</button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

            <!-- Recent News Section -->
            @if ($front_page->is_recent_news_visible)
                <section class="py-20 ">
                    <div class="container mx-auto text-center px-4 md:px-8">
                        <h2 class="text-3xl font-bold mb-10">@lang('messages.recent_news')</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 z-0">
                            @forelse ($news as $nw)
                                            @php
                                                $views = strval($nw->views);
                                                if (strlen($views) >= 4 && strlen($views) < 7)
                                                    $views = substr($views, 0, strlen($views) - 3) . "K";
                                                if (strlen($views) >= 7 && strlen($views) < 10)
                                                    $views = substr($views, 0, strlen($views) - 6) . "M";
                                                if (strlen($views) >= 10)
                                                    $views = substr($views, 0, strlen($views) - 9) . "B";
                                            @endphp
                                            <div
                                                class="shadow-md rounded-xl transition-transform duration-500 hover-translate" data-aos="fade-left" data-aos-anchor-placement="top-bottom">
                                                <figure
                                                    class="w-full h-60 bg-gray-300 overflow-hidden border rounded-t-xl flex items-center justify-center">
                                                    <img src="{{ $nw->image_url }}" alt="News Image" class="w-full h-full object-cover  ">
                                                </figure>
                                                <div class="card-body">
                                                    <h3 class="card-title overflow-hidden">{{ translate($nw->title, session('locale', 'en')) }}</h3>
                                                    <p class="w-full h-7 overflow-hidden text-start text-gray-600">{{ translate($nw->description, session('locale', 'en')) }}</p>
                                                    <p class="w-full text-start text-gray-500">{{ substr($nw->published_at, 0, 10) }}</p>
                                                    <div class="w-full flex justify-end">
                                                        {{ $views }} @lang('messages.views')
                                                    </div>
                                                    <a href="{{ route('article', [
                                    'type' => 'news',
                                    'id' => Crypt::encryptString($nw->id)
                                ]) }}" class="btn btn-sm md:btn-md btn-outline btn-warning mt-4">
                                                        @lang('messages.read_more')
                                                    </a>
                                                </div>
                                            </div>
                            @empty
                                <div class="flex justify-center">@lang('messages.empty')</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <a href="{{ route('allnews', ['type'=>'news']) }}">
                            <button class="btn btn-sm md:btn-md btn-outline btn-warning mt-4">@lang('messages.another_news')</button>
                        </a>
                        <a href="{{ route('contact') }}">
                            <button class="btn btn-sm md:btn-md btn-outline btn-warning mt-4">@lang('messages.contact') <i
                                    class="fa-solid fa-paper-plane"></i></button>
                        </a>
                    </div>
                </section>
            @endif
        </main>
    </div>
@endsection