@php
    $settings = (object) [
        'app_name' => 'BH-Foundation',
        'logo_url' => 'http://localhost:8000/storage/LOGO-YPB_BULAT.png',
        'logo_banner_url' => 'http://localhost:8000/storage/LOGO-YPB_NOBG.png',
        'primary_color' => '#C17D40',
        'secondary_color' => '#16793C',
        'accent_color' => '#F5C97F',
        'info_color' => '#61CCEF'
    ];
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black min-h-[100vh]">
    <div>
        <nav class="fixed top-0 w-full bg-white px-10 py-3 flex items-center justify-between outline outline-1 outline-gray-200">
            <div class="flex items-center gap-3">
                <img src="{{ $settings->logo_url }}" alt="" class="w-10">
                <div class="font-semibold text-xl">
                    {{ $settings->app_name }}
                </div>
            </div>
            <div class="flex items-center justify-center gap-5">
                <a href="{{ route('home') }}" class="p-2 {{ request()->getPathInfo() == '/' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    Home
                </a>
                <a href="{{ route('about') }}" class="p-2 {{ request()->getPathInfo() == '/about-us' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    About Us
                </a>
                <a href="{{ route('works') }}" class="p-2 {{ request()->getPathInfo() == '/our-works' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    Our Works
                </a>
                <a href="{{ route('ideas') }}" class="p-2 {{ request()->getPathInfo() == '/ideas' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    Ideas
                </a>
                <a href="{{ route('contact') }}" class="p-2 {{ request()->getPathInfo() == '/contact' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    Contact
                </a>
            </div>
            <div class="flex items-center gap-3 px-3 py-1 outline outline-1 outline-gray-300">
                <div class="text-xl">⌕</div>
                <input type="search" class="outline-none bg-white" placeholder="Search...">
            </div>
        </nav>
    </div>
    <div class="pt-[70px]">
        @yield('content')
    </div>
</body>
</html>