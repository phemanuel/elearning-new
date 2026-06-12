<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Progress;
use App\Models\ProgressAll;
use Illuminate\Support\Carbon;

class StudentLearningStatController extends Controller
{
    //

    public function index()
    {
        $studentId = currentUserId();

        /*
        |--------------------------------------------------------------------------
        | BASE QUERIES (REUSEABLE)
        |--------------------------------------------------------------------------
        */

        $enrollmentQuery = Enrollment::where('student_id', $studentId);
        $progressQuery = Progress::where('student_id', $studentId);
        $activityQuery = ProgressAll::where('student_id', $studentId);

        /*
        |--------------------------------------------------------------------------
        | 📚 COURSE STATS
        |--------------------------------------------------------------------------
        */

        $enrolledCourses = (clone $enrollmentQuery)->count();

        $completedCourses = (clone $enrollmentQuery)
            ->where('completed', 1)
            ->count();

        $activeCourses = max($enrolledCourses - $completedCourses, 0);

        /*
        |--------------------------------------------------------------------------
        | 📊 PROGRESS STATS
        |--------------------------------------------------------------------------
        */

        $avgProgress = (clone $progressQuery)
            ->avg('progress_percentage');

        $avgProgress = round($avgProgress ?? 0, 1);

        $avgQuizScore = (clone $progressQuery)
            ->whereNotNull('score')
            ->avg('score');

        $avgQuizScore = round($avgQuizScore ?? 0, 1);

        /*
        |--------------------------------------------------------------------------
        | ⏱ ACTIVITY STATS
        |--------------------------------------------------------------------------
        */

        $totalLearningEvents = (clone $activityQuery)->count();

        $uniqueCoursesEngaged = (clone $activityQuery)
            ->distinct('course_id')
            ->count('course_id');

        /*
        |--------------------------------------------------------------------------
        | 🔥 ENGAGEMENT INTELLIGENCE
        |--------------------------------------------------------------------------
        */

        $completionRate = $enrolledCourses > 0
            ? round(($completedCourses / $enrolledCourses) * 100, 1)
            : 0;

        $engagementLevel = match (true) {
            $totalLearningEvents > 50 => 'High',
            $totalLearningEvents > 20 => 'Medium',
            default => 'Low',
        };

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('students.learning_stats', [
            'enrolledCourses' => $enrolledCourses,
            'completedCourses' => $completedCourses,
            'activeCourses' => $activeCourses,

            'avgProgress' => $avgProgress,
            'avgQuizScore' => $avgQuizScore,

            'totalLearningEvents' => $totalLearningEvents,
            'uniqueCoursesEngaged' => $uniqueCoursesEngaged,

            'completionRate' => $completionRate,
            'engagementLevel' => $engagementLevel,
        ]);
    }

}
