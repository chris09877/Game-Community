@extends('layouts.layout')

@section('content')


<h1>settings</h1>
<h2>Regular Users</h2>
<table id="userTable">
    <thead>
        <tr>
            <th>User Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)

            <tr id="row_{{ $user->id }}">
                <td>
                    <a href="{{route('profile.update', $user->id)}}">

                    <span class="category-name">{{ $user->name }}</span>
                </a>
                </td>
                {{-- <td>
                    <button class="deleteBtn" data-id="{{ $category->id }}">Delete</button>
                </td> --}}
            </tr>
       
        @endforeach
    </tbody>
</table>

<h2>Admins</h2>
<table id="adminTable">
    <thead>
        <tr>
            <th>User Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
            <tr id="row_{{ $admin->id }}">
                <td>
                    <a href="{{route('profile.update', $admin->id)}}">

                    <span class="category-name">{{ $admin->name }}</span>
                </a>

                </td>
                {{-- <td>
                    <button class="deleteBtn" data-id="{{ $category->id }}">Delete</button>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
@endsection