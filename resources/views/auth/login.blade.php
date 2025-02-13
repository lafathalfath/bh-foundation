@php
    // $settings = \App\Model\AppSettings::first();
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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black">
    @if ($errors->any())
        <div class="fixed w-full p-3">
            @foreach ($errors->all() as $key=>$err)
                <div class="bg-error p-3 rounded-xl" id="error-{{ $key }}" onclick="hideError({{ $key }})">{{ $err }}</div>
            @endforeach
        </div>
    @endif
    
    <div class="h-[100vh]">
        <div class="flex items-center gap-3 py-3 px-[20%] border border-b-1 border-gray-200">
            <div class="w-10">
                <img src="{{ $settings->logo_url }}" alt="">
            </div>
            <div class="text-2xl pb-2 font-semibold">{{ $settings->app_name }}</div>
        </div>
        <div class="flex w-full h-[90.5%]">
            <div class="w-2/5 bg-[{{ $settings->secondary_color }}] flex items-center justify-center">
                <div class="w-3/5">
                    <img src="{{ $settings->logo_banner_url }}" alt="">
                </div>
            </div>
            <div class="w-3/5 flex items-center justify-center">
                <form action="{{ route('auth.login') }}" method="POST" class="w-3/5 flex flex-col items-center justify-center gap-5">
                    @csrf
                    <div class="w-full text-3xl font-semibold text-center">Sign In</div>
                    <div class="w-full">
                        <label for="username">Username or Email</label><br>
                        <input type="text" name="username_or_email" id="username" placeholder="Username or Email Address" class="w-full px-5 py-2 bg-white outline outline-1 outline-gray-200" required>
                    </div>
                    <div class="w-full">
                        <label for="password">Password</label><br>
                        <div class="flex items-center bg-white outline outline-1 outline-gray-200">
                            <input type="password" name="password" id="password" placeholder="Password" class="w-full px-5 py-2 bg-white outline-0" required>
                            <button type="button" class="h-full p-2" onclick="togglePassword(this)">show</button>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div>
                            <input type="checkbox" name="remember_me" id="remember_me" class="text-white">
                            <label for="remember_me">Remember Me</label>
                        </div>
                        <button type="submit" class="px-5 py-2 bg-[#F8C42E] text-white">Sign In &#10140;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = (e) => {
            const input = document.getElementById('password')
            input.type = input.type == 'password' ? 'text' : 'password'
            e.innerHTML = e.innerHTML == 'show' ? 'hide' : 'show'
        }
        const hideError = (id) => {
            const alert = document.getElementById(`error-${id}`)
            alert.style.display = 'none'
        }
    </script>
</body>
</html>