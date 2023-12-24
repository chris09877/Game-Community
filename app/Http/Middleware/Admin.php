<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->admin) {
            return $next($request);
        }

        return redirect('/home'); // Redirect unauthorized users to another page (change this as needed)
    }
}
?>