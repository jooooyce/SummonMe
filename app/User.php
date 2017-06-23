<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name', 'phone_number', 'user_policy_accepted'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];
    protected $casts = [
        'admin' => 'boolean',
		'disabled' => 'boolean',
    ];

     
    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = \Hash::make($value);
    }


       public function ads()
    {

        return $this->hasMany(Ad::class);
    }

}
