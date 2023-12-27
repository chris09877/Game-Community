{{-- @extends('layouts.app')

@section('content')
    <h1 class="text-4xl mb-4">Create POST</h1>
    
    
    
    <div id="postModal" title="Create Post" class="mt-6">
        <form action="{{ route('submitPost') }}" method="POST" enctype="multipart/form-data" id="post-form"
            data-route="{{ route('submitPost') }}">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" class="border rounded-md py-2 px-3 w-full">
            </div>
    
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea id="content" name="content" rows="4" cols="50" class="border rounded-md py-2 px-3 w-full"></textarea>
            </div>
    
            <div class="mb-4">
                <label for="media" class="block text-gray-700 text-sm font-bold mb-2">Upload Image/Video:</label>
                <input type="file" id="media" name="media" class="border rounded-md py-2 px-3">
            </div>
    
            <!-- You might not need these hidden inputs if you pass Auth::id() in the backend -->
            <input type="hidden" name="user" id="user_id" value="{{Auth::id()}}">
    
            <input type="submit" value="Submit" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">
        </form>
    </div>
    

@endsection --}}
{{-- @extends('layouts.app')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-lg p-6">
        <h1 class="text-4xl mb-4 text-center">Create POST</h1>

        <div id="postModal" title="Create Post" class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('submitPost') }}" method="POST" enctype="multipart/form-data" id="post-form"
                data-route="{{ route('submitPost') }}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="border rounded-md py-2 px-3 w-full">
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                    <textarea id="content" name="content" rows="4" cols="50"
                        class="border rounded-md py-2 px-3 w-full"></textarea>
                </div>

                <div class="mb-4">
                    <label for="media" class="block text-gray-700 text-sm font-bold mb-2">Upload Image/Video:</label>
                    <input type="file" id="media" name="media" class="border rounded-md py-2 px-3">
                </div>

                <!-- You might not need these hidden inputs if you pass Auth::id() in the backend -->
                <input type="hidden" name="user" id="user_id" value="{{Auth::id()}}">

                <input type="submit" value="Submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
            </form>
        </div>
    </div>
</div>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md p-6">
        <h1 class="text-4xl mb-4 text-center">Create POST</h1>

        <div id="postModal" title="Create Post" class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('submitPost') }}" method="POST" enctype="multipart/form-data" id="post-form"
                data-route="{{ route('submitPost') }}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="border rounded-md py-2 px-3 w-full">
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                    <textarea id="content" name="content" rows="4" cols="50"
                        class="border rounded-md py-2 px-3 w-full"></textarea>
                </div>

                <div class="mb-4">
                    <label for="media" class="block text-gray-700 text-sm font-bold mb-2">Upload Image/Video:</label>
                    <input type="file" id="media" name="media" class="border rounded-md py-2 px-3">
                </div>

                <!-- You might not need these hidden inputs if you pass Auth::id() in the backend -->
                <input type="hidden" name="user" id="user_id" value="{{Auth::id()}}">

                <input type="submit" value="Submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
            </form>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')
@section('title', 'Create Your Post')
@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="text-center">
        <h1 class="text-4xl mb-4 text-center">Create POST</h1>

        <div id="postModal" title="Create Post" class="rounded-lg shadow-md p-8 inline-block mt-8">
            <form action="{{ route('submitPost') }}" method="POST" enctype="multipart/form-data" id="post-form"
                data-route="{{ route('submitPost') }}" class="flex flex-col gap-6">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-bold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="border rounded-md py-2 px-3 w-full">
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-bold mb-2">Content:</label>
                    <textarea id="content" name="content" rows="4" cols="50"
                        class="border rounded-md py-2 px-3 w-full"></textarea>
                </div>

                <div class="mb-4">
                    <label for="media" class="block text-sm font-bold mb-2">Upload Image/Video:</label>
                    <input type="file" id="media" name="media" class="border rounded-md py-2 px-3">
                </div>

                <!-- You might not need these hidden inputs if you pass Auth::id() in the backend -->
                <input type="hidden" name="user" id="user_id" value="{{Auth::id()}}">

                <input type="submit" value="Submit"
                    class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded border w-full">
                    <button onclick="window.history.back()" id="editButton" class="bg-gray-500 hover:bg-gray-700  font-bold py-2 px-4 rounded border focus:outline-none focus:shadow-outline" style="margin-left:20%;">Cancel</button>
                </form>
        </div>
    </div>
</div>
@endsection
