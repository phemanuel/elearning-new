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
        'payment_status',
        'transaction_reference',
    ];
}
