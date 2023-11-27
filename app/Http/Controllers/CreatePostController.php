<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CreatePostController extends Controller
{
    
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
        return view("createPost");
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image/video' => 'sometimes|file', // problem c'est que le field peut prendre images & videos mais y a pas ca soit cest vidéo soit images tema chat avec gpt
        ]);
    
        $post =  Post::create([
            'title' => $data['name'],
            'content' => $data['content'],
            'image/video' => $data['image/video'],

        ]);
        return response()->json(['message' => 'Post created successfully']);
    }


}
