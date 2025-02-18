@extends('layout.public')
@section('content')
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

            <!-- Recent News Section -->
            <section class="py-20 ">
                <div class="container mx-auto text-center px-4 md:px-8">
                    <h2 class="text-3xl font-bold mb-10">Recent News</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 z-0">
                        <div
                            class="shadow-md rounded-xl transition-transform duration-500 hover:translate-y-[-10px] opacity-0 translate-x-10">
                            <figure>
                                <img src="https://stpbogor.ac.id/wp-content/uploads/2025/02/Desain-tanpa-judul-1024x907.png"
                                    alt="News Image" class="w-full">
                            </figure>
                            <div class="card-body">
                                <h3 class="card-title">Berita 1</h3>
                                <p class="text-gray-600">Deskripsi singkat berita pertama.</p>
                                <button class="btn btn-outline btn-warning mt-4"
                                    onclick="window.location='{{ route('article') }}'">Read More...</button>
                            </div>
                        </div>
                        <div
                            class="shadow-md rounded-xl transition-transform duration-500 hover:translate-y-[-10px] opacity-0 translate-x-10">
                            <figure>
                                <img src="https://stpbogor.ac.id/wp-content/uploads/2025/01/MoU-STP-Bogor-dan-Hands-to-the-Future-H2TF-e1736845670562.jpeg"
                                    alt="News Image" class="w-full">
                            </figure>
                            <div class="card-body">
                                <h3 class="card-title">Berita 2</h3>
                                <p class="text-gray-600">Deskripsi singkat berita kedua.</p>
                                <button class="btn btn-outline btn-warning mt-4"
                                    onclick="window.location='{{ route('article') }}'">Read More...</button>
                            </div>
                        </div>
                        <div
                            class="shadow-md rounded-xl transition-transform duration-500 hover:translate-y-[-10px] opacity-0 translate-x-10">
                            <figure>
                                <img src="https://stpbogor.ac.id/wp-content/uploads/2025/01/PPN-Batal-Naik-_-STP-Bogor-e1736413891938.jpg.webp"
                                    alt="News Image" class="w-full">
                            </figure>
                            <div class="card-body">
                                <h3 class="card-title">Berita 3</h3>
                                <p class="text-gray-600">Deskripsi singkat berita ketiga.</p>
                                <button class="btn btn-outline btn-warning mt-4"
                                    onclick="window.location='{{ route('article') }}'">Read More...</button>
                            </div>
                        </div>
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
        </main>
    </div>
    <script>
        // Tunggu hingga halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Pilih semua card yang akan dianimasikan
            const cards = document.querySelectorAll('.grid > div');

            // Atur opsi observer
            const observerOptions = {
                root: null, // viewport browser
                rootMargin: '0px',
                threshold: 0.5 // Berapa persen elemen terlihat sebelum animasi berjalan
            };

            // Fungsi callback saat elemen terlihat
            const observerCallback = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Tambahkan class untuk animasi
                        entry.target.classList.add('opacity-100', 'translate-x-0');
                        // Hentikan observasi setelah animasi berjalan
                        observer.unobserve(entry.target);
                    }
                });
            };

            // Buat observer baru
            const observer = new IntersectionObserver(observerCallback, observerOptions);

            // Mulai observasi tiap card
            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
@endsection