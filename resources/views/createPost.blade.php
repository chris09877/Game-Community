@extends('layouts.layout')

    @section('content')
     <H1>Create POST</H1>
     
 
<button id="postButton">Create Post</button>

  
<div id="postModal" title="Create Post">
   
    <form action="{{ route('submitPost') }}" method="POST" enctype="multipart/form-data" id="post-form">
        @csrf 
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br><br>
        
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" cols="50"></textarea><br><br>
        
        <label for="media">Upload Image/Video:</label><br>
        <input type="file" id="media" name="media"><br><br>
        
        <!-- <input type="submit" value="Submit"> -->
    </form>
</div> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{mix('/js/popup.js')}}"></script>

@endsection
