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

   
    const ROLE_CLIENT = 'client';
    const ROLE_ADMIN = 'administrator';
    const ROLE_TRUCKER = 'trucker';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role',
    ];
    const ALLOWED_ROLES = [self::ROLE_CLIENT, self::ROLE_ADMIN, self::ROLE_TRUCKER];
    
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

    public function setRoleAttribute($role)
    {
        if (!in_array($role, self::ALLOWED_ROLES)) {
            throw new \InvalidArgumentException("Invalid role: {$role}");
        }
        $this->attributes['role'] = $role;
    }
}
