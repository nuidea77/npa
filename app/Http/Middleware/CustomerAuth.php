<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerAuth
{
    public function handle($request, Closure $next)
    {
        // Check if the customer is authenticated using the 'customer' guard
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.signin')->withErrors([
                'auth' => 'You need to log in to access this page.',
            ]);
        }

        return $next($request);
    }
}
