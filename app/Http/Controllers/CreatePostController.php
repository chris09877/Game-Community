<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CreatePostController extends Controller
{


    public function index()
    {
        dd("ggggg");
        return view("createPost");
    }

    public function store(Request $request)
    {
        //ici ca prends les fields du form based on name
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'media' => 'sometimes|file', // problem c'est que le field peut prendre images & videos mais y a pas ca soit cest vidéo soit images tema chat avec gpt
            // 'user2' => 'sometimes|int|max:11',
        ]);
        $user = auth()->user();
        $userId = $user->id;
        $date = now();

        if ($request->hasFile('media')) {

            $post =  Post::create([
                'title' => $data['title'], //a gauche c'est le nom dans le db a roite c'est le nom dans name in HTML
                'content' => $data['content'],
                'image' => null, //$path,//data['media'],
                'user_id' => $userId, //8,//$data['user_id'],//(int)Auth::id(),
                'created_at' => $date,

            ]);

            $file = $request->file('media');
            $filename = $post->id . '.' . $file->getClientOriginalExtension();

            // Store the file in the public disk under the 'avatars' folder
            $path = $file->storeAs('posts', $filename, 'public');
            $post->update(['image' => $path]);
            $post->save();
        } else {
            //$mediaPath = null; // Set default value if no file is uploaded
            $post =  Post::create([
                'title' => $data['title'], //a gauche c'est le nom dans le db a roite c'est le nom dans name in HTML
                'content' => $data['content'],
                'image' => null,
                'user_id' => $userId, //8,//$data['user_id'],//(int)Auth::id(),
                'created_at' => $date,

            ]);
        }


        return redirect('dashboard')->with('success', 'Post created successfully');
    }

    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            $user = Auth::user();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the post is not found
            return redirect()->back()->with('error', 'Post not found');
        } catch (\Exception $e) {
            // Handle other possible exceptions
            return redirect()->back()->with('error', 'An error occurred');
        }
        $user = Auth::user();

        try {
            $post = Post::findOrFail($id);
            $user = Auth::user();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Post not found: " . $e->getMessage());
            return redirect()->back()->with('error', 'Post not found');
        } catch (\Exception $e) {
            Log::error("An error occurred: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred');
        }
        $comments = Comment::where('post_id', $post->id)->get();
        return view('post', ['post' => $post, 'user' => $user, 'comments' => $comments]);
        return view('post', ['post' => $post, 'user' => $user, 'comments' => $comments]);
    }

    public function update(Request $request, $id)
    {

        try {
            $post = Post::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Post not found');
        }
        $data = $request->validate([
            'content' => 'sometimes|string',
            'media' => 'sometimes|file|nullable',
            'title' => 'sometimes|string|max:255',
            'updated_at' => 'sometimes|date',
        ]);

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $filename = $id . '.' . $file->getClientOriginalExtension();
            // Store the file in the public disk under the 'posts' folder (adjust folder name if needed)
            $path = $file->storeAs('posts', $filename, 'public');

            // Update the post with the new data and media file path
            $post->update([
                'image' => $path,
                'title' => $data['title'],
                'updated_at' => $data['updated_at'],
                'content' => $data['content'],
            ]);
        } else {
            // Update the post with the new data, excluding media file path
            $post->update([
                'title' => $data['title'],
                'updated_at' => $data['updated_at'],
                'content' => $data['content'],
            ]);
        }

        return redirect()->back()->with('success', 'Post created successfully');
    }

    public function delete($id)
    {

        try {
            $post = Post::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Post not found');
        }



        // Delete the post
        $post->delete();

        // Redirect to a specific route or perform any other action
        return redirect()->route('home')->with('success', 'Post deleted successfully');
    }
}
