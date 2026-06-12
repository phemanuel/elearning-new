<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'instructor_id',
        'enrollment_date',
        'segment',
        'completed',
        'completion_date',
        'certificate_link',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function segment()
    {
        return $this->belongsTo(Segments::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
        
}
