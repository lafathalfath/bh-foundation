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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-black min-h-[100vh]">
    <div>
        <nav
            class="fixed top-0 w-full bg-white px-5 py-3 flex items-center justify-between outline outline-1 outline-gray-200 z-50">
            <!-- Logo dan Nama Aplikasi -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ $settings->logo_url }}" alt="" class="w-10">
                <div class="font-semibold text-xl">
                    {{ $settings->app_name }}
                </div>
            </a>

            <!-- Hamburger Menu (Mobile) -->
            <button id="menu-toggle" class="block md:hidden focus:outline-none text-2xl">
                ☰
            </button>

            <!-- Link Navigasi -->
            <div id="menu" class="hidden md:flex items-center gap-5">
                <a href="{{ route('home') }}"
                    class="p-2 {{ request()->getPathInfo() == '/' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    Home
                </a>
                <a href="{{ route('about') }}"
                    class="p-2 {{ request()->getPathInfo() == '/about-us' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    About Us
                </a>
                <div class="relative group">
                    <div tabindex="0" role="button"
                        class="p-2 border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                        Our Works <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <ul tabindex="0"
                        class="group-hover:block dropdown-content menu bg-white absolute hidden rounded-md shadow-md w-52 p-2 z-10">
                        <li><a href="https://stpbogor.ac.id/">STP</a></li>
                        <li><a href="https://lkp.stpbogor.ac.id/">LKP</a></li>
                        <li><a href="https://lsp.stpbogor.ac.id/">LSP</a></li>
                        <li><a href="https://lppm.stpbogor.ac.id/">LPPM</a></li>
                    </ul>
                </div>
                <a href="{{ route('ideas') }}"
                    class="p-2 {{ request()->getPathInfo() == '/ideas' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    Ideas
                </a>
                <a href="{{ route('contact') }}"
                    class="p-2 {{ request()->getPathInfo() == '/contact' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    Contact
                </a>
            </div>

            <!-- Search Box -->
            <div class="hidden md:flex items-center gap-3 px-3 py-1 outline outline-1 outline-gray-300">
                <div class="text-xl">⌕</div>
                <input type="search" name="search" class="outline-none bg-white" placeholder="Search...">
            </div>
        </nav>

        <!-- Dropdown Menu (Mobile) -->
        <div id="mobile-menu"
            class="md:hidden flex flex-col gap-2 px-5 pt-3 pb-5 bg-white shadow-md fixed top-14 left-0 w-full z-40">
            <a href="{{ route('home') }}"
                class="p-2 {{ request()->getPathInfo() == '/' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                Home
            </a>
            <a href="{{ route('about') }}"
                class="p-2 {{ request()->getPathInfo() == '/about-us' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                About Us
            </a>
            <div class="p-2 hover:bg-gray-200">
                Our Works <i class="fa-solid fa-caret-down"></i>
                <ul class="pl-4 mt-2">
                    <li><a href="https://stpbogor.ac.id/">STP</a></li>
                    <li><a href="https://lkp.stpbogor.ac.id/">LKP</a></li>
                    <li><a href="https://lsp.stpbogor.ac.id/">LSP</a></li>
                    <li><a href="https://lppm.stpbogor.ac.id/">LPPM</a></li>
                </ul>
            </div>
            <a href="{{ route('ideas') }}"
                class="p-2 {{ request()->getPathInfo() == '/ideas' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                Ideas
            </a>
            <a href="{{ route('contact') }}"
                class="p-2 {{ request()->getPathInfo() == '/contact' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                Contact
            </a>
        </div>
    </div>
    <div class="pt-[70px]">
        @if ($errors->any())
            <div class="fixed w-full p-3">
                @foreach ($errors->all() as $key => $err)
                    <div class="bg-error p-3 rounded-xl" id="error-{{ $key }}" onclick="hideError({{ $key }})">{{ $err }}</div>
                @endforeach
            </div>
        @endif
        @if (session('success'))
            <div class="fixed w-full p-3">
                <div class="bg-success p-3 rounded-xl" id="success" onclick="hideSuccess()">{{ session('success') }}</div>
            </div>
        @endif

        @yield('content')
    </div>
    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto max-w-6xl px-4 lg:px-0 grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Logo dan Deskripsi -->
            <div class="space-y-3">
                <div class="flex items-center space-x-3">
                    <img src="{{ $settings->logo_url }}" alt="Logo" class="w-10 mb-2">
                    <h3 class="text-white text-lg font-bold">BH Foundation</h3>
                </div>
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
                    <li><a href="#" class="hover:text-white flex items-center justify-between">Become Instructor</a>
                    </li>
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

    <script>
        // JavaScript untuk Toggle Menu
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        const hideError = (id) => {
            const alert = document.getElementById(`error-${id}`)
            alert.style.display = 'none'
        }
        const hideSuccess = () => {
            const alert = document.getElementById('success')
            alert.style.display = 'none'
        }
    </script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            duration: 1000, // Durasi animasi (1 detik)
            once: false,    // Animasi akan di-trigger setiap muncul di viewport
        });
    });
</script>
</body>

</html>