<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    
   

    public function create(Request $request){
        $userId = $request->userId;
        $postId = $request->postId;
        try {
            $user = User::findOrFail($userId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
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
