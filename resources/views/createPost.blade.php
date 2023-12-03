@extends('layouts.layout')

@section('content')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{mix('/js/popup.js')}}"></script> --}}
<H1>Create POST</H1>


<button id="postButton">Create Post</button>


<div id="postModal" title="Create Post">

    <form action="{{ route('submitPost') }}" method="POST" enctype="multipart/form-data" id="post-form"
        data-route="{{ route('submitPost') }}">
        @csrf
        <label for="Title">Title:</label><br>
        <input type="text" id="Title" name="Title"><br><br>

        <label for="Content">Content:</label><br>
        <textarea id="Content" name="Content" rows="4" cols="50"></textarea><br><br>

        <label for="images/videos">Upload Image/Video:</label><br>
        <input type="file" id="media" name="media"><br><br>
        <input type="number" name="user" id="user_id" style="display: none;" value="{{Auth::id()}}">
        <input type="number" name="user2" id="user_id2" style="display: none;" value="{{Auth::id()}}">

        <input type="submit" value="Submit">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{mix('/js/popup.js')}}"></script>
@endsection

@php

@endphp