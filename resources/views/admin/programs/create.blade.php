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

        <div class="flex justify-end space-x-2">
            <button type="button" class="btn btn-sm btn-warning text-white" onclick="checkFormBeforeBack()">Back</button>
            <button type="submit" class="btn btn-sm btn-success text-white">Save</button>
        </div>
    </form>
</div>

{{-- modals --}}
<div id="back_confirm_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 ">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="text-lg font-bold mb-4">Confirmation</h3>
        <p>Are you sure you want to go back? Any unsaved data will be lost.</p>
        <div class="mt-4 flex justify-end space-x-2">
            <button class="btn" onclick="closeModal()">Cancel</button>
            <button class="btn btn-error text-white" onclick="goBack()">Yes, Go Back</button>
        </div>
    </div>
</div>

{{-- javascript --}}
<script>
    function isFormFilled() {
        const title = document.getElementById('title').value.trim();
        const image = document.getElementById('image').value;
        const description = document.getElementById('description').value.trim();
        
        return title !== '' || image !== '' || description !== '';
    }

    function checkFormBeforeBack() {
        if (isFormFilled()) {
            openModal();
        } else {
            goBack();
        }
    }

    function openModal() {
        const modal = document.getElementById('back_confirm_modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('back_confirm_modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function goBack() {
        location.replace(document.referrer);
    }

    window.addEventListener('DOMContentLoaded', function () {
        closeModal(); 
    });
</script>

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