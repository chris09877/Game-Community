<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CreatePostController extends Controller
{
    
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
        return view("createPost");
    }

    public function store(Request $request){
        //ici ca prends les fields du form based on name
        $data = $request->validate([
            'Title' => 'sometimes|string|max:255',
            'Content' => 'sometimes|string',
            'media' => 'sometimes|file', // problem c'est que le field peut prendre images & videos mais y a pas ca soit cest vidéo soit images tema chat avec gpt
            // 'user2' => 'sometimes|int|max:11',
        ]);
        //$data['user_id'] = Auth::id();
        //dd( auth()->check(),auth()->id(), auth()->user());
       $user = auth()->user();
        $userId = $user->ID;
        //Cookie::get('id');
        //dd( $userId, $user);
        // $userId=$request->cookie('id');
        $date = now();
      // dd($data); //to show de data var in browser

       if ($request->hasFile('media')) {
       //pas besoind de ca wlh: $mediaPath = $request->file('media')->store('media_folder');
       $post =  Post::create([
        'Title' => $data['Title'], //a gauche c'est le nom dans le db a roite c'est le nom dans name in HTML
        'Content' => $data['Content'],
        'images/videos' => $data['media'],
        'User' => $userId,//8,//$data['user_id'],//(int)Auth::id(),
        'created_at' => $date,

    ]);
    } 
    else {
        //$mediaPath = null; // Set default value if no file is uploaded
        $post =  Post::create([
            'Title' => $data['Title'], //a gauche c'est le nom dans le db a roite c'est le nom dans name in HTML
            'Content' => $data['Content'],
            'images/videos' => null,
            'User' => $userId,//8,//$data['user_id'],//(int)Auth::id(),
            'created_at' => $date,

        ]);

    }

        // $post =  Post::create([
        //     'Title' => $data['Title'], //a gauche c'est le nom dans le db a roite c'est le nom dans name in HTML
        //     'Content' => $data['Content'],
        //     'images/videos' => $data['media'],
        //     'User' => $userId,//8,//$data['user_id'],//(int)Auth::id(),
        //     'Creation' => $date,

        // ]);
        //dd($post);
        return response()->json(['message' => 'Post created successfully']);
    }


}
