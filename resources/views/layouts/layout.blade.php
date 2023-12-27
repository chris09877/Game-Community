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

<body class="flex items-center justify-center h-screen bg-slate-500">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ route('home') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            <a href="{{ route('profile') }}" class="text-sm text-gray-700 underline">Profile</a>
            <a href="{{ route('faq') }}" class="text-sm text-gray-700 underline">FAQ</a>
            <a href="{{ route('contact') }}" class="text-sm text-gray-700 underline">Contact Us</a>

            {{-- here i want the code for admins --}}
                @if(auth()->user()->admin)
                    <!-- Show settings and categories links for admin users -->
                    <a href="{{ route('settings') }}" class="text-sm text-gray-700 underline">Settings</a>
                    <a href="{{ route('category') }}" class="text-sm text-gray-700 underline">Categories</a>
                @endif
            
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
            <a href="{{ route('contact') }}" class="text-sm text-gray-700 underline">Contact Us</a>
            <a href="{{ route('faq') }}" class="text-sm text-gray-700 underline">FAQ</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            <a href="{{ route('contact') }}" class="text-sm text-gray-700 underline">Contact Us</a>
            <a href="{{ route('faq') }}" class="text-sm text-gray-700 underline">FAQ</a>

            @endif
            @endif
        </div>
       
        @endif
        @yield('content')

</body>

</html>