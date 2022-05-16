<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voterpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'constestantName',
        'user_id',
        'modeOfPayment',
        'paidAt',
        'invoiceId',
        'voterName',
        'amount',
        'customerId',
    ];
}
