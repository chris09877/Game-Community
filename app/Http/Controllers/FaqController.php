<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

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


        return view('faq', compact('user', 'allFaqs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();

        return view('createFaq', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'category_id' => 'required|string',
            // Add any other validation rules as needed
        ]);


        // Create a new FAQ using the validated data and the retrieved category ID
        $faq = Faq::create([
            'text' => $validatedData['text'],
            'category_id' => $validatedData['category_id'],
            'userID' => auth()->id(),
            'Date' => now(),
        ]);
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
        // Find the FAQ by ID
        $faq = Faq::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'category_id' => 'required|string',
            // Add any other validation rules as needed
        ]);


        //checking if string = existing category name 
        $category = Category::where('name', $validatedData['category_id'])->first();
        if ($category !== null) {
            $faq->update([
                'title' => $validatedData['title'],
                'text' => $validatedData['text'],
                'category_id' => $category->id,

            ]);
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
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully');
    }
}
