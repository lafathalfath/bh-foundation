@extends('layout.public')
@section('content')
    <div class="flex flex-col">
        @if ($about->is_hero_visible)
            <section class="my-5 flex items-center justify-between h-96">
                <div class="w-1/2 h-full" data-aos="fade-right">
                    <div class="p-10">
                        <div class="text-5xl font-semibold">{{ $about->title }}</div><br>
                        <p>&emsp;{{ $about->description }}</p>
                    </div>
                </div>
                <div class="w-1/2 h-full" data-aos="fade-left">
                    <div class="h-full flex items-center justify-end">
                        <div class="h-full">
                            <img src="{{ $about->image_1_url }}" alt="" class="h-full">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($about->is_vision_visible)
            <section class="p-5 bg-[{{ $about->bg_color ?? $settings->primary_color }}] flex items-center justify-between h-96">
                <div class="w-1/2 h-full" data-aos="fade-right">
                    <img src="{{ $about->image_2_url }}" class="h-full" alt="">
                </div>
                <div class="w-1/2 max-h-full text-white" data-aos="fade-left">
                    <div class="font-semibold text-2xl mb-2 mt-3">Vision:</div>
                    <p>{{ $about->vision }}</p>
                    <div class="font-semibold text-2xl mb-2 mt-3">Mision:</div>
                    <p>{{ $about->mision }}</p>
                </div>
            </section>
        @endif

        @if ($about->is_members_visible)
            <section class="py-10 bg-gray-200 flex flex-col items-center gap-5">
                @foreach ($member_level as $ml)
                    <div class="text-2xl font-semibold">{{ $ml->name }}</div>
                    <div class="flex items-center justify-center gap-5">
                        @foreach ($ml->member as $mb)
                            <div class="w-60" data-aos="fade-up">
                                {{-- <div class="w-full h-60 bg-gray-500"></div> --}}
                                <img src="{{ $mb->image_url }}" alt="">
                                <div class="w-full h-20 bg-white flex flex-col items-center">
                                    <div class="w-full text-center font-semibold">{{ $mb->name }}</div>
                                    <div class="w-full text-center text-sm">{{ $mb->position }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </section>
        @endif

        @if ($about->is_programs_visible)
            <section class="px-[8%] py-[5%]" id="programs">
                <div class="flex items-center justify-between mb-3">
                    <div class="font-semibold text-lg">Programs</div>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('about', ['page' => $programs->currentPage() - 1]) }}"
                            class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] flex items-center justify-center w-10 h-10 scale-x-[-1]">
                            &#10140;</a>
                        <a href="{{ route('about', ['page' => $programs->currentPage() + 1]) }}"
                            class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] flex items-center justify-center w-10 h-10">
                            &#10140;</a>
                    </div>
                </div>
                <div class="relative">
                    <div class="flex gap-5">
                        @forelse ($programs as $po)
                                    @php
                                        $views = strval($po->views);
                                        if (strlen($views) >= 4 && strlen($views) < 7)
                                            $views = substr($views, 0, strlen($views) - 3) . "K";
                                        if (strlen($views) >= 7 && strlen($views) < 10)
                                            $views = substr($views, 0, strlen($views) - 6) . "M";
                                        if (strlen($views) >= 10)
                                            $views = substr($views, 0, strlen($views) - 9) . "B";
                                    @endphp

                                    {{-- 🛠️ Pastikan kategori dan views tetap dalam card --}}
                                <a href="{{ route('article', [
                                            'type' => 'programs',
                                            'id' => Crypt::encryptString($po->id)
                                        ]) }}">
                                        
                                    <div class="snap-center min-w-[304px] outline outline-1 outline-gray-300 hover:border-b-2 border-[{{ $settings->primary_color }}] rounded shadow-lg" data-aos="fade-in">
                                        <div class="w-full h-[171px] bg-gray-500">
                                            <img src="{{ $po->image_url }}" alt="Programs Image" class="w-full h-full object-cover">
                                        </div>
                                        <div class="w-full bg-white p-2 flex flex-col justify-between min-h-[120px]">
                                            <div>
                                                <div class="w-full font-semibold truncate">{{ $po->title }}</div>
                                                <div class="text-gray-400 text-sm">{{ substr($po->published_at, 0, 10) }}</div>
                                            </div>
                                            <div class="flex justify-between items-center mt-2">
                                                <div
                                                    class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] px-2 rounded-full">
                                                    category
                                                </div>
                                                <div class="text-center text-sm">{{ $views }} views</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        @empty
                            <div class="flex justify-center">Empty</div>
                        @endforelse
                    </div>
                </div>
            </section>
        @endif

        @if ($about->is_partners_visible)
            <section class="mx-[8%] my-[5%] outline outline-1 outline-gray-300 h-96 flex items-center gap-10">
                <div class="p-5 flex flex-col items-center justify-center w-1/3">
                    <div class="w-full mb-3 text-2xl font-semibold">{{ $about->partners_title }}</div>
                    <div>{{ $about->partners_description }}</div>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-2 w-2/3">
                    @forelse ($partners as $pt)
                        <a href="{{ $pt->url }}">
                            <div
                                class="w-48 h-24 p-5 bg-white rounded shadow-lg outline outline-1 outline-gray-300 flex items-center justify-center">
                                <img src="{{ $pt->image_url }}" class="max-w-full max-h-full" alt="">
                            </div>
                        </a>
                    @empty
                        <div class="font-semibold">No Partners Exists</div>
                    @endforelse
                </div>
            </section>
        @endif

    </div>
    {{-- JavaScript untuk Navigasi Carousel --}}
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('programCarousel');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        prevBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: -320, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: 320, behavior: 'smooth' });
        });
    });
</script> -->
@endsection