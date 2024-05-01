<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this -> middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    if (!auth()->user()->admin) {
        // Redirect the user or return an error response
        return redirect('/')->with('error', 'Unauthorized access.');
    }

    $users = User::where('admin', false)->get();
    $admins = User::where('admin', true)->get();
    return view('settings', ['users' => $users, 'admins' => $admins]);
}
}
