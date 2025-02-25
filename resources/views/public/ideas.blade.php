@extends('layout.public')
@section('content')
    <main class="container mx-auto px-5 md:px-9">
        @if ($ideas->is_hero_visible)
            <section class="py-20">
                <div class="container mx-auto flex flex-col md:flex-row items-center">
                    <!-- Bagian Kiri: Gambar -->
                    <div class="w-full md:w-1/2 md:pl-10 text-center md:text-right">
                        <h2 class="text-3xl font-bold mb-4 text-center">{{ $ideas->title }}</h2>
                        <p class="text-gray-700 mb-6 text-center">{!! nl2br(e($ideas->description)) !!}.</p>
                    </div>

                    <!-- Bagian Kanan: Teks -->
                    <div class="w-full md:w-1/2 mb-8 md:mb-0">
                        <img src="{{ $ideas->image_url }}" alt="Logo" class="w-full max-w-sm mx-auto">
                    </div>
                </div>
            </section>
        @endif

        <section class="py-10">
            <div class="container mx-auto text-center">
                <h2 class="text-2xl font-bold mb-6">Scholarship</h2>
                <div class="flex justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl">
                        @forelse ($scholarship as $sch)
                                            <!-- Card Beasiswa -->
                                            <div class="bg-white shadow-md rounded-lg overflow-hidden w-96" data-aos="fade-up">
                                                <img src="{{ $sch->image_url }}" alt="Beasiswa Image" class="w-full h-48 object-cover">
                                                <div class="p-4">
                                                    <a href="{{ route('article', [
                                'type' => 'scholarship',
                                'id' => Crypt::encryptString($sch->id)
                            ]) }}"
                                                        class="bg-blue-100 text-blue-600 text-xs font-semibold px-2 py-1 rounded-full">Scholarship</a>
                                                    <h3 class="text-lg font-semibold mt-2 truncate">{{ $sch->title }}</h3>
                                                </div>
                                            </div>
                        @empty
                            <div class="flex justify-center col-span-full">Empty</div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination -->
                @php
                    $current = $scholarship->currentPage();
                    $lastpage = $scholarship->lastPage();
                    $first = $current == 1;
                    $last = $current == $lastpage;
                @endphp
                <div class="flex justify-center items-center w-full mt-5">
                    <div class="flex items-center gap-2">
                        <a @if (!$first)
                            href="{{ route('ideas', ['page' => $current-1]) }}"
                        @endif 
                        class="px-3 py-1 text-white font-bold hover:scale-110 {{ $first ? 'bg-gray-400' : "rounded bg-[$settings->primary_color]" }}">
                            «
                        </a>
    
                        @for ($i = 1; $i <= $lastpage; $i++)
                            <a href="{{ route('ideas', ['page' => $i]) }}"
                                class="px-3 py-1 rounded {{ $current == $i ? "bg-[$settings->primary_color] text-white" : "hover:bg-[$settings->primary_color]/[0.5] hover:text-white" }}">
                                {{ $i }}
                            </a>
                        @endfor
    
                        <a @if (!$last)
                            href="{{ route('ideas', ['page' => $current+1]) }}"
                        @endif 
                        class="px-3 py-1 text-white font-bold hover:scale-110 {{ $last ? 'bg-gray-400' : "rounded bg-[$settings->primary_color]" }}">
                            »
                        </a>
                    </div>
                </div>
            </div>
        </section>

        @if ($ideas->is_major_visible)
            <section class="py-20">
                <div class="container mx-auto flex flex-col md:flex-row items-center">
                    <!-- Bagian Kiri: Gambar -->
                    <div class="w-full md:w-1/2 mb-8 md:mb-0">
                        <img src="{{ $ideas->major_image_url }}" alt="Logo" class="w-full max-w-sm mx-auto">
                    </div>

                    <!-- Bagian Kanan: Teks -->
                    <div class="w-full md:w-1/2 md:pl-10 text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-4">{{ $ideas->major_title }}</h2>
                        <p class="text-gray-700 mb-6 max-w-md">{!! nl2br(e($ideas->major_description)) !!}
                        </p>
                    </div>
                </div>
            </section>
        @endif

    </main>
@endsection