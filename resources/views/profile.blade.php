 @extends('layouts.app')
 @section('title', 'Profile')
@section('content')
<div class="container mx-auto flex justify-between items-start">
    <div class="button-profile ml-auto mb-8" style="float: right;">
        <button onclick="window.location='{{route('profile.update', $user->id)}}'"
                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">Update Info
        </button>
    </div>

    <div class="profile-info mt-20 flex flex-col items-start mr-auto">
        <!-- Profile photo here -->
       
        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Profile Picture">

        <div>
            <h2 class="text-3xl font-bold mb-2">{{$user->name}}</h2>
            <p class="text-gray-600">{{$user->Bio}}</p>
        </div>
    </div>

</div>

<h2 class="text-2xl mb-4">Statistics</h2>
<div class="container mx-auto flex flex-wrap gap-4">
    <div class="statistics-item flex items-center border rounded p-2">
        <img src="likes_icon.png" alt="Likes Icon" class="w-6 h-6 mr-2">
        <div>Likes: <span class="font-bold">100</span></div>
    </div>
    <div class="statistics-item flex items-center border rounded p-2">
        <img src="comments_icon.png" alt="Comments Icon" class="w-6 h-6 mr-2">
        <div>Comments: <span class="font-bold">50</span></div>
    </div>
    <div class="statistics-item flex items-center border rounded p-2">
        <img src="achievements_icon.png" alt="Achievements Icon" class="w-6 h-6 mr-2">
        <div>Achievements: <span class="font-bold">5</span></div>
    </div>
</div>

<h2 class="text-2xl mb-4 mt-8">Overview of {{$user->name}}'s Posts</h2>
<div class="container mx-auto flex flex-wrap gap-4">
    @if($userPosts->count() > 0)
    <!-- Display user posts here -->
    @foreach($userPosts as $post)
    <a href="{{ route('post.show', ['id' => $post->id]) }}">
    <div class="post border rounded p-4 mb-4">
        <h3 class="text-xl mb-2">{{$post->Title}}</h3>
        @if($post->image != null)
        <div class="media-post mb-2">
            <h1>ici il y aura image</h1>
        </div>
        <p class="text-gray-700 mb-2">{{$post->content}}</p>
        <span class="text-gray-500">
            <p>{{$post->created_at}}</p>
        </span>
        @else
        <p class="text-gray-700 mb-2">{{$post->content}}</p>
        <span class="text-gray-500">
            <p>{{$post->created_at}}</p>
        </span>
        @endif
    </div>
</a>
    @endforeach
    @else
    <h3 class="text-2xl">Nothing posted yet</h3>
    @endif
</div>


@endsection

