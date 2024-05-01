<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!Auth::check()) {
            return redirect('login')->with('error', 'You must be logged in to submit a comment.');
        }

        elseif (!$user->exists()) {
            return redirect('register')->with('error', 'Logged in user do not exist');

        };
        $validatedData = $request->validate([
            'reply' => 'required',
            'faq_id' => 'sometimes|exists:faq,id|nullable',
            'post_id' => 'sometimes|exists:post,id|nullable'
        ]);
    
        // Create a new comment instance
        $comment = new Comment();
        $comment->text = $validatedData['reply'];
        $comment->faq_id = $validatedData['faq_id'] ?? null;
        $comment->post_id = $validatedData['post_id'] ?? null;
        $comment->parent_id = null;
        $comment->created_at = now();
        $comment->user_id = Auth::id();
        $comment->save();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category updated successfully']);
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect('login')->with('error', 'You must be logged in to delete a comment.');
    }

    $comment = Comment::find($id);

    if (!$comment) {
        return redirect()->back()->with('error', 'Comment not found');
    }

    // Check if the user is the owner of the comment or an admin
    $user = Auth::user();
    if ($comment->user_id !== $user->id && !$user->admin) {
        return redirect()->back()->with('error', 'You do not have permission to delete this comment');
    }

    $comment->delete();

    return redirect()->back();
}
}
