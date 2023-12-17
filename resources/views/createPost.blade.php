@extends('layouts.layout')

@section('content')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{mix('/js/popup.js')}}"></script> --}}
<!-- You can link Tailwind CSS in your HTML or use it via classes in Vue.js -->
<!-- For example, in Laravel, you can link the compiled CSS file in your layout file -->
<!-- Add this line in the <head> section of your HTML layout file -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <H1 class="text-4xl mb-4">Create POST</H1>
    
    <button id="postButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create Post
    </button>
    
    <div id="postModal" title="Create Post" class="mt-6">
        <form action="{{ route('submitPost') }}" method="POST" enctype="multipart/form-data" id="post-form"
            data-route="{{ route('submitPost') }}">
            @csrf
            <div class="mb-4">
                <label for="Title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="Title" name="Title" class="border rounded-md py-2 px-3 w-full">
            </div>
    
            <div class="mb-4">
                <label for="Content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea id="Content" name="Content" rows="4" cols="50" class="border rounded-md py-2 px-3 w-full"></textarea>
            </div>
    
            <div class="mb-4">
                <label for="media" class="block text-gray-700 text-sm font-bold mb-2">Upload Image/Video:</label>
                <input type="file" id="media" name="media" class="border rounded-md py-2 px-3">
            </div>
    
            <!-- You might not need these hidden inputs if you pass Auth::id() in the backend -->
            <input type="hidden" name="user" id="user_id" value="{{Auth::id()}}">
            <input type="hidden" name="user2" id="user_id2" value="{{Auth::id()}}">
    
            <input type="submit" value="Submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{mix('/js/popup.js')}}"></script>
@endsection

@php

@endphp