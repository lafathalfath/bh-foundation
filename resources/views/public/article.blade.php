@extends('layout.public')
@section('content')
    <main class="container mx-auto px-5 md:px-9">
        <!-- Judul Artikel -->
        <section class="text-center py-10">
            <h1 class="text-4xl font-bold mb-4">Complete Website Responsive Design: from Figma to Webflow to Website Design
            </h1>
            <p class="text-gray-600">Become an instructor & start teaching with 26k certified instructors. Create a success
                story with 671k Students — Grow yourself with 71 countries.</p>
        </section>

        <!-- Gambar Utama -->
        <section class="mb-10">
            <img src="https://stpbogor.ac.id/wp-content/uploads/2024/10/kabinet-merah-putih-.jpg.webp" alt="Main Image" class="w-full rounded-lg shadow-lg">
        </section>

        <!-- Deskripsi Artikel -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Detail Penulis -->
            <aside class="md:col-span-1">
                <div class="border rounded-lg p-4 shadow-md">
                    <h3 class="text-xl font-bold mb-2">Pengirim</h3>
                    <div class="flex items-center mb-4">
                        <img src="https://thumb.ac-illust.com/c1/c16bdfca25eca4c40e7e2b8f2bc9e4e4_t.jpeg" alt="Author Image" class="rounded-full w-16 h-16 mr-3">
                        <div>
                            <p class="text-lg font-semibold">Admin YPB</p>
                        </div>
                    </div>
                    <h4 class="text-lg font-bold mb-1">More In:</h4>
                    <a href="" class="text-gray-600 mb-3 hover:underline">Javascript</a>,<a href="" class="text-gray-600 mb-3 hover:underline"> Leadership</a>
                    <h4 class="text-lg font-bold mb-1">Published:</h4>
                    <p class="text-gray-600">25 Desember 2025</p>
                </div>
            </aside>

            <!-- Konten Utama -->
            <article class="md:col-span-2">
                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4">Description</h2>
                    <p class="text-gray-800 mb-4">
                        It gives you a huge self-satisfaction when you look at your work and say, "I made that". I love that
                        feeling after I'm done working on something.
                    </p>
                    <p class="text-gray-800 mb-4">
                        I did that and that's why I got into this field. Not for the love of Web Design, which I do love.
                        But for the FEELING.
                    </p>
                </section>
                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4">Lectures Description</h2>
                    <p class="text-gray-800 mb-4">
                        We cover everything you need to build your first website. From creating your first page through to
                        uploading your new site to the internet.
                    </p>
                </section>
                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4">Lecture Notes</h2>
                    <p class="text-gray-800 mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur facilisis risus eget
                        tristique.
                    </p>
                </section>

                <!-- Attach Files -->
                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4">Attach Files (01)</h2>
                    <div class="border rounded-lg p-4 shadow-md flex justify-between items-center">
                        <p>Create account on webflow.pdf</p>
                        <button class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600">Download
                            File</button>
                    </div>
                </section>
            </article>

            <!-- Share Media -->
            <aside class="md:col-span-1">
                <div class="border rounded-lg p-4 shadow-md">
                    <h3 class="text-xl font-bold mb-4">Share</h3>
                    <ul>
                        <li class="mb-3">
                            <a href="#" class="text-gray-700 hover:text-blue-600">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="text-gray-700 hover:text-pink-600">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="text-gray-700 hover:text-blue-400">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="text-gray-700 hover:text-blue-600" onclick="copyLink()">
                                <i class="fas fa-link"></i> Copy Link
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-700 hover:text-green-600">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
        </section>

        <!-- Related Post -->
        <section class="mt-20 mb-20">
            <h2 class="text-3xl font-bold mb-10 text-center">Related Post</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <div class="border rounded-lg overflow-hidden shadow-md">
                        <img src="https://stpbogor.ac.id/wp-content/uploads/2024/10/foto-bersama.jpg.webp" alt="Related Post Image"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">
                                <a href="#">
                                    Related Post Title
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">
                                25 December 2025
                            </p>
                            <button class="btn btn-outline btn-warning mt-4" onclick="window.location='{{ route('article') }}'">Read More...</button>
                        </div>
                    </div>
                @endfor
            </div>
        </section>

    </main>
@endsection