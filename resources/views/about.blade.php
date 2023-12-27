@extends('layouts.layout')

@section('title', 'About')

@section('content')
<div class="max-w-3xl mx-auto mt-8 px-4">
    <h1 class="text-3xl font-bold mb-6">List of Resources</h1>

    <div class="mb-6">
        <h2 class="text-xl font-bold">Chat-GPT:</h2>
        <a href="https://chat.openai.com" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">
            https://chat.openai.com
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold">Laravel - Basic Tutorial:</h2>
        <a href="https://www.youtube.com/watch?v=lPr9jD7qcdg&list=PL4cUxeGkcC9hL6aCFKyagrT1RCfVN4w2Q&index=28"
            class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">
            https://www.youtube.com/watch?v=lPr9jD7qcdg&list=PL4cUxeGkcC9hL6aCFKyagrT1RCfVN4w2Q&index=28
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold">Tailwind Documentation:</h2>
        <a href="https://tailwindui.com/documentation" class="text-blue-500 hover:underline" target="_blank"
            rel="noopener noreferrer">
            https://tailwindui.com/documentation
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold">Laravel Documentation:</h2>
        <a href="https://laravel.com/docs/10.x/readme" class="text-blue-500 hover:underline" target="_blank"
            rel="noopener noreferrer">
            https://laravel.com/docs/10.x/readme
        </a>
    </div>
</div>
@endsection
