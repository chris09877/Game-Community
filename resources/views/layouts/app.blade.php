<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') -{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        
        li {
  list-style-type: none;
}

    </style>
    
</head>

<body>
    <div id="app">
        <nav class="bg-white shadow-md">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-3">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-600">{{ config('app.name', 'Laravel') }}</a>
                    <button class="block lg:hidden focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                    <div class="hidden lg:flex lg:items-center lg:w-auto lg:space-x-4">
                        @auth
                            <a href="{{ route('home') }}" class="nav-link">Dashboard</a>
                            <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                            <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                            @if(auth()->user()->admin)
                                <a href="{{ route('settings') }}" class="nav-link">Settings</a>
                                <a href="{{ route('category') }}" class="nav-link">Categories</a>
                            @endif
                        @endauth
                        @guest
                            @if(Route::currentRouteName() == 'login')
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                                <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                                <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                            @elseif(Route::currentRouteName() == 'register')
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                                <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                                <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                            @elseif(Route::currentRouteName() == 'faq' || Route::currentRouteName() == 'contact' || Route::currentRouteName() == 'about' || Route::currentRouteName() == 'latestPosts')
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                                <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                                <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                                <a href="{{ route('latestPosts') }}" class="nav-link">Latest Posts</a>
                                <a href="{{ route('about') }}" class="nav-link">About</a>
                            @endif
                           
                        @endguest
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="hidden lg:flex lg:items-center lg:w-auto lg:space-x-4">
                                    
                                        <!-- ... -->
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a href="{{ route('profile') }}" class="dropdown-item">
                                                <span class="list-none">Profile</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <span class="list-none">{{ __('Logout') }}</span>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    
                                </div>
                                
                                
                            </li>
                        @endauth
                    </div>
                    
                </div>
            </div>
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>