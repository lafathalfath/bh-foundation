<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bogor Heritage Foundation</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    {{--
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@php
    $app_settings = (object) [
        'app_name' => 'BH-Foundation',
        'logo_url' => 'http://localhost:8000/storage/LOGO-YPB_BULAT.png',
        'primary_color' => '#C17D40',
        'secondary_color' => '#16793C',
        'accent_color' => '#F5C97F',
        'info_color' => '#61CCEF'
    ];
@endphp

<body class="bg-white text-black min-h-[100vh]">
    <div>
        <nav
            class="fixed top-0 w-full bg-white px-10 py-3 flex items-center justify-between outline outline-1 outline-gray-200">
            <div class="flex items-center gap-3">
                <img src="{{ $app_settings->logo_url }}" alt="" class="w-10">
                <div class="font-semibold text-xl">
                    {{ $app_settings->app_name }}
                </div>
            </div>
            <div class="flex items-center justify-center gap-5">
                <a href="{{ route('home') }}"
                    class="p-2 {{ request()->getPathInfo() == '/' ? 'border-t-2' : '' }} border-[{{ $app_settings->primary_color }}] hover:bg-gray-200">
                    Home
                </a>
                <a href="{{ route('about') }}"
                    class="p-2 {{ request()->getPathInfo() == '/about-us' ? 'border-t-2' : '' }} border-[{{ $app_settings->primary_color }}] hover:bg-gray-200">
                    About Us
                </a>
                <a href="{{ route('works') }}"
                    class="p-2 {{ request()->getPathInfo() == '/our-works' ? 'border-t-2' : '' }} border-[{{ $app_settings->primary_color }}] hover:bg-gray-200">
                    Our Works
                </a>
                <a href="{{ route('ideas') }}"
                    class="p-2 {{ request()->getPathInfo() == '/ideas' ? 'border-t-2' : '' }} border-[{{ $app_settings->primary_color }}] hover:bg-gray-200">
                    Ideas
                </a>
                <a href="{{ route('contact') }}"
                    class="p-2 {{ request()->getPathInfo() == '/contact' ? 'border-t-2' : '' }} border-[{{ $app_settings->primary_color }}] hover:bg-gray-200">
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

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto max-w-6xl px-4 lg:px-0 grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Logo dan Deskripsi -->
            <div class="space-y-3">
                <img src="{{ $app_settings->logo_url }}" alt="Logo" class="w-10 mb-2">
                <h3 class="text-white text-lg font-bold">BH Foundation</h3>
                <p class="text-gray-500 text-sm">Aliquam rhoncus ligula est, non pulvinar elit convallis nec. Donec
                    mattis odio at.</p>
                <div class="flex gap-2 mt-3">
                    <!-- Ikon Sosial Media -->
                    <a href="#" class="bg-gray-700 hover:bg-[#3b5998] text-white rounded-full p-2"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" class="bg-gray-700 hover:bg-[#E4405F] text-white rounded-full p-2"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#" class="bg-gray-700 hover:bg-[#FF5700] text-white rounded-full p-2"><i
                            class="fab fa-tiktok"></i></a>
                    <a href="#" class="bg-gray-700 hover:bg-[#00acee] text-white rounded-full p-2"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#" class="bg-gray-700 hover:bg-[#FF0000] text-white rounded-full p-2"><i
                            class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Top 4 Category -->
            <div class="space-y-3">
                <h4 class="text-white text-base font-semibold">TOP 4 CATEGORY</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="#" class="hover:text-white">Development</a></li>
                    <li><a href="#" class="hover:text-white">Finance & Accounting</a></li>
                    <li><a href="#" class="hover:text-white">Design</a></li>
                    <li><a href="#" class="hover:text-white">Business</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="space-y-3">
                <h4 class="text-white text-base font-semibold">QUICK LINKS</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="#" class="hover:text-white">About</a></li>
                    <li><a href="#" class="hover:text-white flex items-center justify-between">Become Instructor</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                    <li><a href="#" class="hover:text-white">Career</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="space-y-3">
                <h4 class="text-white text-base font-semibold">SUPPORT</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="#" class="hover:text-white">Help Center</a></li>
                    <li><a href="#" class="hover:text-white">FAQs</a></li>
                    <li><a href="#" class="hover:text-white">Terms & Condition</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright dan Pilihan Bahasa -->
        <div class="border-t border-gray-700 mt-10 pt-5 text-center text-gray-500">
            <p class="text-xs">© 2025 - Bogor Heritage Foundation. All rights reserved</p>
            <div class="mt-2">
                <select class="bg-gray-800 text-white p-1 rounded text-xs">
                    <option>English</option>
                    <option>Bahasa Indonesia</option>
                </select>
            </div>
        </div>
    </footer>
</body>

</html>