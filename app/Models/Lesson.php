<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_no', 'title','course_id', 'segments_id', 'description', 'notes',
    ];

    public function segments()
    {
        return $this->belongsTo(Segments::class);
    }

    public function material()
    {
        return $this->hasMany(Material::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'lesson_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class); 
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
