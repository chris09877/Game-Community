@extends('layouts.app')
@section('title', 'Ask your Question')
@section('content')

    <h1 class="text-4xl mb-8 text-center ">Create question</h1>
    
    <div id="postModal" title="Create Post" class="container mx-auto py-8 mt-5">
        <form action="{{ route('submitFaq') }}" method="POST" enctype="multipart/form-data" id="post-form"
            data-route="{{ route('submitFaq') }}">
            @csrf
            <div class="mb-4">
                <label for="Title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="Title" name="title" class="border rounded-md py-2 px-3 w-full">
            </div>
    
            <div class="mb-4">
                <label for="Content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea id="Content" name="text" rows="4" cols="50" class="border rounded-md py-2 px-3 w-full"></textarea>
            </div>
    
            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Select category:</label>
                <select type="" id="category" name="categories" class="border rounded-md py-2 px-3">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <input type="submit" value="Submit" class=" font-bold py-2 px-4 rounded border">
        </form>
    </div>
    
    

@endsection