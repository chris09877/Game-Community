@extends('layouts.app')
@section('title', $post->title)
@section('content')
@if($user->id == $post->user_id || $user->admin)
<button id="updateButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
    Update
</button>
@endif

<div class="max-w-3xl mx-auto mt-8 px-4">
    <h1 class="text-3xl font-bold">{{ $post->title }}</h1>

    <input type="text" id="title" class="border rounded-md py-2 px-3 mt-4 hidden" placeholder="{{$post->title}}">
    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mt-4" id="old-media">

    <input type="file" id="media" class="mt-4 hidden">
    <p id="old-content" class="mt-4">Content: {{ $post->content }}</p>
    <input type="text" id="new-content" class="border rounded-md py-2 px-3 mt-4 hidden"
        placeholder="{{$post->content}}">
    <p class="mt-4">Creation Date: {{ $post->created_at }}</p>
    @if($user->id == $post->user_id || $user->admin)
    <button id="saveButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 hidden">
        Save
    </button>
    <button onclick="window.location='{{route('home')}}'"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mt-4 hidden" id="cancelBtn">
        Cancel
    </button>
    <button id="deleteButton2" data-id="{{ $post->id }}"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 hidden">
        Delete
    </button>
    @endif
    <button id="like-btn-{{ $post->id }}"
        class="like-btn bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center {{ $user->likedPosts->contains($post->id) ? 'bg-red-500 text-white' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            class="w-4 h-4 mr-2 {{ $user->likedPosts->contains($post->id) ? 'text-white' : 'text-gray-500' }}"
            viewBox="0 0 24 24">
            <path
                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
        <span>Like</span>
    </button>
</div>

<div class="max-w-3xl mx-auto mt-8 px-4">
    <h2 class="text-xl font-bold">Comments of {{ $post->Title }}</h2>
    @foreach ($comments as $comment)
    <div id="comment_{{$comment->id}}" class="mt-4 border-b pb-4">
        <p class="font-bold">User: {{ $comment->user_id }}</p>
        <p class="mt-2">Text: {{ $comment->text }}</p>
        <p class="text-sm text-gray-500 mt-2">Posted At: {{ $comment->created_at }}</p>
        <button id="deleteButton" data-id="{{ $comment->id }}"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">
            Delete
        </button>
    </div>
    @endforeach
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        console.log("wassup1");

        // Update button click event
        $('#updateButton').click(function() {
            // Make the media, title, and creation date fields editable
            $('img#media').attr('contenteditable', 'true');
            $('h1').hide();
            $('p#old-content').hide();
            $('img#old-media').hide();
            $('#title').show().focus();
            $('#new-content').show().focus();
            $('#media').show().focus();
            $('#saveButton').show().focus();
            $('#cancelBtn').show().focus();
            $('#deleteButton2').show().focus();
        });

        // Save button click event
        $('#saveButton').click(function() {
            console.log("inside save btn");
            let media = $('p#media').text();
            let title = $('#title').val();
            let content = $('#new-content').val();
            let date = new Date();
            let id = {{$post->id}} ; 
            console.log(`id:${id}`);
            console.log(`${date}    ${content}     ${media}`);
            // Send the updated data to the server using AJAX
            $.post({
                url:"{{ route('post.update', ['id' => $post->id]) }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                data: {
                    media: media,// || null,
                    title: title || $('h1').text(),
                    content: content || $('p#old-content').text(),
                    updated_at: formatDate(date)
                },
                success: function(response) {
                    console.log("inside save btn succes");

                    $('#title').show().hide();
                    $('#new-content').hide();
                    $('h1').text(title).show();
                    $('p#old-content').text(content).show();
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const seconds = String(date.getSeconds()).padStart(2, '0');

                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            }
        });

        // Delete button click event
        $('#deleteButton').click(function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('comment.destroy',['id' => " + id + "]) }}",
                type: 'DELETE',
                data: {
                    commentId: id
                },
                success: function(response) {
                    $('#comment_' + id).remove();
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#deleteButton2').click(function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('post.destroy',['id' => " + id + "]) }}",
                type: 'DELETE',
                data: {
                    postId: id
                },
                success: function(response) {
                    $('#post_' + id).remove();
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Toggle like button click event
    $('.like-btn').click(function() {
        let button = $(this);
        let postId = button.attr('id').split('-')[2]; // Assuming the button id is like-btn-postId
        let isLiked = button.hasClass('bg-red-500');

        // Toggle like status visually
        button.toggleClass('bg-red-500 text-white bg-gray-200');
        button.find('span').text(isLiked ? 'Like' : 'Liked');

        // Send the toggle request to the server
        $.ajax({
            url: `/like/${postId}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                userId: "{{ auth()->user()->id }}",
                postId: postId,
                like: !isLiked
            },
            success: function(response) {
                console.log(response.message); // Response handling
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                button.toggleClass('bg-red-500 text-white bg-gray-200'); // Revert changes on error
                button.find('span').text(isLiked ? 'Liked' : 'Like');
            }
        });
    });
    });
</script>