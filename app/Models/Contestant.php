<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contestant extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $guard = 'contestant';

    protected $fillable = [
        'firstName',
        'lastName',
        'phoneNumber',
        'email',
        'google_id',
        'password',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
