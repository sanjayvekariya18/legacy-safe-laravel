<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use App\Models\User;

class SecurityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->logSecurityEvents();
    }

    /**
     * Log security-related events.
     */
    private function logSecurityEvents(): void
    {
        // Log failed login attempts
        Event::listen(Failed::class, function (Failed $event) {
            if (config('security.logging.log_failed_logins', false)) {
                Log::channel(config('security.logging.channel', 'stack'))->warning('Failed login attempt', [
                    'email' => $event->credentials['email'] ?? 'unknown',
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'timestamp' => now()->toDateTimeString(),
                ]);
            }
        });

        // Log successful logins
        Event::listen(Login::class, function (Login $event) {
            if (config('security.logging.enabled', false)) {
                Log::channel(config('security.logging.channel', 'stack'))->info('Successful login', [
                    'user_id' => $event->user->id,
                    'email' => $event->user->email,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'timestamp' => now()->toDateTimeString(),
                ]);
            }
        });

        // Log user creation
        Event::listen("eloquent.created: " . User::class, function (User $user) {
            if (config('security.logging.log_user_creation', false)) {
                Log::channel(config('security.logging.channel', 'stack'))->info('User created', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'created_by' => auth()->id(),
                    'ip' => request()->ip(),
                    'timestamp' => now()->toDateTimeString(),
                ]);
            }
        });
    }
}
