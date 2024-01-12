<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{


    public function __construct (){
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("categories",['categories' => $categories]);
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
        // Validate the form data
    $validatedData = $request->validate([
        'categoryName' => 'required|string|max:255',
    ]);

    // Create a new category instance
    $category = new Category();
    $category->name = $validatedData['categoryName'];
    // Set any other properties of the category as needed

    // Save the category to the database
    $category->save();

    // Redirect to the index page or any other page as desired
    return redirect()->route('category');
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
        $category = Category::find($id);

        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Update the category's name
        $category->name = $validatedData['name'];
        // Update any other properties of the category as needed
    
        // Save the updated category to the database
        $category->save();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category updated successfully']);
        }
        // Redirect to the index page or any other page as desired
        return redirect()->route('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function destroy(Request $request, $id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['success' => false, 'message' => 'Category not found'], 404);
    }

    $category->delete();

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Category deleted successfully']);
    }

    return redirect()->route('category')->with('success', 'Category deleted successfully');
}

    
}
