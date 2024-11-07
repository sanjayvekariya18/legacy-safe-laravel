<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invite extends Model
{
    use HasFactory;

    protected $table = 'invites';

    protected $fillable = [
        'invited_by',
        'email',
        'token',
        'professional_type',
        'role',
    ];

    // Define the relationship with the user who sent the invite
    public function inviter()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}
