<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

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
