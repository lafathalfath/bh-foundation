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
                        <div class="bg-white shadow-md rounded-lg overflow-hidden" data-aos="fade-up">
                            <img src="{{ $sch->image_url }}"
                                alt="Beasiswa Image" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <a href="{{ route('article', [
                                            'type' => 'scholarship',
                                            'id' => Crypt::encryptString($sch->id)
                                        ]) }}"
                                    class="bg-blue-100 text-blue-600 text-xs font-semibold px-2 py-1 rounded-full">Scholarship</a>
                                <h3 class="text-lg font-semibold mt-2">{{ $sch->title }}</h3>
                            </div>
                        </div>
                        @empty
                            <div class="flex justify-center">Empty</div>
                        @endforelse
                        <!-- Pagination -->
            @php
                $current = $scholarship->currentPage();
                $lastpage = $scholarship->lastPage();
                $first = $current == 1;
                $last = $current == $lastpage;
                $total = $scholarship->total();
                $start = 1;
                $show = 0;
                if ($lastpage == 1) $show = $total;
                else {
                    $start = $current * $scholarship->perPage() + 1;
                    $show = $total - ($scholarship->perPage() * ($scholarship->lastPage() - 1));
                }
            @endphp
            <div class="flex justify-center items-center w-full mt-5 translate-x-[240px]">
                <div class="flex items-center justify-center gap-2 ml-10">
                    <a @if (!$first)
                        href="{{ route('ideas', ['page' => $current-1]) }}"
                    @endif class="px-2.5 pb-1 text-white font-bold hover:scale-125 {{ $first ? 'bg-gray-400' : "rounded bg-[$settings->primary_color]" }}">«</a>
                    @for ($i = 0; $i < $lastpage; $i++)
                        <a href="{{ $current == $i + 1 ? route('ideas', ['page' => $i + 1]) : '' }}" class="px-1 rounded {{ $current == $i + 1 ? "border-x-2 border-[$settings->primary_color]" : "hover:bg-[$settings->primary_color]/[0.5] hover:text-white" }}">{{ $i+1 }}</a>
                    @endfor
                    <div>...</div>
                    <a @if (!$last)
                        href="{{ route('ideas', ['page' => $current+1]) }}"
                    @endif class="px-2.5 pb-1 text-white font-bold hover:scale-125 {{ $last ? 'bg-gray-400' : "rounded bg-[$settings->primary_color]"}}">»</a>
                </div>
            </div>
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