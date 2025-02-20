@extends('layout.admin')
@section('content')
    
<div>
    <div class="text-xl font-semibold mb-10">Manage Categories</div>
    <div class="flex justify-end"><button class="btn btn-sm btn-success text-white" onclick="create_modal.showModal()">+ Create New</button></div>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead class="text-black text-center">
                <tr>
                    <th class="w-10">#</th>
                    <th>Name</th>
                    <th>In Uses of Articles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $item)
                    <tr class="hover:bg-gray-300">
                        <th class="text-center">{{ $loop->iteration }}</th>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-center">{{ count($item->program) }}</td>
                        <td class="flex items-center justify-center gap-2">
                            <button class="btn btn-sm btn-warning" onclick="handleEdit('{{ route('manage.categories.update', Crypt::encryptString($item->id)) }}', '{{ $item->name }}')"><i class="fa-solid fa-pencil"></i> Edit</button>
                            <button class="btn btn-sm btn-error text-white" onclick="handleDelete('{{ route('manage.categories.destroy', Crypt::encryptString($item->id)) }}')"><i class="fa-solid fa-trash-can"></i> Delete</button>
                        </td>
                    </tr>
                @empty
                    <td colspan="4" class="flex justify-center">Empty</td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- modals --}}
<dialog id="create_modal" class="modal">
    <div class="modal-box bg-white">
        <h3 class="text-lg font-bold mb-3">Create New Category</h3>
        <div>
            <form action="{{ route('manage.categories.store') }}" method="POST" id="create_form">
                @csrf
                <div>
                    <label for="create_name" class="font-semibold">Name</label><br>
                    <input type="text" name="name" id="create_name" class="w-full bg-white p-3 outline outline-1 outline-gray-300" placholder="Type Here..." required>
                </div>
            </form>
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-error text-white">Discard</button>
            </form>
            <button type="submit" class="btn btn-success text-white" onclick="create_form.submit()">Update</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="edit_modal" class="modal">
    <div class="modal-box bg-white">
        <h3 class="text-lg font-bold mb-3">Edit Category</h3>
        <div>
            <form action="" method="POST" id="edit_form">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_name" class="font-semibold">Name</label><br>
                    <input type="text" name="name" id="edit_name" class="w-full bg-white p-3 outline outline-1 outline-gray-300" placholder="Type Here..." required>
                </div>
            </form>
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-error text-white">Discard</button>
            </form>
            <button type="submit" class="btn btn-success text-white" onclick="edit_form.submit()">Save</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="delete_modal" class="modal">
    <div class="modal-box bg-white">
        <h3 class="text-lg font-bold mb-3">Confirmation</h3>
        <div>
            Are you sure you want to delete this category?
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn bg-gray-500 border-none text-white">Cancel</button>
            </form>
            <form action="" method="POST" id="delete_form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error text-white">Delete</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
{{-- modals --}}

<script>
    const handleEdit = (route, name) => {
        const modal = document.getElementById('edit_modal')
        const form = document.getElementById('edit_form')
        const nameInput = document.getElementById('edit_name')
        form.action = route
        nameInput.value = name
        modal.showModal()
        
    }

    const handleDelete = (route) => {
        const modal = document.getElementById('delete_modal')
        const form = document.getElementById('delete_form')
        form.action = route
        modal.showModal()
    }
</script>

@endsection