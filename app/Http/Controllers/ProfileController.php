<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $userPosts = $user->posts()->get();
        return view("profile",  ['user' => $user, 'userPosts' => $userPosts]); //la retunr le view avec du user data tsb
    }

    public function show($id)
    {

        try {
            $user = User::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return view('updateUser', ['user' => $user]);
    }


    public function update(Request $request)
    {

        try {
            $user = User::findOrFail($request->input('user'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('Bio');

        if ($request->hasFile('Avatar')) {
            $file = $request->file('Avatar');
            $filename = $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profiles', $filename, 'public');
            $user->update(['avatar' => $path]);
        }

        if (Auth::user()->admin) {
            if ($request->has('status')) {
                $status = $request->input('status');
                $user->admin = ($status === 'true');
            }
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'User information updated successfully.');
    }
}
