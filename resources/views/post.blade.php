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
    
    <p id="old-content" class="mt-4"> {{ $post->content }}</p>
    <input type="text" id="new-content" class="border rounded-md py-2 px-3 mt-4 hidden" placeholder="{{$post->content}}">
    <p class="mt-4">Creation Date: {{ $post->created_at }}</p>
    @if($user->id == $post->user_id || $user->admin)
    <button id="saveButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 hidden">
        Save
    </button>
    <button onclick="window.location='{{route('home')}}'" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mt-4 hidden" id="cancelBtn">
        Cancel
    </button>
    <button id="deleteButton2" data-id="{{ $post->id }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 hidden">
        Delete
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
        <button id="deleteButton" data-id="{{ $comment->id }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">
            Delete
        </button>
    </div>
    @endforeach
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        console.log("Document ready");

        $('#updateButton').click(function() {
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


        $('#saveButton').click(function() {
    console.log("inside save btn");
    let media = $('#media')[0].files[0];
    let title = $('#title').val();
    let content = $('#new-content').val();
    let date = new Date();
    let id = {{ $post->id }};
    console.log(`id:${id}`);
    console.log(`${date}    ${content}     ${media}`);

    let formData = new FormData();

    if (media) {
        formData.append('media', media);
    }
    formData.append('title', title || $('h1').text());
    formData.append('content', content || $('p#old-content').text());
    formData.append('updated_at', formatDate(date));

    // Send the data using AJAX
    $.ajax({
        url: "{{ route('post.update', ['id' => $post->id]) }}",
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log("inside save btn success");
            $('#title').show().hide();
            $('#new-content').hide();
            $('h1').text(title).show();
            $('p#old-content').text(content).show();
            console.log(response);
            window.location.href = "/dashboard";
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



        $('#deleteButton').click(function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('comment.destroy', ['id' => " + id + "]) }}",
                type: 'DELETE',
                data: { commentId: id },
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
                url: "{{ route('post.destroy', ['id' => " + id + "]) }}",
                type: 'DELETE',
                data: { postId: id },
                success: function(response) {
                    location.href = "{{ route('home') }}";
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('.like-btn').click(function() {
            let button = $(this);
            let postId = button.attr('id').split('-')[2];
            let isLiked = button.hasClass('bg-red-500');

            button.toggleClass('bg-red-500 text-white bg-gray-200');
            button.find('span').text(isLiked ? 'Like' : 'Liked');

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
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    button.toggleClass('bg-red-500 text-white bg-gray-200');
                    button.find('span').text(isLiked ? 'Liked' : 'Like');
                }
            });
        });
    });
</script>
