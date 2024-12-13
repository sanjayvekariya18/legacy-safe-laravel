<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id', 'name', 'guard_name',
    ];

    protected $dates = ['deleted_at'];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    public function roleHasPermissions()
    {
        return $this->hasMany(RoleHasPermissions::class, 'role_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'User', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
