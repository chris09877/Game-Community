
@extends('layouts.app')
@section('title', 'Latest Posts')
@section('content')
<div class="w-3/4 mx-auto">
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
                <a href="{{ route('latestPosts') }}" class="text-lg hover:text-gray-300">Latest Posts</a>
                <a href="{{ route('about') }}" class="text-lg hover:text-gray-300">About</a>
                <a href="{{ route('login') }}" class="text-lg hover:text-gray-300">Login</a>
                <a href="{{ route('register') }}" class="text-lg hover:text-gray-300">Register</a>
            </div>
        </div>
    </nav>
    
    <h1 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Top Posts Of The Mounth</h1>

    <div class="w-3/4">

        @if ($allPosts->isEmpty())
        <h1 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">No Posts Available</h1>
        @else
        <h1 class="text-2xl font-bold mb-4">Latest Posts</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            @foreach($allPosts as $post)
                <div class="rounded-xl overflow-hidden hover:cursor-pointer px-2 py-1 flex flex-col gap-2">
                    <div>
                        {{-- Code for image --}}
                        <img src="{{ $post->{'images/videos'} }}" alt="Post Image" class="w-full h-60 object-cover">
                    </div>
                    <div class="rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                        <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                        <p>{{ $post->content }}</p>
                        <p>{{ $post->created_at }}</p>
                    </div>
                </div>
            <br>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
