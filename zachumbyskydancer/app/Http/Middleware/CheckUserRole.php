<?php

// app/Http/Middleware/CheckUserRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check the user's role
            if ($user->role == 'Customer') {
                // If the user's role is customer, redirect them or show an error message
                return view('error')->with('error', 'You are not authorized to access this page.');
            }
        }

        return $next($request);
    }
}
