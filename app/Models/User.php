<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'no_telp',
        'email',
        'password',
        'role',
        'saldo',
        'photo',
        'show_on_leaderboard', // ← baru
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'    => 'datetime',
            'password'             => 'hashed',
            'show_on_leaderboard'  => 'boolean', // ← baru
        ];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}