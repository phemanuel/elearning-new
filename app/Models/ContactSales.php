<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSales extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'no_of_course',
        'no_of_student',
        'storage_space',
        'additional_information',
    ];
}
