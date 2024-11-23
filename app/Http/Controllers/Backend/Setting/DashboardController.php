<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Payment;
use App\Models\Subscription;

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
        }])->where('instructor_id', $user_id)
        ->orderBy('enrollment_date', 'desc')
        ->paginate(10);
        $allEnrollments = Enrollment::with(['student', 'course' => function($query) {
            $query->withCount('segments');
        }])
        ->orderBy('enrollment_date', 'desc')
        ->paginate(10);
        $allEnrollment = Enrollment::paginate(10);  
        $instructorPlan = Instructor::with('currentPlan')->paginate(10);

        if (fullAccess()){
            $courseShow = Course::withCount('segment')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
            $totalCourseFee = Payment::sum('amount');
           return view('backend.adminDashboard', compact('student','course','allEnrollment','allCourse',
           'allEnrollments','totalCourseFee','courseShow','instructorPlan'));  
        }            
        elseif ($user->role = 'Instructor'){
            $instructor = Instructor::where('id', $user_id)->first();
            $courseShow = Course::where('instructor_id', $instructor->id)
            ->orderBy('created_at', 'desc')
            ->withCount('segment')->paginate(5);            
            $totalCourseFee = Payment::where('instructor_id', $instructor->id)->sum('amount');
            $subscriptions = Subscription::where('instructor_id', $instructor->id)->first();
            if ($subscriptions && $subscriptions->subscriptionPlan) {
                $imageUrl = $subscriptions->subscriptionPlan->image; 
            } else {
                $imageUrl = null; 
            }
            $currentDate = now(); 
            return view('backend.instructorDashboard', compact('student','course','enrollments','course',
            'instructor','totalCourseFee','courseShow','subscriptions','imageUrl','currentDate')); 
        }            
        else{
            return view('backend.dashboard', compact('student','course','enrollments','course'));  
        }
                  
    }


    public function testDashboard() 
    {
        return view('backend.test-dashboard');
    }
}
