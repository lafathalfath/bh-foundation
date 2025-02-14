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

<div >
    <form action="{{ route('admin.app_settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="app_name">App Name</label><br>
            <input type="text" name="app_name" id="app_name" placeholder="Type Here..." value="{{ $settings->app_name }}" class="input-box" required>
        </div>
        <div class="mb-3">
            <label for="logo">Icon Logo</label><br>
            <div class="w-1/4">
                <img src="{{ $settings->logo_url }}" alt="">
            </div>
            <input type="file" name="logo" id="logo" class="input-box" accept=".jpg,.jpeg,.png">
        </div>
        <div class="mb-3">
            <label for="logo_banner">Logo Banner</label><br>
            <div class="w-1/4 bg-gray-400">
                <img src="{{ $settings->logo_banner_url }}" alt="">
            </div>
            <input type="file" name="logo_banner" id="logo_banner" class="input-box"  accept=".jpg,.jpeg,.png">
        </div>
        <div class="mb-3">
            <label for="primary_color">Primary Color</label><br>
            <input type="color" name="primary_color" id="primary_color" value="{{ $settings->primary_color }}" class="w-48 bg-[#272B34]" required>
        </div>
        <div class="mb-3">
            <label for="secondary_color">Secondary Color</label><br>
            <input type="color" name="secondary_color" id="secondary_color" value="{{ $settings->secondary_color }}" class="w-48 bg-[#272B34]" required>
        </div>
        <div class="mb-3">
            <label for="accent_color">Accent Color</label><br>
            <input type="color" name="accent_color" id="accent_color" value="{{ $settings->accent_color }}" class="w-48 bg-[#272B34]" required>
        </div>
        <div class="mb-3">
            <label for="info_color">Info Color</label><br>
            <input type="color" name="info_color" id="info_color" value="{{ $settings->info_color }}" class="w-48 bg-[#272B34]" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-10 py-2 bg-green-700 text-white">Save</button>
        </div>
    </form>
</div>

<script>
    // const handleInput = (e) => {
    //     // const file = e.target.files[0];
    //     console.log(e.value);
    // }
</script>
@endsection