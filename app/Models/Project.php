<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'instructor_id',
        'course_title',
        'project_content',
        'additional_info',
    ];


    public function submissions()
    {
        return $this->hasMany(ProjectSubmission::class, 'project_id', 'id');
    }
    
}
