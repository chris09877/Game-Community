@extends('layouts.app')

@section('content')
<button id="updateButton">Update</button>

<div>
    <h1>{{ $post->title }}</h1>

    <input type="text" id="title" style="display:none;" placeholder=" {{$post->title}}">
    <img src="{{ $post->image }}" alt="Post media" id="media">
    <input type="file" id="media" style="display:none;">
    <p id="old-content">Content: {{ $post->content }}</p>
    <input type="text" id="new-content" style="display:none;" placeholder=" {{$post->content}}">
    <p>Creation Date: {{ $post->created_at }}</p>
    <button id="saveButton">Save</button>
    <button onclick="window.location='{{route('home')}}'">Cancel</button>

</div>

<div>
    <h2>Comments of {{ $post->Title }} </h2>
    @foreach ($comments as $comment)
    <div id="comment_{{$comment->id}}">
        <p>User: {{ $comment->user_id }}</p>
        <p>Text: {{ $comment->text }}</p>
        <p>Posted At: {{ $comment->created_at }}</p>
        <button id="deleteButton" data-id="{{ $comment->id }}">Delete</button>
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
            $('#title').show().focus();
            $('#new-content').show().focus();
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
            $.ajax({
                url:"{{ route('post.update', ['id' => $post->id]) }}",
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                data: {
                    media: media || null,
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
    });
</script>