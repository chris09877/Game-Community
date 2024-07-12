<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class CreatePostController extends Controller
{


    public function index()
    {
        
        return view("createPost");
    }

    public function store(Request $request)
    {
        //ici ca prends les fields du form based on name
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'media' => 'sometimes|file', 
        ]);
        $user = auth()->user();
        $userId = $user->id;
        $date = now();

        if ($request->hasFile('media')) {

            $post =  Post::create([
                'title' => $data['title'], //a gauche c'est le nom dans le db a roite c'est le nom dans name in HTML
                'content' => $data['content'],
                'image' => null,
                'user_id' => $userId,
                'created_at' => $date,

            ]);

            $file = $request->file('media');
           // $filename = $post->id . '.' . $file->getClientOriginalExtension();
           $filename = $post->id . '_' . time() . '.' . $file->getClientOriginalExtension(); // Unique filename

            // Store the file in the public disk under the 'avatars' folder
            $path = $file->storeAs('posts', $filename, 'public');
            $post->update(['image' => $path]);
            $post->save();
        } else {
            $post =  Post::create([
                'title' => $data['title'], //a gauche c'est le nom dans le db a roite c'est le nom dans name in HTML
                'content' => $data['content'],
                'image' => null,
                'user_id' => $userId, 
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
            Log::error("Post not found: " . $e->getMessage());
            return redirect()->back()->with('error', 'Post not found');
        } catch (\Exception $e) {
            Log::error("An error occurred: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred');
        }
        $comments = Comment::where('post_id', $post->id)->get();
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
        if ($post->image) {
            try {
                if (Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }
            } catch (\Exception $e) {
                Log::error('Error deleting file: ' . $e->getMessage());
            }
        }

        $file = $request->file('media');
        $filename = $post->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('posts', $filename, 'public');

        Log::info('New image path: ' . $path);

        // Update the post with the new image path
        $post->image = $path;
        $post->save();
    }

    // Update other fields
    $post->title = $data['title'] ?? $post->title;
    $post->updated_at =  now();
    $post->content = $data['content'] ?? $post->content;
    $post->save();

    return redirect('dashboard')->with('success', 'Post updated successfully');
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
