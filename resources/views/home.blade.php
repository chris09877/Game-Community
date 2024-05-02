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
                </a>
                <div class="flex items-center mt-4">
                    <button onclick="toggleReplyInput(this)"
                        class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border"
                        id="toggleReplyInput_{{$post->id}}">Reply
                    </button>
                    <div id="replyInput_{{$post->id}}" class=" ml-4" style="display: none;">

                        <input type="text" id="replyText_{{$post->id}}" class="border rounded px-2 py-1">
                        <button onclick="sendReply(this)" id="{{$post->id}}"
                            class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border">Send
                        </button>
                    </div>
                </div>
                <div class="border-t mt-4 pt-4">
                    <h2 class="text-black font-bold py-2 px-4">Comments</h2>
                    @if($comments->where('post_id', $post->id)->isEmpty())
                    <p>There are no answers yet to this question.</p>
                    @else
                    @foreach($comments as $comment)
                    @if($comment->post_id === $post->id)
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
            @endforeach
        </div>
        @endif
    </div>

    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        // window.addEventListener('load', function() {
        $(document).ready(function() {
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
        
        function toggleReplyInput(button) {
        let id = button.id.split("_")[1];    
        let replyInput = document.getElementById("replyInput_"+id);
        replyInput.style.display = replyInput.style.display === "none" ? "block" : "none";
        button.innerText = button.innerText === "Reply" ? "Cancel" : "Reply";
        }

     function sendReply(button) {
        let id = button.id;    
        let replyText = document.getElementById("replyText_" + id).value;
        if (replyText.trim() !== "") {
            // Send the reply to the database
            // You can use AJAX or submit the form to a backend endpoint
            // Example using AJAX:
            // let id = button.id;
            console.log(`${id}`);
            $.ajax({

                url: "{{ route('comment.store') }}",
                method: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { reply: replyText,
                        post_id: id,
                        faq_id: null,
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
     };
    }); 
    </script>