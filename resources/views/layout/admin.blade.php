@php
    $settings = \App\Models\AppSettings::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ $settings->logo_url }}" type="image/x-icon">
    <title>Bogor Heritage Foundation</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black h-[100vh] overflow-hidden">
    <div class="flex">

        <div class="w-fit h-[100vh] overflow-hidden bg-[#1D2026] text-white">
            <a href="{{ route('home') }}" class="p-5 w-72 flex items-center gap-2 border-b border-gray-500">
                <div class="w-10"><img src="{{ $settings->logo_url }}" alt=""></div>
                <div class="text-lg font-semibold">{{ $settings->app_name }}</div>
            </a>
            <div class="h-[84vh] my-5 flex flex-col justify-between">
                <div>
                    <div class="px-5 py-3 {{ request()->routeIs('manage.dashboard') ? "bg-[$settings->primary_color] text-white" : "hover:bg-[$settings->primary_color]/[0.5] text-gray-300 hover:text-white" }}">
                        <a href="{{ route('manage.dashboard') }}">Dashboard</a>
                    </div>
                    <div class="px-5 py-3 hover:bg-[{{ $settings->primary_color }}]/[0.5] text-gray-300 hover:text-white">
                        <div href="">App Settings</div>
                    </div>
                    <div class="px-5 py-3 {{ request()->routeIs('manage.app_settings.view') ? "bg-[$settings->primary_color] text-white" : "hover:bg-[$settings->primary_color]/[0.5] text-gray-300 hover:text-white" }}">
                        <a href="{{ route('manage.app_settings.view') }}">App Settings</a>
                    </div>
                    <div class="px-5 py-3 {{ request()->routeIs('manage.front_page.view') ? "bg-[$settings->primary_color] text-white" : "hover:bg-[$settings->primary_color]/[0.5] text-gray-300 hover:text-white" }}">
                        <a href="{{ route('manage.front_page.view') }}">Front Page</a>
                    </div>
                </div>
                <div>
                    <div class="px-5 py-3 hover:bg-red-800 text-gray-300 hover:text-white">
                        <a href="{{ route('auth.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i>&emsp;Logout</a>
                    </div> 
                </div>
            </div>
        </div>

        <div class="w-full h-[100vh] overflow-hidden bg-gray-200">
            @if ($errors->any())
                <div class="fixed w-full p-3">
                    @foreach ($errors->all() as $key=>$err)
                        <div class="bg-error p-3 rounded-xl" id="error-{{ $key }}" onclick="hideError({{ $key }})">{{ $err }}</div>
                    @endforeach
                </div>
            @endif
            @if (session('success'))
                <div class="fixed w-full p-3">
                    <div class="bg-success p-3 rounded-xl" id="success" onclick="hideSuccess()">{{ session('success') }}</div>
                </div>
            @endif

            <div class="bg-white w-full px-10 py-5 flex items-center justify-between">
                <div class="text-lg capitalize font-semibold">
                    @if (request()->routeIs('manage.dashboard'))
                        Dashboard
                    @elseif (request()->routeIs('manage.app_settings.view'))
                        App Settings
                    @endif
                </div>
                <div>
                    <div class="flex items-center gap-3 px-3 py-1 outline outline-1 outline-gray-300">
                        <div class="text-xl">⌕</div>
                        <input type="search" name="search" class="outline-none bg-white" placeholder="Search...">
                    </div>
                </div>
            </div>
            <div class="p-5 h-[91vh] overflow-y-scroll">
                @yield('content')
                <br>
                <br>
                <div class="flex items-center justify-between text-xs text-gray-600">
                    <div>© 2025 - Bogor Heritage Foundation. All rights reserved</div>
                    <div>FAQs&emsp;Privacy Policy&emsp;Terms & Condition</div>
                </div>
            </div>
        </div>

    </div>
    
    <script>
        const hideError = (id) => {
            const alert = document.getElementById(`error-${id}`)
            alert.style.display = 'none'
        }
        const hideSuccess = () => {
            const alert = document.getElementById('success')
            alert.style.display = 'none'
        }
    </script>
</body>
</html>