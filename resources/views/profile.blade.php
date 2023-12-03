@extends('layouts.layout')

@section('content')

<div class="profile">
    <div class="profile-photo">
        <!-- Profile photo here -->
        <img src="" alt="Profile Photo">
    </div>
    <div class="profile-info">
        <!-- User name -->
        <h2>{{$user->Name}}</h2>
        <!-- Bio -->
        <p>User Bio Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
</div>

<div class="statistics">
    <div class="statistics-title">Statistics</div>
    <div class="statistics-item">
        <img src="likes_icon.png" alt="Likes Icon">
        <div>Likes: <span>100</span></div>
    </div>
    <div class="statistics-item">
        <img src="comments_icon.png" alt="Comments Icon">
        <div>Comments: <span>50</span></div>
    </div>
    <div class="statistics-item">
        <img src="achievements_icon.png" alt="Achievements Icon">
        <div>Achievements: <span>5</span></div>
    </div>
</div>

<div class="user-posts">
    @if($userPosts->count() > 0)
    <h2>Overview of User Posts</h2>
    <!-- Display user posts here -->
    @foreach($userPosts as $post)
    <div class="post">
        <h3>{{$post->Title}}</h3>
        @if($post->{'images/videos'} != null)
        <div class="media-post">
            <h1>ici il y aura image</h1>
        </div>
        <p>{{$post->Content}}</p>
        <span>
            <p>{{$post->Creation}}</p>
        </span>
        @else
        <p>{{$post->Content}}</p>
        <span>
            <p>{{$post->Creation}}</p>
        </span>
        @endif
    </div>
    @endforeach
    @else
    <h3>Nothing posted yet</h3>

    @endif

    <!-- Add more posts as needed -->
</div>

@endsection('content')