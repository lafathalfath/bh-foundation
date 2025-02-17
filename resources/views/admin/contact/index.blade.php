@extends('layout.admin')
@section('content')
    <style>
        .input-box {
            width: 60%;
            background-color: #fff;
            padding: 10px;
            outline: 1px solid #d1d5db;
        }

        .input-box:focus {
            outline: 1px solid #d1d5db;
        }

        label {
            font-weight: 500;
        }
    </style>
    <div>
        <form action="{{ route('manage.page.contact.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="hero_title">Hero Title</label><br>
                <input type="text" name="hero_title" id="hero_title" placeholder="Type Here..."
                    value="{{ $front_page->hero_title }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="hero_description">Hero Description</label><br>
                <input type="textarea" name="hero_description" id="hero_description" placeholder="Type Here..."
                    value="{{ $front_page->hero_description }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="hero_image">Hero Image</label><br>
                <div class="w-1/4">
                    <img src="{{ $front_page->hero_image_url }}" alt="">
                </div>
                <input type="file" name="hero_image" id="hero_image" class="input-box" accept=".jpg,.jpeg,.png">
            </div>
            <div class="mb-3">
                <label for="hero_bg_color">Hero Backgroun Color</label><br>
                <input type="color" name="hero_bg_color" id="hero_bg_color" value="{{ $front_page->hero_bg_color }}"
                    class="w-48 bg-[#272B34]" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-10 py-2 bg-green-700 text-white">Save</button>
            </div>
        </form>
    </div>
@endsection