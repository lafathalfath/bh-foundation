@extends('layout.admin')
@section('content')
<style>
    label {
        font-weight: 500;
    }
</style>

<section>
    <div class="text-4xl font-semibold mb-10">Profile</div>
    <form action="{{ route('manage.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Username</label><br>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="bg-white p-3 w-3/5 outline outline-1 outline-gray-300" oninput="handleChangeProfile()" required>
        </div>
        <div class="mb-3">
            <label for="email">email</label><br>
            <input type="text" id="email" name="email" value="{{ $user->email }}" class="bg-white p-3 w-3/5 outline outline-1 outline-gray-300" oninput="handleChangeProfile()" required>
        </div>
        <div style="display: none;" id="profile-action">
            <div class="flex items-center justify-end gap-2">
                <button type="button" class="btn btn-sm btn-error text-white" onclick="handleDiscardProfile({{ $user }})">Discard</button>
                <button type="submit" class="btn btn-sm btn-success text-white" id="save-profile" disabled>Save</button>
            </div>
        </div>
    </form>
</section>

<section class="mt-10">
    <div class="text-xl font-semibold mb-5">Reset Password</div>
    <form action="{{ route('manage.profile.reset_password') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="password">Password</label><br>
            <div class="bg-white w-3/5 flex items-center outline outline-1 outline-gray-300">
                <input type="password" name="password" id="password" placeholder="Insert Your Password" class="w-full p-3 bg-white outline-none" oninput="handleChangePassword()" required>
                <button type="button" class="p-3" onclick="toggleShowPassword(this)">show</button>
            </div>
        </div>
        <div class="mb-3">
            <label for="new_password">New Password</label><br>
            <div class="bg-white w-3/5 flex items-center outline outline-1 outline-gray-300">
                <input type="password" name="new_password" id="new_password" placeholder="Insert New Password" class="w-full bg-white p-3 outline-none" oninput="handleChangePassword()" required>
                <button type="button" class="p-3" onclick="toggleShowNewPassword(this)">show</button>
            </div>
        </div>
        <div>
            <label for="new_password">Confirm New Password</label><br>
            <div class="bg-white w-3/5 flex items-center outline outline-1 outline-gray-300">
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm New Password" class="w-full bg-white p-3 outline-none" oninput="handleChangePassword()" required>
                <button type="button" class="p-3" onclick="toggleShowConfirmPassword(this)">show</button>
            </div>
        </div>
        <div style="display: none;" id="password-action">
            <div class="flex items-center justify-end gap-2">
                <button type="button" class="btn btn-sm btn-error text-white" onclick="handleDiscardPassword()">Discard</button>
                <button type="submit" class="btn btn-sm btn-success text-white" id="save-password" disabled>Save</button>
            </div>
        </div>
    </form>
</section>

<script>
    const handleChangeProfile = () => {
        const profileAction = document.getElementById('profile-action')
        const save = document.getElementById('save-profile')
        profileAction.style.display = 'block'
        save.disabled = false
    }
    const handleDiscardProfile = (user) => {
        const username = document.getElementById('name')
        const email = document.getElementById('email')
        const profileAction = document.getElementById('profile-action')
        const save = document.getElementById('save-profile')
        username.value = user.name
        email.value = user.email
        profileAction.style.display = 'none'
        save.disabled = true
    }

    const handleChangePassword = () => {
        const passwordAction = document.getElementById('password-action')
        const save = document.getElementById('save-password')
        passwordAction.style.display = 'block'
        save.disabled = false
    }
    const handleDiscardPassword = () => {
        const passwordAction = document.getElementById('password-action')
        const save = document.getElementById('save-password')
        const password = document.getElementById('password')
        const newPassword = document.getElementById('new_password')
        const newPasswordConfirmation = document.getElementById('new_password_confirmation')
        password.value = ''
        newPassword.value = ''
        newPasswordConfirmation.value = ''
        passwordAction.style.display = 'none'
        save.disabled = true
    }
    const toggleShowPassword = (e) => {
        const password = document.getElementById('password')
        password.type = password.type == 'password' ? 'text' : 'password'
        e.innerHTML = e.innerHTML == 'show' ? 'hide' : 'show'
    }
    const toggleShowNewPassword = (e) => {
        const password = document.getElementById('new_password')
        password.type = password.type == 'password' ? 'text' : 'password'
        e.innerHTML = e.innerHTML == 'show' ? 'hide' : 'show'
    }
    const toggleShowConfirmPassword = (e) => {
        const password = document.getElementById('new_password_confirmation')
        password.type = password.type == 'password' ? 'text' : 'password'
        e.innerHTML = e.innerHTML == 'show' ? 'hide' : 'show'
    }
</script>

@endsection