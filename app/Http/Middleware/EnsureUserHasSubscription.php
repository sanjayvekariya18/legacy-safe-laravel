<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        // Check if the user is authenticated and has an active subscription
        if (!$user || !$user->subscribed('default')) {
            // Redirect to a different page or return a 403 response
            return redirect()->route('subscriptions.index')->with('error', 'You must have an active subscription to access document.');
        }
        return $next($request);
    }
}
