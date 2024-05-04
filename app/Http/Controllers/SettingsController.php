<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    try {
        $users = User::where('admin', false)->get();
        $admins = User::where('admin', true)->get();
        return view('settings', ['users' => $users, 'admins' => $admins]);
    } catch (\Exception $e) {
        // Handle the error, for example, log it or return a custom error response
        Log::error($e->getMessage());
        return response()->json(['error' => 'An error occurred while fetching data'], 500);
    }
    return view('settings', ['users' => $users, 'admins' => $admins]);
}
}
