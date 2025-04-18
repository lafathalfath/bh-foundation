@extends('layout.public')
@section('content')
    <div class="flex flex-col">
        @if ($about->is_hero_visible)
            <section class="my-5 flex max-[960px]:flex-col-reverse items-center justify-between min-h-96 gap-x-10">
                <div class="w-full md:w-1/2 h-full" data-aos="fade-right">
                    <div class="p-10">
                        <div class="text-2xl md:text-5xl font-semibold">{{ translate($about->title, session('locale', 'en')) }}</div><br>
                        <p class="max-[960px]:text-sm">&emsp;{!! nl2br(e(translate($about->description, session('locale', 'en')))) !!}</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 h-full" data-aos="fade-left">
                    <div class="h-full flex items-center justify-end">
                        <div class="h-full">
                            <img src="{{ $about->image_1_url }}" alt="" class="h-full w-full">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($about->is_vision_visible)
            <section class="p-5 bg-[{{ $about->bg_color ?? $settings->primary_color }}] flex max-[960px]:flex-col items-center justify-between min-h-96 gap-x-10">
                <div class="w-full md:w-1/2 h-full" data-aos="fade-right">
                    <img src="{{ $about->image_2_url }}" class="h-full" alt="">
                </div>
                <div class="w-full md:w-1/2 max-h-full text-white" data-aos="fade-left">
                    <div class="font-semibold text-2xl mb-2 mt-3">@lang('messages.vision'):</div>
                    <p class="max-[960px]:text-sm">{!! nl2br(e(translate($about->vision, session('locale', 'en')))) !!}</p>
                    <div class="font-semibold text-2xl mb-2 mt-3">@lang('messages.mision'):</div>
                    <p class="max-[960px]:text-sm">{!! nl2br(e(translate($about->mision, session('locale', 'en')))) !!}</p>
                </div>
            </section>
        @endif

        @if ($about->is_members_visible)
            <section class="py-10 bg-gray-200 flex flex-col items-center gap-5">
                @foreach ($member_level as $ml)
                    <div class="text-2xl font-semibold">{{ translate($ml->name, session('locale', 'en')) }}</div>
                    <div class="flex items-center justify-center gap-5">
                        @foreach ($ml->member as $mb)
                            <div class="w-60" data-aos="fade-up">
                                {{-- <div class="w-full h-60 bg-gray-500"></div> --}}
                                <img src="{{ $mb->image_url }}" alt="">
                                <div class="w-full h-20 bg-white flex flex-col items-center">
                                    <div class="w-full text-center font-semibold">{{ $mb->name }}</div>
                                    <div class="w-full text-center text-sm">{{ translate($mb->position, session('locale', 'en')) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </section>
        @endif

        @isset($programs)
        @if (isset($about) && $about->is_programs_visible)
            <section class="px-[8%] py-[5%]" id="programs">
                <div class="flex items-center justify-between mb-3">
                    <div class="font-semibold text-lg">@lang('messages.programs')</div>
                    <!-- <div class="flex items-center gap-1">
                        <a href="{{ route('about', ['page' => $programs->currentPage() - 1]) }}"
                            class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] flex items-center justify-center w-10 h-10 scale-x-[-1]">
                            &#10140;</a>
                        <a href="{{ route('about', ['page' => $programs->currentPage() + 1]) }}"
                            class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] flex items-center justify-center w-10 h-10">
                            &#10140;</a>
                    </div> -->
                </div>
                <div class="relative">
                    <div class="grid gap-5 grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
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
                                                <div class="w-full font-semibold truncate">{{ translate($po->title, session('locale', 'en')) }}</div>
                                                <div class="text-gray-400 text-sm">{{ substr($po->published_at, 0, 10) }}</div>
                                            </div>
                                            <div class="flex justify-between items-center mt-2">
                                            @foreach ($po->category as $cat)
                                                <div
                                                    class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] px-2 rounded-full">
                                                    {{ translate($cat->name, session('locale', 'en')) }}
                                                </div>
                                            @endforeach
                                                <div class="text-center text-sm">{{ $views }} @lang('messages.views')</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        @empty
                            <div class="flex justify-center">@lang('messages.empty')</div>
                        @endforelse
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                    <a href="{{ route('allnews',['type' => 'programs']) }}">
                            <button class="btn btn-sm md:btn-md btn-outline btn-warning mt-4">@lang('messages.another_program')</button>
                    </a>
                    </div>
                </div>
            </section>
        @endif
        @endisset

        @if ($about->is_partners_visible)
            <section class="mx-[8%] my-[5%] outline outline-1 outline-gray-300 h-96 flex max-[960px]:flex-col items-center gap-10">
                <div class="p-5 flex flex-col items-center justify-center md:w-1/3 w-full">
                    <div class="w-full mb-3 text-2xl font-semibold">{{ translate($about->partners_title, session('locale', 'en')) }}</div>
                    <div class="max-[450px]:text-sm">{{ translate($about->partners_description, session('locale', 'en')) }}</div>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-2 md:w-2/3 w-full">
                    @forelse ($partners as $pt)
                        <a href="{{ $pt->url }}">
                            <div
                                class="w-48 h-24 p-5 bg-white rounded shadow-lg outline outline-1 outline-gray-300 flex items-center justify-center">
                                <img src="{{ $pt->image_url }}" class="max-w-full max-h-full" alt="">
                            </div>
                        </a>
                    @empty
                        <div class="font-semibold">@lang('messages.no_partner_exists')</div>
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