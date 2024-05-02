@extends('layouts.app')
@section('title', '{{ $post->Title }}')
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
    <button id="like-btn-{{ $post->id }}" class="like-btn bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center {{ $user->likedPosts->contains($post->id) ? 'bg-red-500 text-white' : '' }}">
        <img src="/path/to/heart.gif" alt="Like" class="fill-current w-4 h-4 mr-2">
        <span>Like</span>
    </button>
    @endif
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

            // $('#title').show().focus()

            console.log("wassup");
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
                //method: 'POST',
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
                    // $('#title').hide()
                    // $('img#media').attr('contenteditable', 'true');
                    $('h1').text(title).show();
                    $('p#old-content').text(content).show();
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle the error response
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
                    // Handle the error response
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
                    // Handle the error response
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