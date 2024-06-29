<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that 1:1 Roles Class.
     *
     * @return array<string, string>
     */
    public function roles(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * The attributes that 1:1 UserDetail Class.
     *
     * @return array<string, string>
     */
    public function details()
    {
        return $this->belongsTo(UserDetail::class, 'id', 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
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
     * The password attribute default values.
     *
     * @return password<string, string>
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->password)) {
                $user->password = Hash::make('12345678');
            }
        });
    }

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
