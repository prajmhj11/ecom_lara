<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'customer';

    protected $fillable = ['name','email','password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
