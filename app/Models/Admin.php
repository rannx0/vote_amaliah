<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'password',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password',
    ];

    // Optionally, you can add additional fields and methods here
}

