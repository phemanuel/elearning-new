<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [

        'student_id',

        'title',

        'description',

        'target_value',

        'current_value',

        'target_date',

        'status',

        'goal_type',
    ];

    protected $casts = [

        'target_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function getProgressAttribute()
    {
        if ($this->target_value <= 0) {
            return 0;
        }

        return min(
            100,
            round(
                ($this->current_value / $this->target_value) * 100
            )
        );
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}