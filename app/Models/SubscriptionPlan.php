<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    protected $table = 'subscription_plans';

    protected $fillable = [
        'name',
        'course_upload',
        'student_upload',
        'allocated_space',
        'image',

    ];

    public function instructors()
    {
        return $this->hasMany(Instructor::class, 'current_plan');
    }
}
