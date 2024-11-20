<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id', 
        'title',
        'content',
        'content_data',
        'file_size',
        'file_duration',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
