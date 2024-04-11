<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'rol'
    ];

    protected $hidden = [
        'password', 
        'remember_token', 
        'email_verified_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recetas()
    {
        return $this->hasMany('App/Recetas');
    }

    public function favoritos()
    {
        return $this->belongsToMany('App\Recetas', 'favoritos', 'user_id', 'receta_id')
            ->as('favoritos')
            ->withTimestamps();
    }

    public function plan()
    {
        return $this->belongsToMany('App\Recetas', 'plans', 'user_id', 'receta_id')
            // ->as('plan')
            ->withPivot(['day', 'meal'])
            ->withTimestamps();
    }

    public function profile_picture()
    {
        return $this->hasOne('App\ProfilePicture', 'user_id', 'id');
    }
}
