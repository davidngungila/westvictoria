<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Routes that don't need authentication
        $guestRoutes = [
            'login',
            'password.request',
            'password.email',
        ];
        
        // Routes that require authentication
        $authRoutes = [
            'dashboard',
            'users.dashboard',
            'users.management',
            'users.store',
            'users.edit',
            'users.update',
            'users.destroy',
            'users.toggle',
            'settings.dashboard',
            'settings.profile.update',
            'settings.preferences.update',
            'settings.system.update',
            'profile.index',
            'billing.index',
            'help.index',
        ];
        
        $routeName = $request->route()->getName();
        
        // Check if current route requires authentication
        if (in_array($routeName, $authRoutes)) {
            if (Auth::check()) {
                return $next($request);
            }
            
            // Redirect to login page if not authenticated
            return redirect()->route('login')
                ->with('error', 'Please login to access this page.');
        }
        
        // Allow guest routes to proceed
        return $next($request);
    }
}
