<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::get(); 
        $user_id =auth()->user()->instructor_id;       
        $student = Student::all();
        $course = Course::where('instructor_id', $user_id)->get();
        $allCourse = Course::all();       
        $enrollments = Enrollment::with(['student', 'course' => function($query) {
            $query->withCount('segments');
        }])->where('instructor_id', $user_id)->get();
        $allEnrollments = Enrollment::with(['student', 'course' => function($query) {
            $query->withCount('segments');
        }])->get();
        $allEnrollment = Enrollment::all();
        $instructor = Instructor::where('id', $user_id)->first();
        
        
        if (fullAccess())
            return view('backend.adminDashboard', compact('student','course','allEnrollment','allCourse','allEnrollments')); 
        else
        if ($user->role = 'Instructor')
            return view('backend.instructorDashboard', compact('student','course','enrollments','course','instructor')); 
        else
            return view('backend.dashboard', compact('student','course','enrollments','course'));        
    }
}
