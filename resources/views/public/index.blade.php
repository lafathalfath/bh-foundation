@extends('layout.public')
@section('content')

    <body>
        <!-- Navbar -->
        <header class="bg-gray-100 sticky top-0">
    <div>
        <section class="bg-blue-500 text-white py-30">
            <div class="container mx-auto flex h-screen items-center">
                <!-- Bagian Kiri: Judul dan Teks -->
                <div class="w-full md:w-1/2 pl-10">
                    <h3 class="text-5xl text-center md:text-6xl font-bold leading-tight">Yayasan Pusaka Bogor</h3>
                    <p class="mt-4 text-lg md:text-xl text-center">Lestarikan Budaya, Lindungi Warisan. Yayasan Pusaka
                        Bogor menjaga
                        dan melestarikan kekayaan budaya dan sejarah Bogor.</p>
                </div>

            <!-- <section class="bg-blue-500 text-white py-30">
                                <div class="container mx-auto flex h-screen items-center">
                                    <div class="w-full md:w-1/2 pl-10">
                                        <h3 class="text-5xl text-center md:text-6xl font-bold leading-tight">Yayasan Pusaka Bogor</h3>
                                        <p class="mt-4 text-lg md:text-xl text-center">Lestarikan Budaya, Lindungi Warisan. Yayasan Pusaka
                                            Bogor menjaga
                                            dan melestarikan kekayaan budaya dan sejarah Bogor.</p>
                                    </div>

                                    <div class="md:block md:w-1/2 flex justify-end pr-40">
                                        <img src="https://stpbogor.ac.id/wp-content/uploads/2024/08/Dionisius.jpg.webp" alt="Gambar Yayasan"
                                            class="w-full max-w-sm rounded-lg shadow-lg ml-auto">
                                    </div>
                                </div>
                            </section> -->

            <section class="bg-blue-500 text-white py-30">
                <div class="hero container mx-auto min-h-screen">
                    <div class="hero-content flex-col lg:flex-row-reverse">
                        <img src="https://stpbogor.ac.id/wp-content/uploads/2024/08/Dionisius.jpg.webp"
                            class="max-w-sm rounded-lg shadow-2xl ml-auto" />
                        <div>
                            <h1 class="text-5xl text-center font-bold">Yayasan Pusaka Bogor</h1>
                            <p class="py-6 mt-4 text-lg md:text-xl text-center">
                                Lestarikan Budaya, Lindungi Warisan. Yayasan Pusaka
                                Bogor menjaga
                                dan melestarikan kekayaan budaya dan sejarah Bogor
                            </p>
                        </div>
                    </div>
                </div>
            </section>


            <!-- About Us Section -->
            <section class="py-20">
                <div class="container mx-auto flex flex-col md:flex-row items-center">
                    <!-- Bagian Kiri: Gambar -->
                    <div class="w-full md:w-1/2 mb-8 md:mb-0">
                        <img src="http://localhost:8000/storage/LOGO_YPB_BG.png" alt="Logo" class="w-full max-w-sm mx-auto">
                    </div>

                    <!-- Bagian Kanan: Teks -->
                    <div class="w-full md:w-1/2 md:pl-10 text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-4">About Us</h2>
                        <p class="text-gray-700 mb-6 max-w-md">Yayasan Pusaka Bogor berdedikasi untuk melestarikan dan
                            melindungi
                            warisan budaya yang kaya dari Bogor. Kami bekerja untuk menjaga nilai sejarah, seni, dan tradisi
                            yang menjadi identitas masyarakat Bogor.</p>
                        <button class="btn btn-outline btn-warning">Read More...</button>
                    </div>
                </div>
            </section>

            <!-- Recent News Section -->
            <section class="py-20 bg-gray-100">
                <div class="container mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-10">Recent News</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="card shadow-md">
                            <figure>
                                <img src="https://stpbogor.ac.id/wp-content/uploads/2025/02/Desain-tanpa-judul-1024x907.png"
                                    alt="News Image" class="w-full">
                            </figure>
                            <div class="card-body">
                                <h3 class="card-title">Berita 1</h3>
                                <p class="text-gray-600">Deskripsi singkat berita pertama.</p>
                                <button class="btn btn-outline btn-warning mt-4">Read More...</button>
                            </div>
                        </div>
                        <div class="card shadow-md">
                            <figure>
                                <img src="https://stpbogor.ac.id/wp-content/uploads/2025/01/MoU-STP-Bogor-dan-Hands-to-the-Future-H2TF-e1736845670562.jpeg"
                                    alt="News Image" class="w-full">
                            </figure>
                            <div class="card-body">
                                <h3 class="card-title">Berita 2</h3>
                                <p class="text-gray-600">Deskripsi singkat berita kedua.</p>
                                <button class="btn btn-outline btn-warning mt-4">Read More...</button>
                            </div>
                        </div>
                        <div class="card shadow-md">
                            <figure>
                                <img src="https://stpbogor.ac.id/wp-content/uploads/2025/01/PPN-Batal-Naik-_-STP-Bogor-e1736413891938.jpg.webp"
                                    alt="News Image" class="w-full">
                            </figure>
                            <div class="card-body">
                                <h3 class="card-title">Berita 3</h3>
                                <p class="text-gray-600">Deskripsi singkat berita ketiga.</p>
                                <button class="btn btn-outline btn-warning mt-4">Read More...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </body>
@endsection