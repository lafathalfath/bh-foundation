@extends('layout.admin')
@section('content')
<style>
    label {
        font-weight: 500;
    }
</style>

<div>
    <div class="capitalize mb-10 text-2xl font-semibold">Edit {{ $type }}</div>
    
    <form action="{{ route('manage.article.update', request()->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label><br>
            <input type="text" name="title" id="title" placeholder="Type Here..." value="{{ $program->title }}" class="w-3/5 p-3 bg-white outline outline-1 outline-gray-300" required>
        </div>

        <div>
            <label for="image">Image</label><br>
            <div class="w-3/5">
                <img src="{{ $program->image_url }}" alt="" id="image-preview">
            </div>
            <input type="file" accept=".jpg,.jpeg,.png" name="image" id="image" class="w-3/5 p-3 bg-white outline outline-1 outline-gray-300" onchange="previewImage(this)">
        </div>

        <div>
            <label for="description">Description</label><br>
            <textarea name="description" id="description" placeholder="Type Here..." cols="30" rows="10" class="w-3/5 p-3 bg-white outline outline-1 outline-gray-300" required>{{ $program->description }}</textarea>
        </div>

        <div>
            <label>Categories</label><br>
            <div class="py-5 flex items-center gap-2" id="cat-entry">
                {{-- {{ dd($program->category) }} --}}
                @foreach ($program->category as $cat)
                    <div class="badge badge-accent" id="cat-item-{{ $cat->id }}">{{ $cat->name }}</div>
                @endforeach
            </div>
            <button type="button" class="bg-white p-3 outline outline-1 outline-gray-300" onclick="showCategories()">-- Select Categories --&emsp;<i class="fa-solid fa-caret-down"></i></button>
            <div id="categories-opt" class="w-fit bg-white rounded outline outline-1 outline-gray-300 shadow-lg" style="display: none;">
                <div class="flex flex-col" id="categories-opt">
                    @foreach ($categories as $cat)
                        <label for="cat-{{ $cat->id }}" class="min-w-56 px-5 py-2 hover:bg-gray-100 font-normal">
                            <input type="checkbox" name="categories[]" id="cat-{{ $cat->id }}" value="{{ $cat->id }}" onchange="addCategory({{ $cat->id }}, '{{ $cat->name }}')" {{ $program->category->contains('id', $cat->id) ? 'checked' : '' }}>
                            <span>{{ $cat->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('manage.article') }}" class="btn btn-sm btn-error text-white">Discard</a>
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
            };
            reader.readAsDataURL(file);
        }
    }

    const showCategories = () => {
        const categories = document.getElementById('categories-opt')
        categories.style.display = categories.style.display == 'none' ? 'block' : 'none'
    }

    const addCategory = (id, name) => {
        const entry = document.getElementById('cat-entry')
        const item = document.getElementById(`cat-item-${id}`)
        if (item) item.remove()
        else {
            const newItem = document.createElement('div')
            newItem.classList.add('badge', 'badge-accent')
            newItem.id = `cat-item-${id}`
            newItem.innerHTML = name
            entry.appendChild(newItem)
        }
    }
</script>

@endsection