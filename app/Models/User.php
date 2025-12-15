<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Default role after registration
     */
    protected static function booted()
    {
        static::created(function ($user) {
            if (!$user->hasAnyRole(['Admin', 'Editor', 'Author'])) {
                $user->assignRole('Author');
            }
        });
    }

    /**
     * Relationships
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Role helpers (optional but useful)
     */
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    public function isEditor()
    {
        return $this->hasRole('Editor');
    }

    public function isAuthor()
    {
        return $this->hasRole('Author');
    }
}
