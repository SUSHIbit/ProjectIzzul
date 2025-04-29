<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function isLecturer()
    {
        return $this->role === 'lecturer';
    }
    
    public function isGuest()
    {
        return $this->role === 'guest';
    }
    
    public function isApproved()
    {
        return $this->role === 'admin' || $this->role === 'lecturer';
    }
}