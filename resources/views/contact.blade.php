@extends('layouts.app')
@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Contact Us</h1>

    <div class="max-w-md mx-auto  p-6 rounded-md shadow-md">
        <form action="{{ route('contact') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="reason" class="block text-gray-700 font-bold mb-2">The subject:</label>
                <input type="text" id="reason" name="reason" required class="border rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Your Name:</label>
                <input type="text" id="name" name="name" required class="border rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Your Email:</label>
                <input type="email" id="email" name="email" required class="border rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="message" class="block text-gray-700 font-bold mb-2">Message:</label>
                <textarea id="message" name="message" rows="5" cols="30" class="border rounded-md py-2 px-3 w-full resize-none focus:outline-none focus:ring focus:border-blue-300"></textarea>
            </div>
            <input type="submit" value="Submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none border border-black">
            <button onclick="window.location='{{route('home')}}'" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none border border-black ml-8" style="margin-left: 20%;">Cancel</button>

        </form>
        {{-- <button onclick="window.location='{{route('home')}}'" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded focus:outline-none border border-black">Cancel</button> --}}
    </div>
</div>
@endsection