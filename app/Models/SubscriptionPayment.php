<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'currency',
        'amount',
        'txnid',
        'method',
        'plan_id',
        'no_of_months',
        'total_amount',
        'status',
    ];
}
