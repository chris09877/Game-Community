@extends('layouts.layout')

@section('content')
<H1>Update your information</H1>


<button id="postButton">Update information</button>


<div id="update-user" title="update-user">

    <form action="{{ route('submitUser') }}" method="POST" enctype="multipart/form-data" id="post-form"
        data-route="{{ route('submitUser') }}">
        @csrf
        <label for="Name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{$user->name}}"><br><br>

        <label for="email">E-mail:</label><br>
        <input type="text" id="email" name="email" value="{{$user->email}}"><br><br>

        <label for="Bio">Bio:</label><br>
        <textarea id="Bio" name="Bio" rows="4" cols="50" value="{{$user->Bio}}"></textarea><br><br>

        <label for="Avatar">Upload Image/Video:</label><br>
        <input type="file" id="Avatar" name="Avatar"><br><br>
        <input type="number" name="user" id="user_id" style="display: none;" value="{{Auth::id()}}">

        <input type="submit" value="Update">
    </form>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{mix('/js/popupUser.js')}}"></script> --}}
@endsection

@php

@endphp