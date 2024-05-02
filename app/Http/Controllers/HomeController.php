<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $userPosts = Post::where('user_id', $user->id)->get();
        $userPosts = Post::orderBy('created_at', 'desc')->get();
        $allPosts = Post::all();
        $allPosts = Post::orderBy('created_at', 'desc')->get();
        $comments = Comment::whereNotNull('post_id')->get();

        return view('home', ['user' => $user, 'userPosts' => $userPosts, 'allPosts' => $allPosts, 'comments'=>$comments]);
    }
}
