<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Faq;
use Illuminate\Validation\ValidationException;

class FaqController extends Controller
{

    public function __construct()
{
    $this->middleware('auth'); 
}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //tu prends tout les faq et tout les categ puis pourchaque cat tu display le faq
        $user = Auth::user();
        $allFaqs = Faq::all();
        $categories = Category::all();
        $comments = Comment::whereNotNull('faq_id')->get();

        return view('faq', compact('user', 'allFaqs', 'categories', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('You must be logged in to create a category.');

        }
        if(!Auth::user()->admin){
            return redirect()->route('login')->withErrors('You must be logged in to check a user profile.');

        }
        $categories = Category::all();
        return view('createFaq2', ['categories' => $categories]);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    if(!Auth::user()->admin){
        return redirect()->route('login')->withErrors('You must be logged in to check a user profile.');

    }

        try {
            $validatedData = $request->validate([
                'title' => 'required|string',
                'text' => 'required|string',
                'categories' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        
        $faq = Faq::create([
            'title' => $validatedData['title'],
            'text' => $validatedData['text'],
            'category_id' => $validatedData['categories'],
            'user_id' => auth()->id(),
            'created_at' => now(),
        ]);
        $faq->save();
        return redirect()->route('faq')->with("status", "FAQ question successfully created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = Category::all();
        return view('faqUpdate', ['categories' => $categories, 'faq' => $faq]);
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
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('You must be logged in to create a category.');

        }
        if(!Auth::user()->admin){
        return redirect()->route('login')->withErrors('You must be logged in to check a user profile.');

        }
        // Find the FAQ by ID
        $faq = Faq::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'categories' => 'required|string',
        ]);

        $categoryId = intval($validatedData['categories']);
        //checking if string = existing category name 
        $category = Category::where('id', $categoryId);//->first();
        //dd($category);  
        if ($category !== null) {
            $faq->update([
                'title' => $validatedData['title'],
                'text' => $validatedData['text'],
                'category_id' => $categoryId,
                'updated_at' => now(),

            ]);
           // dd($categoryId, $faq);
            return redirect()->route('faq.show', $faq->id)->with('success', 'FAQ updated successfully');
        } else {
            return redirect()->route('faq.show', $faq->id)->with('error', 'FAQ not updated');
        }






        // Redirect back or to a specific route after successful update
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('You must be logged in to create a category.');

        }
        if(!Auth::user()->admin){
        return redirect()->route('login')->withErrors('You must be logged in to check a user profile.');

        }
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully');
    }
}
