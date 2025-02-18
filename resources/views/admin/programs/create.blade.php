@extends('layout.admin')
@section('content')
<style>
    label {
        font-weight: 500;
    }
</style>

<div>
    <div class="capitalize mb-10 text-2xl font-semibold">Create {{ $type }}</div>
    
    <form action="{{ route('manage.article.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">
        @csrf
        <input type="number" value="{{ $program_type_id }}" name="type_id" style="display: none;">

        <div>
            <label for="title">Title</label><br>
            <input type="text" name="title" id="title" placeholder="Type Here..." class="w-3/5 p-3 bg-white outline outline-1 outline-gray-300" required>
        </div>

        <div>
            <label for="image">Image</label><br>
            <div class="w-3/5">
                <img src="" alt="" id="image-preview" style="display: none;">
            </div>
            <input type="file" accept=".jpg,.jpeg,.png" name="image" id="image" class="w-3/5 p-3 bg-white outline outline-1 outline-gray-300" onchange="previewImage(this)" required>
        </div>

        <div>
            <label for="description">Description</label><br>
            <textarea name="description" id="description" placeholder="Type Here..." cols="30" rows="10" class="w-3/5 p-3 bg-white outline outline-1 outline-gray-300" required></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-sm btn-success text-white">Save</button>
        </div>
    </form>
</div>

<script>
    const previewImage = (e) => {
        const file = event.target.files[0];
        const imagePreview = document.getElementById('image-preview')
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection