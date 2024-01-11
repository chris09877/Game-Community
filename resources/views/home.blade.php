@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="w-3/4 mx-auto">
    @if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="flex items-center justify-between mb-4">
        <button onclick="window.location='{{ route('post.create') }}'" style="float: right;"
            class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">CREATE POST</button>
        {{-- Uncommented card-header div --}}
        {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
    </div>

    <div class="w-3/4">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        @if ($allPosts->isEmpty())
        <h1 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">No
            Posts Available</h1>
        @else
        <h1 class="text-2xl font-bold mb-4">Latest Posts</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($allPosts as $post)
            <div class="mb-8">
                <a href="{{ route('post.show', $post->id) }}" class="hover:no-underline">
                    <div class="rounded-xl overflow-hidden hover:cursor-pointer px-2 py-1 flex flex-col gap-2">
                        <div>
                            {{-- Code for image --}}
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                        </div>
                        <div class="rounded-b-xl border-2 border-t-0 p-4">
                            <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                            <p>{{ $post->content }}</p>
                            <p>{{ $post->created_at }}</p>
                        </div>
                    </div>
                </a>
                <div class="flex items-center mt-4">
                    <button onclick="toggleReplyInput(this)"
                        class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">Reply
                    </button>
                    <div id="replyInput" class=" ml-4" style="display: none;">

                        <input type="text" id="replyText" class="border rounded px-2 py-1">
                        <button onclick="sendReply(this)" id="{{$post->id}}"
                            class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">Send
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    @endsection
    <script>
        // window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
        
        function toggleReplyInput(button) {
        let replyInput = document.getElementById("replyInput");
        replyInput.style.display = replyInput.style.display === "none" ? "block" : "none";
        button.innerText = button.innerText === "Reply" ? "Cancel" : "Reply";
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
    
    
    // });
    </script>