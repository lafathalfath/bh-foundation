@extends('layout.public')
@section('content')
    <main class="container mx-auto px-5 md:px-9">
        <!-- Judul Artikel -->
        <section class="text-center py-10">
            @if (!$program->published)
                <div class="flex items-center justify-center gap-2">
                    <div class="px-3.5 py-1 bg-error text-white font-semibold rounded-full">!</div>
                    <div class="px-5 py-1 bg-error text-white font-semibold rounded-full">Unpublished</div>
                </div>
            @endif
            <h1 class="text-4xl font-bold mb-4">{{ $program->title }}
            </h1>
            {{-- <p class="text-gray-600">Become an instructor & start teaching with 26k certified instructors. Create a success --}}
                {{-- story with 671k Students — Grow yourself with 71 countries.</p> --}}
        </section>

        <!-- Gambar Utama -->
        <section class="mb-10">
            <div class="bg-gray-300 w-full aspect-video flex items-center justify-center">
                <img src="{{ $program->image_url }}" alt="Main Image" class="w-full h-full object-contain">
            </div>
        </section>

        <!-- Deskripsi Artikel -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Detail Penulis -->
            <aside class="md:col-span-1">
                <div class="border rounded-lg p-4 shadow-md">
                    <h3 class="text-xl font-bold mb-2">Author: </h3>
                    <div class="flex items-center mb-4">
                        {{-- <img src="https://thumb.ac-illust.com/c1/c16bdfca25eca4c40e7e2b8f2bc9e4e4_t.jpeg" alt="Author Image" class="rounded-full w-16 h-16 mr-3"> --}}
                        <div>
                            <p class="text-lg font-semibold">Admin YPB</p>
                        </div>
                    </div>
                    <h4 class="text-lg font-bold mb-1">More In:</h4>
                    <div>
                        @foreach ($program->category as $cat)
                            <a href="" class="text-gray-600 mb-3 hover:underline">{{ $cat->name }}</a>
                            @if ($loop->iteration != count($program->category)),@endif
                        @endforeach
                    </div>
                    <h4 class="text-lg font-bold mb-1">Published:</h4>
                    <p class="text-gray-600">{{ substr($program->published_at, 0, 10) }}</p>
                </div>
            </aside>

            <!-- Konten Utama -->
            <article class="md:col-span-2">
                <section class="mb-10">
                    {{-- <h2 class="text-2xl font-bold mb-4">Description</h2> --}}
                    <p class="text-gray-800 mb-4">
                    {!! nl2br(e($program->description)) !!}
                    </p>
                    {{-- <p class="text-gray-800 mb-4">
                        I did that and that's why I got into this field. Not for the love of Web Design, which I do love.
                        But for the FEELING.
                    </p> --}}
                </section>
                {{-- <section class="mb-10">
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
                </section> --}}
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
            <div class="flex items-center justify-center flex-wrap gap-6">
                @forelse ($related as $rel)
                    @php
                        $date = substr($rel->published_at, 0, 10);
                        // $date = substr($date, 0, 4);
                        // $date = date('Y');
                        // dd(substr($date, 5, 2) == 2);
                        // if (substr($date, 0, 4) < date('Y') ) $date = substr($date, 0, 4);
                        // else {
                        //     if (substr($date, 5, 2) < date('m')) {
                        //         switch (substr($date, 5, 2)) {
                        //             case 1:
                        //                 $date = 'January';
                        //                 break;
                        //             case 2:
                        //                 $date = 'February';
                        //                 break;
                        //             case 3:
                        //                 $date = 'March';
                        //                 break;
                        //             case 4:
                        //                 $date = 'April';
                        //                 break;
                        //             case 5:
                        //                 $date = 'May';
                        //                 break;
                        //             case 6:
                        //                 $date = 'June';
                        //                 break;
                        //             case 7:
                        //                 $date = 'July';
                        //                 break;
                        //             case 8:
                        //                 $date = 'August';
                        //                 break;
                        //             case 9:
                        //                 $date = 'September';
                        //                 break;
                        //             case 10:
                        //                 $date = 'October';
                        //                 break;
                        //             case 11:
                        //                 $date = 'November';
                        //             default:
                        //                 $date = 'Last Month';
                        //                 break;
                        //         }
                        //     }
                        //     elseif (substr($date, 8, 2) < )
                        // }

                        $views = strval($rel->views);
                        if (strlen($views) >= 4 && strlen($views) < 7) $views = substr($views, 0, strlen($views)-3)."K";
                        if (strlen($views) >= 7 && strlen($views) < 10) $views = substr($views, 0, strlen($views)-6)."M";
                        if (strlen($views) >= 10) $views = substr($views, 0, strlen($views)-9)."B";
                    @endphp
                    <a href="{{ route('article', [
                        'type' => 'news',
                        'id' => Crypt::encryptString($rel->id)
                    ]) }}">
                        <div class="w-56 border rounded-lg overflow-hidden shadow-md flex flex-col items-center">
                            <div class="w-full h-48 flex items-center justify-center">
                                <img src="{{ $rel->image_url }}" alt="Related Post Image"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="w-full p-3">
                                <h3 class="text-lg font-bold mb-2">
                                    {{ $rel->title }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-3">
                                    {{ $date }}
                                </p>
                                <div class="flex justify-end text-gray-500 text-sm">{{ $views }} views</div>
                                {{-- <button class="btn btn-outline btn-warning mt-4" onclick="window.location='{{ route('article') }}'">Read More...</button> --}}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="font-semibold">Related Post is Empty</div>
                @endforelse
            </div>
        </section>

    </main>
@endsection