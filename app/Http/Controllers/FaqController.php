<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FaqController extends Controller
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
        //tu prends tout les faq et tout les categ puis pourchaque cat tu display le faq
        $user = Auth::user();
         $allFaqs = Faq::all();

         $bugFaqs = Faq::where('categories', 'Bug')->get();
         $updateFaqs = Faq::where('categories', 'Update')->get();
         $contactFaqs = Faq::where('categories', 'Contact')->get();
         $donationFaqs = Faq::where('categories', 'Donation')->get();
         $categories = Faq::distinct()->pluck('categories')->toArray(); // Fetch distinct categories from the FAQ table
        // dd($categories);
 
         return view('faq', compact('user', 'allFaqs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $tableName = 'faq'; 
    $columnName = 'categories'; 

    $results = DB::select(DB::raw("SHOW COLUMNS FROM $tableName WHERE Field = '$columnName'"))[0]->Type;
    preg_match('/^enum\((.*)\)$/', $results, $matches);
    $categories = [];

    if (isset($matches[1])) {
        $categories = str_getcsv($matches[1], ',', "'");
    }

    
//    dd($categories);
    
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
            'categories' => 'required|string',
            // Add any other validation rules as needed
        ]);

        // Create a new FAQ using the validated data
        $faq = Faq::create([
            'text' => $validatedData['text'],
            'categories' => $validatedData['categories'],
            'userID' => auth()->id(), // Assuming the authenticated user ID should be assigned
            'Date' => now(), // Assuming the current timestamp should be assigned
        ]);

        // Optionally, you can return a response, redirect, or perform other actions here
        return response()->json(['message' => 'FAQ created successfully', 'faq' => $faq], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tableName = 'faq'; 
    $columnName = 'categories'; 

    $results = DB::select(DB::raw("SHOW COLUMNS FROM $tableName WHERE Field = '$columnName'"))[0]->Type;
    preg_match('/^enum\((.*)\)$/', $results, $matches);
    $categories = [];

    if (isset($matches[1])) {
        $categories = str_getcsv($matches[1], ',', "'");
    }

    
//    dd($categories);
    
    return view('faqUpdate', ['categories' => $categories]);
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

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'categories' => 'required|string', 
        ]);

        // Update the FAQ with the validated data
        $faq->update([
            'title' => $validatedData['title'],
            'text' => $validatedData['text'],
            'categories' => $validatedData['categories'],
        ]);

        // Redirect back or to a specific route after successful update
        return redirect()->route('faq.show', $faq->id)->with('success', 'FAQ updated successfully');
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
    
        // Check if the authenticated user is an admin
        // if (auth()->user()->admin) {
            $faq->delete();
            // You can return a response or redirect back after deletion
            return redirect()->back()->with('success', 'FAQ deleted successfully');
        // }
    
        // return redirect()->back()->with('error', 'You do not have permission to delete this FAQ');
    }
}
