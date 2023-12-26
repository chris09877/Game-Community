@extends('layouts.app')
@section('content')


<h1 class="text-3xl font-bold mb-6 text-center">Themes</h1>

<button onclick="window.location = '{{route('faq.create')}}'"
style="float: right;"  class=" bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border mr-4" >Create Question</button>
@if($user->admin)
<button onclick="window.location = '{{route('category')}}'"
    class="float-left bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">Categories</button>
@endif

@foreach($categories as $category)
    <h3 class="text-black font-bold py-2 px-4 mr-4">{{$category->name}}</h3>

    @foreach($allFaqs as $faq)
        @if($faq->category_id === $category->id)
            <div class="border p-4 mb-4">
                @if($user->admin)
                        <div class="flex items-center">
                            <div>
                                <form action="{{ route('faq.destroy', ['id' => $faq->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button style="float: right;" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border" type="submit">Delete FAQ</button>
                                </form>
                            </div>
                @endif
                <a href="{{ route('faq.show', ['id' => $faq->id]) }}">
                    <p class="font-bold">{{$faq->title}}</p>
                    <p>{{$faq->text}}</p>
                </a>

                @auth
                    
                    <div class="flex items-center">
                        <button onclick="toggleReplyInput(this)"
                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">Reply
                        </button>
                       
                        <div id="replyInput" class="hidden ml-4" style="display: none;">
                            <input type="text" id="replyText" class="border rounded px-2 py-1">
                            <button onclick="sendReply(this)"
                                    id="{{$faq->id}}"
                                    class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">Send
                            </button>
                        </div>
                    </div>
                    
                @endauth

                <div class="border-t mt-4 pt-4">
                    <h2 class="text-black font-bold py-2 px-4">Answers</h2>
                    @if($comments->where('faq_id', $faq->id)->isEmpty())
                        <p>There are no answers yet to this question.</p>
                    @else
                        @foreach($comments as $comment)
                            @if($comment->faq_id === $faq->id)
                                <div class="border rounded p-2 mb-2">
                                    <p>{{$comment->user->name}}</p>
                                    <p>{{$comment->text}}</p>
                                    <p>{{$comment->created_at}}</p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
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