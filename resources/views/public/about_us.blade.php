@extends('layout.public')
@section('content')
<div class="flex flex-col gap-5">
    @if ($about->is_hero_visible)
        <section class="flex items-center justify-between h-96">
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
</div>
@endsection