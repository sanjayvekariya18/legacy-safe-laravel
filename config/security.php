<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Security Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains security-related configuration settings for the
    | application. These settings help protect against various security
    | threats and vulnerabilities.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Registration Settings
    |--------------------------------------------------------------------------
    |
    | Control whether public registration is allowed and what restrictions
    | are placed on new user accounts.
    |
    */
    'registration' => [
        'enabled' => env('REGISTRATION_ENABLED', false),
        'require_email_verification' => env('REQUIRE_EMAIL_VERIFICATION', true),
        'require_admin_approval' => env('REQUIRE_ADMIN_APPROVAL', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Settings
    |--------------------------------------------------------------------------
    |
    | Configure password requirements and policies.
    |
    */
    'passwords' => [
        'min_length' => env('PASSWORD_MIN_LENGTH', 8),
        'require_special_chars' => env('PASSWORD_REQUIRE_SPECIAL', true),
        'require_numbers' => env('PASSWORD_REQUIRE_NUMBERS', true),
        'require_uppercase' => env('PASSWORD_REQUIRE_UPPERCASE', true),
        'require_lowercase' => env('PASSWORD_REQUIRE_LOWERCASE', true),
        'expire_days' => env('PASSWORD_EXPIRE_DAYS', 90),
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Configure rate limiting for various endpoints to prevent abuse.
    |
    */
    'rate_limiting' => [
        'login_attempts' => env('LOGIN_ATTEMPTS_LIMIT', 5),
        'login_timeout' => env('LOGIN_TIMEOUT_MINUTES', 15),
        'user_creation' => env('USER_CREATION_LIMIT', 10),
        'api_requests' => env('API_REQUESTS_LIMIT', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | Session Security
    |--------------------------------------------------------------------------
    |
    | Configure session security settings.
    |
    */
    'session' => [
        'lifetime' => env('SESSION_LIFETIME', 120),
        'secure' => env('SESSION_SECURE_COOKIES', true),
        'http_only' => env('SESSION_HTTP_ONLY', true),
        'same_site' => env('SESSION_SAME_SITE', 'lax'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Headers
    |--------------------------------------------------------------------------
    |
    | Configure security headers to be sent with responses.
    |
    */
    'headers' => [
        'x_frame_options' => 'DENY',
        'x_content_type_options' => 'nosniff',
        'x_xss_protection' => '1; mode=block',
        'referrer_policy' => 'strict-origin-when-cross-origin',
        'content_security_policy' => "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';",
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Configure security logging settings.
    |
    */
    'logging' => [
        'enabled' => env('SECURITY_LOGGING_ENABLED', true),
        'channel' => env('SECURITY_LOG_CHANNEL', 'security'),
        'log_failed_logins' => env('LOG_FAILED_LOGINS', true),
        'log_user_creation' => env('LOG_USER_CREATION', true),
        'log_permission_changes' => env('LOG_PERMISSION_CHANGES', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist/Blacklist
    |--------------------------------------------------------------------------
    |
    | Configure IP address restrictions.
    |
    */
    'ip_restrictions' => [
        'whitelist' => explode(',', env('IP_WHITELIST', '')),
        'blacklist' => explode(',', env('IP_BLACKLIST', '')),
        'admin_only_ips' => explode(',', env('ADMIN_ONLY_IPS', '')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Suspicious Activity Detection
    |--------------------------------------------------------------------------
    |
    | Configure settings for detecting suspicious activity.
    |
    */
    'suspicious_activity' => [
        'enabled' => env('SUSPICIOUS_ACTIVITY_DETECTION', true),
        'max_failed_logins' => env('MAX_FAILED_LOGINS', 10),
        'max_requests_per_minute' => env('MAX_REQUESTS_PER_MINUTE', 100),
        'suspicious_user_agents' => [
            'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget',
            'python', 'perl', 'ruby', 'java', 'go-http-client'
        ],
    ],

];
