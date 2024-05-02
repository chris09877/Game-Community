<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $users = User::where('admin', false)->get();
    $admins = User::where('admin', true)->get();
    return view('settings', ['users' => $users, 'admins' => $admins]);
}
}
