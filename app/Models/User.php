<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasRoles, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'password',
        'role',
        'permissions'
    ];

    protected $hidden = [
        'password',
    ];

    // Method to check if user has specific permissions
    public function hasPermissions(array $permissions): bool
    {
        $userPermissions = json_decode($this->permissions, true);
        return !array_diff($permissions, $userPermissions);
    }
}
