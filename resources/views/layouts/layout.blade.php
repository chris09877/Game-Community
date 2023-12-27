<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Community Game</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>

<body class="bg-slate-500">
    <div class="container mx-auto px-4">
        <nav class="py-4">
            <div class="flex items-center justify-between">
                <div class="sm:hidden">
                    <button class="text-white hover:text-gray-300 focus:outline-none">
                        <!-- Your responsive menu icon here -->
                    </button>
                </div>

                <div class="hidden sm:flex space-x-4 text-white">
                    <a href="{{ route('faq') }}" class="text-lg hover:text-gray-300">FAQ</a>
                    <a href="{{ route('contact') }}" class="text-lg hover:text-gray-300">Contact Us</a>
                    <a href="{{ route('login') }}" class="text-lg hover:text-gray-300">Login</a>
                    <a href="{{ route('register') }}" class="text-lg hover:text-gray-300">Register</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container mx-auto px-4">
        <div class="relative flex items-top justify-center min-h-screen dark:bg-gray-900 sm:items-center sm:pt-0">
            @yield('content')
        </div>
    </div>
</body>

</html>