<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $securityConfig = config('security.headers', []);

        $response->headers->set('X-Frame-Options', $securityConfig['x_frame_options'] ?? 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', $securityConfig['x_content_type_options'] ?? 'nosniff');
        $response->headers->set('X-XSS-Protection', $securityConfig['x_xss_protection'] ?? '1; mode=block');
        $response->headers->set('Referrer-Policy', $securityConfig['referrer_policy'] ?? 'no-referrer');
        $response->headers->set('Content-Security-Policy', $securityConfig['content_security_policy'] ?? "default-src 'self'");
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        return $response;
    }
}
