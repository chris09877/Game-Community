@extends('layouts.layout')
@section('content')

<h1>FAQ</h1>
<button onclick="window.location = '{{route('faq.create')}}'"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Create Question
</button>
@if($user->admin)
<button onclick="window.location = '{{route('category')}}'"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Categories
</button>
@endif
<h2>Themes</h2>
@foreach($categories as $category)
<h3>{{$category->name}}</h3>
@foreach($allFaqs as $faq)
@if($faq->category_id === $category->id)
@if($user->admin)
{{-- meetre href to page where u can update the faq --}}
<div>
    <a href="{{ route('faq.show', ['id' => $faq->id]) }}">
        <div>
            <form action="{{ route('faq.destroy', ['id' => $faq->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete FAQ</button>
            </form>
            <p>{{$faq->title}}</p>
            <p>{{$faq->text}}</p>

        </div>
    </a>
    @auth
    <button onclick="toggleReplyInput(this)">Reply</button>
    <div id="replyInput" style="display: none;">
        <input type="text" id="replyText">
        <button id="{{$faq->id}}" onclick="sendReply(this)">Send</button>
    </div>
    @endauth
</div>
<div>
    <h2>Answers</h2>
    @if($comments->where('faq_id', $faq->id)->isEmpty())
    <p>There are no answers yet to this question.</p>
    @else
    @foreach($comments as $comment)
    <div>
        <p>{{$comment->user_id}}</p>
        <p>{{$comment->text}}</p>
        <p>{{$comment->created_at}}</p>

    </div>
    @endforeach
    @endif
</div>
@else
<div>
    <a href="{{ route('faq.show', ['id' => $faq->id]) }}">
        <div>
            <p>{{$faq->title}}</p>
            <p>{{$faq->text}}</p>

        </div>

    </a>
    @auth
    <button onclick="toggleReplyInput(this)">Reply</button>
    <div id="replyInput" style="display: none;">
        <input type="text" id="replyText">
        <button id="{{$faq->id}}" onclick="sendReply(this)">Send</button>
    </div>
    @endauth
</div>
<div>
    <h2>Answers</h2>
    @if($comments->where('faq_id', $faq->id)->isEmpty())
    <p>There are no answers yet to this question.</p>
    @else
    @foreach($comments as $comment)
    <div>
        <p>{{$comment->user_id}}</p>
        <p>{{$comment->text}}</p>
        <p>{{$comment->created_at}}</p>

    </div>
    @endforeach
    @endif
</div>
@endif
@else
<p>There are no questions related to the theme {{$category->name}}.</p>
@endif
@endforeach
@endforeach
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    function toggleReplyInput(button) {
        let replyInput = document.getElementById("replyInput");
        replyInput.style.display = replyInput.style.display === "none" ? "block" : "none";
    }

    function sendReply(button) {
        let replyText = document.getElementById("replyText").value;
        if (replyText.trim() !== "") {
            // Send the reply to the database
            // You can use AJAX or submit the form to a backend endpoint
            // Example using AJAX:
            let id = button.id;
            console.log(`${id}`);
            $.ajax({

                url: "{{ route('comment.store') }}",
                method: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { reply: replyText,
                        post_id: null,
                        faq_id: id,
                        parent_id:null,
                        
                
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
            console.log("awa faut bosser");

        }
        toggleReplyInput();
    }
</script>