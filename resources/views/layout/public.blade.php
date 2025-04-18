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
            <button id="menu-toggle" class="block min-[960px]:hidden focus:outline-none text-2xl">
                ☰
            </button>

            <!-- Link Navigasi -->
            <div id="menu" class="hidden min-[960px]:flex items-center gap-5">
                <a href="{{ route('home') }}"
                    class="p-2 {{ request()->getPathInfo() == '/' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    @lang('messages.home')
                </a>
                <a href="{{ route('about') }}"
                    class="p-2 {{ request()->getPathInfo() == '/about-us' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    @lang('messages.about_us')
                </a>
                <div class="relative group">
                    <div tabindex="0" role="button"
                        class="p-2 border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                        @lang('messages.our_works') <i class="fa-solid fa-caret-down"></i>
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
                    @lang('messages.ideas')
                </a>
                <a href="{{ route('contact') }}"
                    class="p-2 {{ request()->getPathInfo() == '/contact' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                    @lang('messages.contact')
                </a>
            </div>

            <form action="{{ route('globalSearch') }}" method="GET"
                class="hidden min-[960px]:flex items-center gap-3 px-3 py-1 outline outline-1 outline-gray-300">
                <div class="text-xl">⌕</div>
                <input type="search" name="search" id="search" class="outline-none bg-white"
                    placeholder="{{ translate('Search...', session('locale', 'en')) }}" value="{{ request('search') }}">
                <input type="hidden" name="type" id="searchType" value="{{ request('type', 'all') }}">
            </form>

        </nav>

        <!-- Dropdown Menu (Mobile) -->
        <div id="mobile-menu" class="flex-col gap-2 px-5 pt-3 pb-5 bg-white shadow-md fixed top-[9%] left-0 w-full z-40"
            style="display: none;">
            <a href="{{ route('home') }}"
                class="p-2 {{ request()->getPathInfo() == '/' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                @lang('messages.home')
            </a>
            <a href="{{ route('about') }}"
                class="p-2 {{ request()->getPathInfo() == '/about-us' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                @lang('messages.about_us')
            </a>
            <div>
                <button onclick="ToggleMobileOw(this)" class="w-full text-start p-2 hover:bg-gray-200">Our Works <i
                        class="fa-solid fa-caret-right"></i></button>
                <ul class="pl-4 mt-2" id="mobile-ow" style="display: none;">
                    <li class="p-1 hover:bg-gray-200"><a href="https://stpbogor.ac.id/">STP</a></li>
                    <li class="p-1 hover:bg-gray-200"><a href="https://lkp.stpbogor.ac.id/">LKP</a></li>
                    <li class="p-1 hover:bg-gray-200"><a href="https://lsp.stpbogor.ac.id/">LSP</a></li>
                    <li class="p-1 hover:bg-gray-200"><a href="https://lppm.stpbogor.ac.id/">LPPM</a></li>
                </ul>
            </div>
            <a href="{{ route('ideas') }}"
                class="p-2 {{ request()->getPathInfo() == '/ideas' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                @lang('messages.ideas')
            </a>
            <a href="{{ route('contact') }}"
                class="p-2 {{ request()->getPathInfo() == '/contact' ? 'border-t-2' : '' }} border-[{{ $settings->primary_color }}] hover:bg-gray-200">
                @lang('messages.contact')
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
                <p class="text-gray-500 text-sm">{{ translate('Aliquam rhoncus ligula est, non pulvinar elit convallis nec. Donec
                    mattis odio at.', session('locale', 'en')) }}</p>
                <div class="flex items-center gap-2 mt-3">
                    @php
                        $social = \App\Models\SocialMedia::select(['name', 'url'])->get();
                    @endphp
                    @foreach ($social as $sc)
                        <a href="{{ $sc->url }}"
                            class="w-8 aspect-square bg-gray-700 hover:bg-[{{ $settings->primary_color }}] hover:shadow-md hover:shadow-[{{ $settings->primary_color }}] text-white flex items-center justify-center">
                            <i
                                class="fa-brands fa-{{ str_replace(' ', '-', strtolower($sc->name)) == 'x' ? 'twitter' : str_replace(' ', '-', strtolower($sc->name)) }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Top 4 Category -->
            <div class="space-y-3">
                <h4 class="text-white text-base font-semibold">@lang('messages.top_4_category')</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('ideas') }}" class="hover:text-white">@lang('messages.development')</a></li>
                    <li><a href="#" class="hover:text-white">@lang('messages.finance')</a></li>
                    <li><a href="#" class="hover:text-white">@lang('messages.design')</a></li>
                    <li><a href="#" class="hover:text-white">@lang('messages.business')</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="space-y-3">
                <h4 class="text-white text-base font-semibold">@lang('messages.quick_links')</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white">@lang('messages.about')</a></li>
                    <li><a href="#"
                            class="hover:text-white flex items-center justify-between">@lang('messages.instructor')</a>
                    </li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">@lang('messages.contact')</a></li>
                    <li><a href="#" class="hover:text-white">@lang('messages.career')</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="space-y-3">
                <h4 class="text-white text-base font-semibold">@lang('messages.support')</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('contact') }}" class="hover:text-white">@lang('messages.help_center')</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">@lang('messages.faq')</a></li>
                    <li><a href="#" class="hover:text-white">@lang('messages.terms')</a></li>
                    <li><a href="#" class="hover:text-white">@lang('messages.privacy')</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright dan Pilihan Bahasa -->
        <div class="border-t border-gray-700 mt-10 pt-5 text-center text-gray-500">
            <p class="text-xs">© 2025 - Bogor Heritage Foundation. All rights reserved</p>
            <div class="mt-2">
                <form action="" method="GET" id="lang-form">
                    <select name="lang" onchange="changeLanguage(this)">
                        <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="id" {{ session('locale') == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    </select>
                </form>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript untuk Toggle Menu
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            // mobileMenu.classList.toggle('hidden');
            mobileMenu.style.display = mobileMenu.style.display == 'none' ? 'flex' : 'none'
        });

        const hideError = (id) => {
            const alert = document.getElementById(`error-${id}`)
            alert.style.display = 'none'
        }
        const hideSuccess = () => {
            const alert = document.getElementById('success')
            alert.style.display = 'none'
        }

        const ToggleMobileOw = (e) => {
            const menu = document.getElementById('mobile-ow')
            menu.style.display = menu.style.display == 'none' ? 'block' : 'none'
            e.innerHTML = e.innerHTML == 'Our Works <i class="fa-solid fa-caret-right"></i>' ? 'Our Works <i class="fa-solid fa-caret-down"></i>' : 'Our Works <i class="fa-solid fa-caret-right"></i>'
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

    <script>
        function changeLanguage(select) {
            let lang = select.value;
            window.location.href = "{{ url('locale') }}/" + lang;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentPath = window.location.pathname;
            const typeInput = document.getElementById('searchType');
            const searchInput = document.getElementById('search');
            const params = new URLSearchParams(window.location.search);
            const queryType = params.get('type'); // Ambil query string `type`

            if (typeInput) {
                if (queryType) {
                    typeInput.value = queryType;
                } else if (currentPath.includes('/allnews')) {
                    typeInput.value = '{{ $type ?? 'all' }}';
                } else {
                    typeInput.value = 'all';
                }

                if (searchInput) {
                    searchInput.addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();

                            const keyword = searchInput.value.trim();
                            let type = typeInput.value; // Ambil nilai typeInput

                            if (!keyword) {
                                alert('Masukan kata kunci pencaharian.');
                                return;
                            }

                            // Mengirimkan beberapa tipe dalam query string (misalnya 'news,programs,scholarship')
                            fetch(`/search/check?search=${encodeURIComponent(keyword)}${type ? `&type=${type}` : ''}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.found) {
                                        searchInput.closest('form').submit();
                                    } else {
                                        alert('Pencarian anda tidak ditemukan.');
                                    }
                                })
                                .catch(() => {
                                    alert('Terjadi kesalahan saat pencarian.');
                                });
                        }
                    });
                }
            }
        });

    </script>

    <!-- Language -->
    <!-- Google Translate Widget -->
    <!-- <div id="google_translate_element" style="display: none;"></div>

<script>
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'id',
        includedLanguages: 'id,en',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
}


document.addEventListener("DOMContentLoaded", function() {
    var lang = localStorage.getItem('selectedLang') || 'id'; 
    document.getElementById("languageSwitcher").value = lang;
    setTimeout(() => changeLanguage(lang), 500); 

    document.getElementById("languageSwitcher").addEventListener("change", function() {
        var selectedLang = this.value;
        localStorage.setItem('selectedLang', selectedLang);
        changeLanguage(selectedLang);
    });
});

function changeLanguage(lang) {
    var select = document.querySelector('.goog-te-combo');
    if (select) {
        select.value = lang;
        select.dispatchEvent(new Event('change'));
    }
}
</script>

<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->
</body>

</html>