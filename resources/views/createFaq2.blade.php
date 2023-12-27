@extends('layouts.app')

@section('title', 'Ask Your Question')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-2/3 p-6 bg-white shadow-md rounded-md">
        <h1 class="text-4xl mb-8 text-center">Ask your question</h1>

        <form action="{{ route('submitFaq') }}" method="POST" enctype="multipart/form-data" id="post-form">
            @csrf

            <div class="mb-4">
                <label for="Title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="Title" name="title" class="border rounded-md py-2 px-3 w-full">
            </div>

            <div class="mb-4">
                <label for="Content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea id="Content" name="text" rows="4" class="border rounded-md py-2 px-3 w-full"></textarea>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Select category:</label>
                <select id="category" name="categories" class="border rounded-md py-2 px-3 w-full">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Submit" class="font-bold py-2 px-4 rounded border bg-blue-500 text-white hover:bg-blue-700">
        </form>
    </div>
</div>
@endsection
