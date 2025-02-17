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
    
    <form action="{{ route('manage.page.about.update') }}" method="POST" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
        <div class="mb-5">
            <input type="checkbox" name="is_hero_visible" id="is_hero_visible" placeholder="Type Here..." value="1" class="" {{ $about->is_hero_visible ? 'checked' : '' }}>
            <label class="text-xl" for="is_hero_visible">Hero Section</label>
        </div>
        <section id="hero">
            <div class="mb-3">
                <label for="title">Title</label><br>
                <input type="text" name="title" id="title" placeholder="Type Here..." value="{{ $about->title }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="description">Description</label><br>
                <textarea type="text" name="description" id="description" placeholder="Type Here..." class="input-box" cols="30" rows="10" required>
                    {{ $about->description }}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="image_1">Image</label><br>
                <div class="w-3/5 mb-2">
                    <img src="{{ $about->image_1_url }}" alt="">
                </div>
                <input type="file" name="image_1" id="image_1" class="input-box" accept=".jpg,.jpeg,.png">
            </div>
        </section>

        <div class="mt-10 mb-5">
            <input type="checkbox" name="is_vision_visible" id="is_vision_visible" placeholder="Type Here..." value="1" class="" {{ $about->is_vision_visible ? 'checked' : '' }}>
            <label class="text-xl" for="is_vision_visible">Vision & Mision Section</label>
        </div>
        <section id="vision">
            <div class="mb-3">
                <label for="image_2">Image</label><br>
                <div class="w-3/5 mb-2">
                    <img src="{{ $about->image_2_url }}" alt="">
                </div>
                <input type="file" name="image_2" id="image_2" class="input-box" accept=".jpg,.jpeg,.png">
            </div>
            <div class="mb-3">
                <label for="vision">Vision</label><br>
                <textarea type="text" name="vision" id="vision" placeholder="Type Here..." class="input-box" cols="30" rows="10" required>
                    {{ $about->vision }}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="mision">Mision</label><br>
                <textarea type="text" name="mision" id="mision" placeholder="Type Here..." class="input-box" cols="30" rows="10" required>
                    {{ $about->mision }}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="bg_color">Background Color</label><br>
                <input type="color" name="bg_color" id="bg_color" value="{{ $about->bg_color }}" class="input-box" required>
            </div>
        </section>

        <div class="mt-10 mb-5">
            <input type="checkbox" name="is_members_visible" id="is_members_visible" placeholder="Type Here..." value="1" class="" {{ $about->is_members_visible ? 'checked' : '' }}>
            <label class="text-xl" for="is_members_visible">Members Section</label>
        </div>

        <div class="mt-10 mb-5">
            <input type="checkbox" name="is_programs_visible" id="is_programs_visible" placeholder="Type Here..." value="1" class="" {{ $about->is_programs_visible ? 'checked' : '' }}>
            <label class="text-xl" for="is_programs_visible">Programs Section</label>
        </div>

        <div class="mt-10 mb-5">
            <input type="checkbox" name="is_partners_visible" id="is_partners_visible" placeholder="Type Here..." value="1" class="" {{ $about->is_partners_visible ? 'checked' : '' }}>
            <label class="text-xl" for="is_partners_visible">Partners Section</label>
        </div>
        <section id="partners">
            <div class="mb-3">
                <label for="partners_title">Title</label><br>
                <input type="text" name="partners_title" id="partners_title" placeholder="Type Here..." value="{{ $about->partners_title }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="partners_description">Description</label><br>
                <textarea type="text" name="partners_description" id="partners_description" placeholder="Type Here..." class="input-box" cols="30" rows="10" required>
                    {{ $about->partners_description }}
                </textarea>
            </div>
        </section>

        <div class="my-10 flex justify-center">
            <button type="submit" class="btn btn-sm btn-wide btn-success text-white">Save</button>
        </div>
        <div class="w-full h-[1px] mb-10 bg-gray-500"></div>
    </form>

    <section id=""></section>
    
    <section id="set-partners">
        <div class="mb-3">
            <label>All Partners</label>
            <div class="flex items-center flex-wrap gap-2">
                <button type="button" class="bg-success text-white font-bold px-2.5 pb-1 text-2xl rounded-full flex items-center justify-center" onclick="toggleAddPartner()">+</button>
                @foreach ($partners as $prt)
                    <div class="w-48 overflow-hidden">
                        <div class="my-1 flex items-center justify-between">
                            <div class="font-semibold">{{ $prt->name }}</div>
                            <div class="flex-items-center">
                                <button type="button" class="btn btn-xs btn-warning" onclick="handleEditPartner({
                                    ...{{ $prt }}, 
                                    route: '{{ route('manage.partner.update', Crypt::encryptString($prt->id)) }}'
                                })"><i class="fa-solid fa-pen"></i></button>
                                <button type="button" class="btn btn-xs btn-error text-white" onclick="handleDeletePartner('{{ route('manage.partner.destroy', Crypt::encryptString($prt->id)) }}')"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="p-5 w-full h-24 bg-white shadow-lg outline outline-1 outline-gray-200 flex items-center justify-center rounded">
                            <img class="max-w-full max-h-full" src="{{ $prt->image_url }}" alt="">
                        </div>
                        <a href="{{ $prt->url }}" class="w-full truncate hover:text-blue-500">
                            {{ $prt->url }}
                        </a>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('manage.partner.store') }}" method="POST" enctype="multipart/form-data" id="add_partner" class="mt-3 p-5 outline outline-1 outline-gray-500 w-fit" style="display: none;">
                @csrf
                <div class="mb-2">
                    <label for="partner_name">Name</label><br>
                    <input type="text" name="name" id="partner_name" placeholder="Type Here..." class="bg-white outline outline-1 outline-gray-300 p-3" required>
                </div>
                <div class="mb-2">
                    <label for="partner_url">URL</label><br>
                    <input type="text" name="url" id="partner_url" placeholder="Type Here..." class="bg-white outline outline-1 outline-gray-300 p-3" required>
                </div>
                <div class="mb-2">
                    <label for="partner_image">Image</label><br>
                    <input type="file" name="image" id="partner_image" placeholder="Type Here..." class="bg-white outline outline-1 outline-gray-300 p-3" accept=".jpg,.jpeg,.png" required>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Submit</button>
            </form>
        </div>
    </section>
</div>

{{-- modals --}}
<dialog id="update_partner_modal" class="modal">
    <div class="modal-box bg-white">
        <h3 class="text-lg font-bold">Edit Partner</h3>
        <div>
            <form action="" method="POST" enctype="multipart/form-data" id="edit_partner" class="w-full">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="edit_partner_name">Name</label><br>
                    <input type="text" name="name" id="edit_partner_name" placeholder="Type Here..." class="bg-white outline outline-1 outline-gray-300 p-3" required>
                </div>
                <div class="mb-2">
                    <label for="edit_partner_url">URL</label><br>
                    <input type="text" name="url" id="edit_partner_url" placeholder="Type Here..." class="bg-white outline outline-1 outline-gray-300 p-3" required>
                </div>
                <div class="mb-2">
                    <label for="edit_partner_image">Image</label><br>
                    <input type="file" name="image" id="edit_partner_image" placeholder="Type Here..." class="bg-white outline outline-1 outline-gray-300 p-3" accept=".jpg,.jpeg,.png">
                </div>
            </form>
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
            <button type="submit" class="btn btn-success" onclick="handleUpdatePartner()">Submit</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="delete_partner_modal" class="modal">
    <div class="modal-box bg-white">
        <h3 class="text-lg font-bold">Edit Partner</h3>
        <div>
            Are you sure to delete this partner?
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
            <form action="" id="delete_partner" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error">Delete</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
{{-- end modals --}}

<script>
    const toggleAddPartner = () => {
        const form = document.getElementById('add_partner')
        form.style.display = form.style.display == 'none' ? 'block' : 'none'
    }
    const handleSubmit = () => {
        const form = dovument.getElementById('form')
        form.submit()
    }
    const handleEditPartner = (data) => {
        const modal = document.getElementById('update_partner_modal')
        const form = document.getElementById('edit_partner')
        const name = document.getElementById('edit_partner_name')
        const url = document.getElementById('edit_partner_url')
        form.action = data.route
        name.value = data.name
        url.value = data.url
        modal.showModal()
    }
    const handleUpdatePartner = () => {
        const form = document.getElementById('edit_partner')
        form.submit()
    }
    const handleDeletePartner = (route) => {
        const modal = document.getElementById('delete_partner_modal')
        const form = document.getElementById('delete_partner')
        modal.showModal()
        form.action = route
    }
</script>

@endsection