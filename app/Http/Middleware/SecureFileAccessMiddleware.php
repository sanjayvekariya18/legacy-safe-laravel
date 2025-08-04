<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SecureFileAccessMiddleware
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
        $response = $next($request);

        // Add security headers for file downloads
        if ($request->is('storage/*')) {

            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'DENY');
            $response->headers->set('X-XSS-Protection', '1; mode=block');

            // Prevent execution of uploaded files
            $response->headers->set('Content-Disposition', 'attachment');

            // Log file access for security audit
            $this->logFileAccess($request);
        }

        return $response;
    }

    /**
     * Log file access for security audit
     *
     * @param Request $request
     */
    private function logFileAccess(Request $request)
    {
        Log::channel('security')->info('File accessed', [
            'user_id' => auth()->id(),
            'path' => $request->path(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()
        ]);
    }
}
