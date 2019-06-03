<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_approved_list', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_approved_list' => 'array',
        'is_admin' => 'boolean'
    ];

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'user_id', 'id');
    }

    public function devices()
    {
        return $this->hasMany('App\Models\Device', 'user_id', 'id');
    }

    public function collections()
    {
        return $this->hasMany('App\Models', 'user_id', 'id');
    }
}
