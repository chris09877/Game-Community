@extends('layouts.app')
@section('title', '{{$faq->title}}')
@section('content')
<div class="flex justify-center items-center h-screen" style="display: flex; justify-content:center; ">
    <div class="max-w-md w-full px-6">
        <h1 class="text-2xl font-bold mb-4 ml-5">{{$faq->title}}</h1>
        <form id="faqForm" method="POST" action="{{ route('faq.update', $faq->id) }}" class=" rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" value="{{ $faq->title }}" class="border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="text" class="block text-gray-700 text-sm font-bold mb-2">Text:</label>
                <textarea name="text" class="border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $faq->text }}</textarea>
            </div>

            <div class="mb-4">
                <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">Select Category:</label>
                <select name="categories" class="border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button onclick="window.location = '{{route('faq')}}'" id="editButton" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                <input type="submit" value="Save" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </div>
        </form>
    </div>
</div>
@endsection
