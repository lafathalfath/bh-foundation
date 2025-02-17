@extends('layout.public')
@section('content')
<div class="flex flex-col">
    @if ($about->is_hero_visible)
        <section class="my-5 flex items-center justify-between h-96">
            <div class="w-1/2 h-full">
                <div class="p-10">
                    <div class="text-5xl font-semibold">{{ $about->title }}</div><br>
                    <p>&emsp;{{ $about->description }}</p>
                </div>
            </div>
            <div class="w-1/2 h-full">
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
            <div class="w-1/2 h-full">
                <img src="{{ $about->image_2_url }}" class="h-full" alt="">
            </div>
            <div class="w-1/2 max-h-full text-white">
                <div class="font-semibold text-2xl mb-2 mt-3">Vision:</div>
                <p>{{ $about->vision }}</p>
                <div class="font-semibold text-2xl mb-2 mt-3">Mision:</div>
                <p>{{ $about->mision }}</p>
            </div>
        </section>
    @endif

    @if ($about->is_members_visible)
        <section class="py-10 bg-gray-200 flex flex-col items-center gap-5">
            <div class="text-2xl font-semibold">Level</div>
            <div class="flex items-center justify-center gap-5">
                <div class="w-60">
                    <div class="w-full h-60 bg-gray-500"></div>
                    {{-- <img src="" alt=""> --}}
                    <div class="w-full h-20 bg-white flex flex-col items-center">
                        <div class="w-full text-center font-semibold">Name</div>
                        <div class="w-full text-center text-sm">Position</div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($about->is_programs_visible)
        @php
            $views = strval(10000);
            if (strlen($views) >= 4 && strlen($views) < 7) $views = substr($views, 0, strlen($views)-3)."K";
            if (strlen($views) >= 7 && strlen($views) < 10) $views = substr($views, 0, strlen($views)-6)."M";
            if (strlen($views) >= 10) $views = substr($views, 0, strlen($views)-9)."B";
        @endphp
        <section class="px-[8%] py-[5%]">
            <div class="flex items-center justify-between mb-3">
                <div class="font-semibold text-lg">Programs</div>
                <div class="flex items-center gap-1">
                    <div class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] flex items-center justify-center w-10 h-10 scale-x-[-1]">&#10140;</div>
                    <div class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] flex items-center justify-center w-10 h-10">&#10140;</div>
                </div>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-5">
                <div class="w-[304px] outline outline-1 outline-gray-300 hover:border-b-2 border-[{{ $settings->primary_color }}] rounded shadow-lg">
                    <div class="w-full h-[171px] bg-gray-500"></div>
                    {{-- <img src="" alt=""> --}}
                    <div class="w-full h-full bg-white p-2">
                        <div class="w-full font-semibold truncate">Title</div>
                        <div class="text-gray-400 text-sm">00/00/000</div><br>
                        <div class="h-full flex items-end justify-between">
                            <div class="w-2/3 flex flex-wrap items-center gap-2">
                                <div class="text-[{{ $settings->primary_color }}] bg-[{{ $settings->accent_color }}]/[0.5] px-2 rounded-full">category</div>
                            </div>
                            <div class="text-center text-sm">{{ $views }} views</div>
                        </div>
                    </div>
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
                {{-- <img src="" alt=""> --}}
                <div class="w-48 h-24 bg-white rounded shadow-lg outline outline-1 outline-gray-300"></div>
            </div>
        </section>
    @endif

</div>
@endsection