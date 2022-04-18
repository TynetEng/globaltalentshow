<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestantdetail extends Model
{
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable = [
        'id',
        'name',
        'information',
        'phoneNumber',
        'image',
        'trackingNumber',
    ];
}
