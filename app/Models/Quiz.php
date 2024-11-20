<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'completed',
    //     'quiz_attempt',
    //     'last_attempt_time',
    //     'score',
    // ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segments::class, 'segment_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
}
