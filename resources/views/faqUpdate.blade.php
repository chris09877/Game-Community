@extends('layouts.layout')
@section('content')
    <h1>{{$faq->title}}</h1>
    <form id="faqForm" method="POST" action="{{ route('faq.update', $faq->id) }}">
        @csrf
        @method('POST')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $faq->title }}" ><br>

        <label for="text">Text:</label>
        <textarea name="text" >{{ $faq->text }}</textarea><br>

        <label for="categories">Select Category:</label>
    <select name="categories">
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>

        @endforeach
    </select>
    <button onclick="window.location = '{{route('faq')}}'" id="editButton">Cancel</button>

       <input type="sumbit" value="Save">
    </form>

    
@endsection