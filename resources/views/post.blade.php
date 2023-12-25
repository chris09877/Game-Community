@extends('layouts.app')

@section('content')
<button id="updateButton">Update</button>

    <div>
        <h1>{{ $post->title }}</h1>
        <img src="{{ $post->{'images/videos'} }}" alt="Post media" id="media">
        <p id="content">Content: {{ $post->content }}</p>
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
        // Update button click event
        $('#updateButton').click(function() {
            // Make the media, title, and creation date fields editable
            $('img#media').attr('contenteditable', 'true');
            $('h1').attr('contenteditable', 'true');
            $('p#content').attr('contenteditable', 'true');
        });

        // Save button click event
        $('#saveButton').click(function() {
            // Get the updated data
            let media = $('p#media').text();
            let title = $('h1').text();
            let content = $('p#creationDate').text();
            let date = new Date();

            // Send the updated data to the server using AJAX
            $.ajax({
                let id = {{$post->id}} ; 
                url:" {{route('post.update',['id' => " + id + "]) }}",
                method: 'POST',
                data: {
                    media: media,
                    title: title,
                    content: content,
                    updated_at: date
                },
                success: function(response) {
                    // Handle the success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
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