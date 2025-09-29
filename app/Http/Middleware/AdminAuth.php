<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Read credentials from session
        if ($request->session()->get('is_admin', false)) {
            return $next($request);
        }

        // Not logged in → redirect to login form
        return redirect()->route('admin.login.form');
    }
}
