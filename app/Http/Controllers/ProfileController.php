<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function index (){
        $user =Auth::user(); 
        if(!$user){
            return response()->json(['error' => 'User not found'], 404);
        }
        $userPosts = $user->posts()->get();
        return view("profile",  ['user'=>$user,'userPosts'=>$userPosts]); //la retunr le view avec du user data tsb
    }

    public function show($id){
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('You must be logged in to check a user profile.');
        }
        $user = User::findOrFail($id);
        return view('updateUser', ['user' => $user]);


    }


public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('You must be logged in to update information.');
        }
    
        $user = User::findOrFail($request->input('user'));
    
        if (Auth::id() != $user->id) {
            return redirect()->route('profile')->withErrors('You do not have permission to update this user.');
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
