<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_telp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'user_id', 'id');
    }

    public function tabungan()
    {
        return $this->hasMany(BukuTabungan::class, 'user_id', 'id');
    }

    public function from()
    {
        return $this->hasMany(Message::class, 'from', 'id');
    }

    public function to()
    {
        return $this->hasMany(Message::class, 'to', 'id');
    }

    public function foto()
    {
        return $this->hasOne(FotoProfile::class, 'user_id', 'id');
    }
}
