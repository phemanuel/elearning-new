<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    

    public function segments()
    {
        return $this->belongsTo(Segments::class);
    }

    public function material()
    {
        return $this->hasMany(Material::class);
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
