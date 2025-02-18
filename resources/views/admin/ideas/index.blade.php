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
        <form action="{{ route('manage.page.ideas.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- <div class="mt-10 mb-5">
                    <input type="checkbox" name="is_hero_visible" id="is_hero_visible" placeholder="Type Here..."
                        value="true" class="" {{ $ideas->is_hero_visible ? 'checked' : '' }}>
                    <label class="text-xl" for="is_hero_visible">Hero Section</label>
                </div> -->
            <div class="mb-3">
                <label for="title">Title</label><br>
                <input type="text" name="title" id="title" placeholder="Type Here..."
                    value="{{ $ideas->title }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="description">Description</label><br>
                <textarea type="text" name="description" id="description" placeholder="Type Here..." cols="30" rows="10"
                    class="input-box" required>
                        {{ $ideas->description }}
                        </textarea>
            </div>
            <div class="mb-3">
                <label for="image">Image</label><br>
                <div class="w-1/4">
                    <img src="{{ $ideas->image_url }}" alt="">
                </div>
                <input type="file" name="image" id="image" class="input-box" accept=".jpg,.jpeg,.png">
            </div>
            <div class="mb-3">
                <label for="major_title">Major_Title</label><br>
                <input type="text" name="major_title" id="major_title" placeholder="Type Here..."
                    value="{{ $ideas->major_title }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="major_description">Major_Description</label><br>
                <textarea type="text" name="major_description" id="major_description" placeholder="Type Here..." cols="30" rows="10"
                    class="input-box" required>
                        {{ $ideas->major_description }}
                        </textarea>
            </div>
            <div class="mb-3">
                <label for="image">Major_Image</label><br>
                <div class="w-1/4">
                    <img src="{{ $ideas->major_image_url }}" alt="">
                </div>
                <input type="file" name="major_image" id="major_image" class="input-box" accept=".jpg,.jpeg,.png">
            </div>
            <!-- <div class="mt-10 mb-5">
                    <input type="checkbox" name="is_about_visible" id="is_about_visible" placeholder="Type Here..."
                        value="true" class="" {{ $ideas->is_about_visible ? 'checked' : '' }}>
                    <label class="text-xl" for="is_about_visible">about Section</label>
                </div>
                <div class="mt-10 mb-5">
                    <input type="checkbox" name="is_recent_news_visible" id="is_recent_news_visible" placeholder="Type Here..."
                        value="true" class="" {{ $ideas->is_recent_news_visible ? 'checked' : '' }}>
                    <label class="text-xl" for="is_recent_news_visible">Recent News Section</label>
                </div> -->
            <div class="flex justify-end">
                <button type="submit" class="px-10 py-2 bg-green-700 text-white">Save</button>
            </div>
        </form>
    </div>
@endsection