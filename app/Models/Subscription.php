<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'plan_id',
        'no_of_months',
        'start_date',
        'end_date',
        'total_amount',
        'status',
    ];

    public function instructors()
    {
        return $this->hasMany(Instructor::class, 'current_plan');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }
}
