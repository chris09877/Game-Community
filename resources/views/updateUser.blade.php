@extends('layouts.app')
@section('title', '{{$user->name}}')
@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Update your information</h1>

        <div id="update-user" title="update-user" class="rounded-lg shadow-md p-8 inline-block mt-8">
            <form action="{{ route('submitUser') }}" method="POST" enctype="multipart/form-data" id="post-form"
                data-route="{{ route('submitUser') }}" class="flex flex-col gap-6">
                @csrf

                <div class="flex flex-col mb-4">
                    <label for="Name" class="text-lg mb-2">Name:</label>
                    <input type="text" id="name" name="name" value="{{$user->name}}"
                        class="border rounded-md py-2 px-3">
                </div>

                <div class="flex flex-col mb-4">
                    <label for="email" class="text-lg mb-2">E-mail:</label>
                    <input type="text" id="email" name="email" value="{{$user->email}}"
                        class="border rounded-md py-2 px-3">
                </div>

                <div class="flex flex-col mb-4">
                    <label for="Bio" class="text-lg mb-2">Bio:</label>
                    <textarea id="Bio" name="Bio" rows="4" cols="50"
                        class="border rounded-md py-2 px-3">{{$user->Bio}}</textarea>
                </div>

                <div class="flex flex-col mb-4">
                    <label for="Avatar" class="text-lg mb-2">Upload profile picture:</label>
                    <input type="file" id="Avatar" name="Avatar" class="border rounded-md py-2 px-3">
                </div>

                @if(Auth::user()->admin)
                <div class="flex flex-col mb-4">
                    <label for="status" class="text-lg mb-2">Admin</label>
                    <select name="status" id="status" class="border rounded-md py-2 px-3">
                        <option value="true">Is admin</option>
                        <option value="false">Is regular user</option>
                    </select>
                </div>
                @endif

                <input type="number" name="user" id="user_id" style="display: none;" value="{{$user->id}}">

                <input type="submit" value="Update"
                    class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded border">
            </form>
        </div>
    </div>
</div>
@endsection


