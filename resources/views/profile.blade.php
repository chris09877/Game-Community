@extends('layouts.layout')

     @section('content')

     <div class="profile">
        <div class="profile-photo">
            <!-- Profile photo here -->
            <img src="" alt="Profile Photo">
        </div>
        <div class="profile-info">
            <!-- User name -->
            <h2>User Name</h2>
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
        <h2>Overview of User Posts</h2>
        <!-- Display user posts here -->
        <div class="post">
            <h3>Post Title 1</h3>
            <p>Post content lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="post">
            <h3>Post Title 2</h3>
            <p>Post content lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <!-- Add more posts as needed -->
    </div>
    
    @endsection('content')