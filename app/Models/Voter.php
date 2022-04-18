<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Voter extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $guard = 'voter';

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
