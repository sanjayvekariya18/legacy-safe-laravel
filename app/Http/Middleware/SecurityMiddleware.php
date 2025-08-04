<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SecurityMiddleware
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
        // Log suspicious activities
        $this->logSuspiciousActivity($request);

        // Check for potential security threats
        if ($this->isSuspiciousRequest($request)) {
            Log::warning('Suspicious request detected', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method()
            ]);

            return response()->json(['error' => 'Access denied'], 403);
        }

        return $next($request);
    }

    /**
     * Log suspicious activities
     */
    private function logSuspiciousActivity(Request $request)
    {
        // Log failed login attempts
        if ($request->is('login') && $request->isMethod('post')) {
            Log::info('Login attempt', [
                'ip' => $request->ip(),
                'email' => $request->input('email'),
                'user_agent' => $request->userAgent()
            ]);
        }
    }

    /**
     * Check if request is suspicious
     */
    private function isSuspiciousRequest(Request $request)
    {
        // Check for suspicious user agents
        $userAgent = $request->userAgent();
        $suspiciousPatterns = [
            'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget'
        ];

        foreach ($suspiciousPatterns as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                return true;
            }
        }

        // Check for rapid requests (rate limiting)
        $key = 'security_' . $request->ip();
        $requests = cache()->get($key, 0);

        if ($requests > 100) { // More than 100 requests per minute
            return true;
        }

        cache()->put($key, $requests + 1, 60);

        return false;
    }
}
