
@extends('layouts.app')
@section('title', 'Latest Posts')
@section('content')
<div class="w-3/4 mx-auto">
    
    
    <h1 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">Top Posts Of The Mounth</h1>

    <div class="w-3/4">

        @if ($allPosts->isEmpty())
        <h1 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">No Posts Available</h1>
        @else
        <h1 class="text-2xl font-bold mb-4">Latest Posts</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            @foreach($allPosts as $post)
                <div class="rounded-xl overflow-hidden hover:cursor-pointer px-2 py-1 flex flex-col gap-2">
                    <div class="rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                        <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                        <div>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                    </div>
                        <p>{{ $post->content }}</p>
                        <p>{{ $post->created_at }}</p>
                    </div>
                </div>
            <br>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
