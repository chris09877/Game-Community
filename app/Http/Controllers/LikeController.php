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

    public function create(Request $request, $userId, $postId){
        $user = auth()->user();
    
        if ($user->id != $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $isLiked = $user->likedPosts->where('post_id', $postId)->exists();
        
        if ($isLiked) {
            $this->delete($postId);
            return response()->json(['message' => 'Like removed'], 200);
        } else {
            $user->likedPosts->attach($postId);
            return response()->json(['message' => 'Like added'], 201);
        }
    }
    
    public function delete($postId){
        $user = auth()->user();
        $user->likedPosts->detach($postId);
    }
}
