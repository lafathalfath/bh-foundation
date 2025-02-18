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
        <form action="{{ route('manage.page.contact.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="description">Description</label><br>
                <input type="text" name="description" id="description" placeholder="Type Here..." cols="30" rows="10"
                    value="{{ $contact->description }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="address">Address</label><br>
                <input type="text" name="address" id="address" placeholder="Type Here..."
                    value="{{ $contact->address }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="phone">Phone Number</label><br>
                <input type="text" name="phone" id="phone" placeholder="Type Here..."
                    value="{{ $contact->phone }}" class="input-box" required>
            </div>
            <div class="mb-3">
                <label for="email">Email</label><br>
                <input type="text" name="email" id="email" placeholder="Type Here..."
                    value="{{ $contact->email }}" class="input-box" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-10 py-2 bg-green-700 text-white">Save</button>
            </div>
        </form>
    </div>
@endsection