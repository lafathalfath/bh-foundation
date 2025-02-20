@extends('layout.public')
@section('content')
<style>
.hover-translate:hover {
    transform: translateY(-10px) !important;
}
</style>

    <div>
        @if ($front_page->is_hero_visible)
            <section class="bg-[{{ $front_page->hero_bg_color}}] text-white py-30">
                <div class="container mx-auto flex h-screen items-center">
                    <!-- Bagian Kiri: Judul dan Teks -->
                    <div class="w-full md:w-1/2 pl-10">
                        <h3 class="text-5xl text-center md:text-6xl font-bold leading-tight">{{ $front_page->hero_title }}</h3>
                        <p class="mt-4 text-lg md:text-xl text-center">{{ $front_page->hero_description }}.</p>
                    </div>

                    <div class="md:block md:w-1/2 flex justify-end pr-40">
                        <img src="{{ $front_page->hero_image_url }}" alt="Gambar Yayasan"
                            class="w-full max-w-sm rounded-lg shadow-lg ml-auto">
                    </div>
                </div>
            </section>
        @endif

        <main class="container mx-auto px-5 md:px-9">

        @if ($front_page->is_about_visible)
            <!-- About Us Section -->
            <section class="py-20">
                <div class="container mx-auto flex flex-col md:flex-row items-center">
                    <!-- Bagian Kiri: Gambar -->
                    <div class="w-full md:w-1/2 mb-8 md:mb-0">
                        <img src="{{ $settings->logo_banner_url }}" alt="Logo" class="w-full max-w-sm mx-auto">
                    </div>

                    <!-- Bagian Kanan: Teks -->
                    <div class="w-full md:w-1/2 md:pl-10 text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-4">About Us</h2>
                        <p class="text-gray-700 mb-6 max-w-md">Yayasan Pusaka Bogor berdedikasi untuk melestarikan dan
                            melindungi
                            warisan budaya yang kaya dari Bogor. Kami bekerja untuk menjaga nilai sejarah, seni, dan tradisi
                            yang menjadi identitas masyarakat Bogor.</p>
                        <button class="btn btn-outline btn-warning" onclick="window.location='{{ route('about') }}'">Read
                            More...</button>
                    </div>
                </div>
            </section>
        @endif

            <!-- Recent News Section -->
            @if ($front_page->is_recent_news_visible)
                <section class="py-20 ">
                    <div class="container mx-auto text-center px-4 md:px-8">
                        <h2 class="text-3xl font-bold mb-10">Recent News</h2>
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
                                                    <h3 class="card-title overflow-hidden">{{ $nw->title }}</h3>
                                                    <p class="w-full h-7 overflow-hidden text-start text-gray-600">{{ $nw->description }}</p>
                                                    <p class="w-full text-start text-gray-500">{{ substr($nw->published_at, 0, 10) }}</p>
                                                    <div class="w-full flex justify-end">
                                                        {{ $views }} views
                                                    </div>
                                                    <a href="{{ route('article', [
                                    'type' => 'news',
                                    'id' => Crypt::encryptString($nw->id)
                                ]) }}" class="btn btn-outline btn-warning mt-4">
                                                        Read More...
                                                    </a>
                                                </div>
                                            </div>
                            @empty
                                <div class="flex justify-center">Empty</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <a href="{{ route('allnews') }}">
                            <button class="btn btn-outline btn-warning mt-4">Berita Lainnya...</button>
                        </a>
                        <a href="{{ route('contact') }}">
                            <button class="btn btn-outline btn-warning mt-4">Contact <i
                                    class="fa-solid fa-paper-plane"></i></button>
                        </a>
                    </div>
                </section>
            @endif
        </main>
    </div>
@endsection