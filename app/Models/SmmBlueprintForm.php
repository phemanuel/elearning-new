<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmmBlueprintForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'course',
        'payment_status',
        'transaction_reference',
        'password',
        'course',
        'course_code',
    ];
}
