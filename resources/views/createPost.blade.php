@extends('layouts.layout')

    @section('content')
     <H1>Create POST</H1>
     
 
<!-- Button that triggers the modal
<button id="postButton">Create Post</button>

 Modal 
<div id="postModal" title="Create Post">
     Your post form goes here
    <form action="/submit-post" method="POST" enctype="multipart/form-data">
        @csrf  CSRF protection in Laravel
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br><br>
        
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" cols="50"></textarea><br><br>
        
        <label for="media">Upload Image/Video:</label><br>
        <input type="file" id="media" name="media"><br><br>
        
        <input type="submit" value="Submit">
    </form>
</div> -->
   <!-- Button that triggers the modal -->
<button id="postButton" class="btn btn-primary">Create Post</button>

<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Create Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your post form goes here -->
                <form action="/submit-post" method="POST" enctype="multipart/form-data">
        @csrf  CSRF protection in Laravel
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br><br>
        
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" cols="50"></textarea><br><br>
        
        <label for="media">Upload Image/Video:</label><br>
        <input type="file" id="media" name="media"><br><br>
        
        <input type="submit" value="Submit">
    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitPostForm()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="/communityGame-app/resources/js/popup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   <!-- <script src="{{ mix('../resources/js/popup.js', 'public/js' ) }}"></script> -->
    @endsection