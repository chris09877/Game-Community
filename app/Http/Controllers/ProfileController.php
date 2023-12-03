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
        $user =Auth::user(); //with('posts')->find("ID");
        //dd($user);
        if(!$user){
            return response()->json(['error' => 'User not found'], 404);
        }
        $userPosts = $user->posts()->get();
       // dd($userPosts);
        return view("profile",  ['user'=>$user,'userPosts'=>$userPosts]); //la retunr le view avec du user data tsb
    }
}
