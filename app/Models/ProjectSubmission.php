<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'project_id',
        'project_link',
        'project_status',
        'comment',
    ];
}
