@extends('layouts.layout')
@section('title', 'Home')

        @section('content')
        <div class="text-center">
            <!-- Image centered in the middle of the page -->
            <div class="mx-auto mb-8">
            <img src="{{ asset('storage/ehb-logo.jpg') }}" alt="Community Game EhB" class="mx-auto mb-8">
        </div>
            <h1 class="text-white text-4xl font-bold">Community Game EHB</h1>
        </div>
        @endsection