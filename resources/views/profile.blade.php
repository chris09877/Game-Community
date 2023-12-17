@extends('layouts.layout')

@section('content')

<div class="profile flex mb-8">
    <div class="profile-photo mr-4">
        <!-- Profile photo here -->
        <img src="" alt="Profile Photo" class="rounded-full w-24 h-24">
    </div>
    <div class="profile-info">
        <!-- User name -->
        <h2 class="text-3xl font-bold mb-2">{{$user->Name}}</h2>
        <!-- Bio -->
        <p class="text-gray-600">User Bio Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
</div>

<div class="statistics mb-8">
    <div class="statistics-title text-2xl mb-4">Statistics</div>
    <div class="statistics-item flex items-center mb-4">
        <img src="likes_icon.png" alt="Likes Icon" class="w-6 h-6 mr-2">
        <div>Likes: <span class="font-bold">100</span></div>
    </div>
    <div class="statistics-item flex items-center mb-4">
        <img src="comments_icon.png" alt="Comments Icon" class="w-6 h-6 mr-2">
        <div>Comments: <span class="font-bold">50</span></div>
    </div>
    <div class="statistics-item flex items-center mb-4">
        <img src="achievements_icon.png" alt="Achievements Icon" class="w-6 h-6 mr-2">
        <div>Achievements: <span class="font-bold">5</span></div>
    </div>
</div>

<div class="user-posts">
    @if($userPosts->count() > 0)
    <h2 class="text-2xl mb-4">Overview of User Posts</h2>
    <!-- Display user posts here -->
    @foreach($userPosts as $post)
    <div class="post border p-4 mb-4">
        <h3 class="text-xl mb-2">{{$post->Title}}</h3>
        @if($post->{'images/videos'} != null)
        <div class="media-post mb-2">
            <h1>ici il y aura image</h1>
        </div>
        <p class="text-gray-700 mb-2">{{$post->Content}}</p>
        <span class="text-gray-500">
            <p>{{$post->Creation}}</p>
        </span>
        @else
        <p class="text-gray-700 mb-2">{{$post->Content}}</p>
        <span class="text-gray-500">
            <p>{{$post->Creation}}</p>
        </span>
        @endif
    </div>
    @endforeach
    @else
    <h3 class="text-2xl">Nothing posted yet</h3>
    @endif

    <!-- Add more posts as needed -->
</div>

@endsection('content')
