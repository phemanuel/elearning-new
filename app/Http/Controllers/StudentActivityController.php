<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressAll;

class StudentActivityController extends Controller
{
    //
    public function index()
    {
        $studentId = currentUserId();

        /*
        |--------------------------------------------------------------------------
        | FETCH ACTIVITY DATA
        |--------------------------------------------------------------------------
        */

        $activities = ProgressAll::where('student_id', $studentId)
            ->with(['course', 'lesson'])
            ->orderBy('last_viewed_at', 'desc')
            ->limit(50)
            ->get()
            ->map(function ($item) {

                $type = 'lesson_viewed';

                if ($item->completed == 1) {
                    $type = 'course_completed';
                } elseif (!is_null($item->score)) {
                    $type = 'quiz_attempt';
                } elseif ($item->progress_percentage > 0) {
                    $type = 'progress_update';
                }

                return [
                    'type' => $type,
                    'course' => $item->course->title ?? 'Unknown Course',
                    'lesson' => $item->lesson->title ?? null,
                    'progress' => $item->progress_percentage,
                    'score' => $item->score,
                    'time' => Carbon::parse($item->last_viewed_at),
                ];
            });

        return view('students.learning_activity', compact('activities'));
    }
}
