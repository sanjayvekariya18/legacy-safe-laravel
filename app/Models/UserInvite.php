<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvite extends Model
{
    protected $fillable = [
        'inviteer_id',
        'invitee_id',
    ];
    public function inviter()
    {
        return $this->belongsTo(User::class, 'inviteer_id');
    }

    public function invitee()
    {
        return $this->belongsTo(User::class, 'invitee_id');
    }
}
