@extends('layouts.layout')

@section('content')
<h1>Update your information</h1>

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
        @if(Auth::user()->admin)
        <label for="status">Admin</label>
        <select name="status" id="status">
            <option value="true">Is admin</option>
            <option value="false">Is regular user</option>
        </select>
        @endif
        <input type="number" name="user" id="user_id" style="display: none;" value="{{Auth::id()}}">

        <input type="submit" value="Update">
    </form>
</div>
@endsection