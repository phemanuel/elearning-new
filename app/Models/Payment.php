<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'instructor_id',
        'currency',
        'currency_code',
        'amount',
        'currency_value',
        'method',
        'txnid',
        'status',
    ];

     // Relationship to the Course model
     public function course()
     {
         return $this->belongsTo(Course::class, 'course_id');
     }
 
     // Relationship to the Instructor model via Course model
     public function instructor()
     {
         return $this->belongsToThrough(Instructor::class, Course::class);
     }

     public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
