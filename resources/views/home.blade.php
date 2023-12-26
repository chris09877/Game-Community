{{-- @extends('layouts.app')

@section('content')
<div class="w-3/4">
    <div class="flex gap-8">
        <div class="col-md-8">
            <div class="w-3/4">
                <button onclick="window.location='{{route('post.create')}}'" style="float: right;"  class=" bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border mr-4">CREATE POST</button>
                <div class="w-3/4">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if($allPosts->isEmpty() )
                    <h1 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">y a R</h1>

                    @else
                    <h1 >Latest Posts</h1>
                    <div class=" grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        @foreach($allPosts as $post)
                        <a href="{{route('post.show',$post->id)}}">
                            <div class=" rounded-xl overflow-hidden hover:cursor-pointer ">
                                <div>
                                    code pour img:                                 <div class="project-card__image bg-cover bg-center w-full h-[200px] bg-amber-500" style="background-image: url( {{ Storage::url($project->file_path) }} )"></div>

                                    <img src="{{ $post->{'images/videos'} }}" alt="Post Image">
                                </div>

                                <div class="rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                                    <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                                    <p>{{ $post->content }}</p>
                                    <p>{{ $post->created_at }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="w-3/4 mx-auto">
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
        <h1 class="subtitle mb-4 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">No Posts Available</h1>
        @else
        <h1 class="text-2xl font-bold mb-4">Latest Posts</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            @foreach($allPosts as $post)
            <a href="{{ route('post.show', $post->id) }}" class="hover:no-underline">
                <div class="rounded-xl overflow-hidden hover:cursor-pointer px-2 py-1 flex flex-col gap-2">
                    <div>
                        {{-- Code for image --}}
                        <img src="{{ $post->{'images/videos'} }}" alt="Post Image" class="w-full h-60 object-cover">
                    </div>
                    <div class="rounded-b-xl border-2 border-t-0 p-4 flex flex-col gap-2">
                        <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                        <p>{{ $post->content }}</p>
                        <p>{{ $post->created_at }}</p>
                    </div>
                </div>
            </a>
            <br>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
