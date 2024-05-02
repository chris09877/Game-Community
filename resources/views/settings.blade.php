@extends('layouts.app')
@section('title', 'Settings')
@section('content')

<div class="container mx-auto py-8">
    <div class="mb-4">
        <h2 class="text-3xl font-bold">Regular Users</h2>
        <table id="userTable" class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4">User Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-t">
                    <td class="py-2 px-4">
                        <a href="{{ route('profile.update', $user->id) }}" class="text-blue-500 hover:underline">{{
                            $user->name }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <h2 class="text-3xl font-bold">Admins</h2>
        <table id="adminTable" class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4">User Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr class="border-t">
                    <td class="py-2 px-4">
                        <a href="{{ route('profile.update', $admin->id) }}" class="text-blue-500 hover:underline">{{
                            $admin->name }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection