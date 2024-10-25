<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMIN = "Admin";
    const ROLE_CUSTOMER = "Customer";
    const ROLE_PROFESSIONAL = "Professional";
    const ROLE_USER = "User";

    const PROFESSIONAL_TYPE_SOLICITOR = "Solicitor";
    const PROFESSIONAL_TYPE_PROFESSIONAL = "Professional";

    public const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_CUSTOMER,
        self::ROLE_PROFESSIONAL,
        self::ROLE_USER,
    ];

    // Define a static array
    public const PROFESSIONAL_TYPES = [
        self::PROFESSIONAL_TYPE_SOLICITOR => 'Solicitor',
        self::PROFESSIONAL_TYPE_PROFESSIONAL => 'Professional',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
