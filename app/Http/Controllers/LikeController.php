<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    
    public function __construct(){
        $this->middleware("auth");
    }

    public function create(Request $request){
        $userId = $request->userId;
        $postId = $request->postId;
        $user = User::find($userId);

        if ($user->id != auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $isLiked = $user->likedPosts()->where('post_id', $postId)->exists();
        
        if ($isLiked) {
            $this->delete($postId);
        } else {
            $user->likedPosts()->attach($postId);
            return response()->json(['message' => 'Like added'], 201);
        }
    }
    
    public function delete($postId){
        $user = User::find(auth()->id());
        $user->likedPosts()->detach($postId);
        return response()->json(['message' => 'Like removed'], 200);

    }
}
