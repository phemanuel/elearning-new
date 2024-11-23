<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Subscription;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRoleId = auth()->user()->role_id;
        if ($userRoleId == 1) {
            $enrollment = Enrollment::get();

            return view('backend.enrollment.index', compact('enrollment'));
        }
        elseif ($userRoleId == 3) {
            $instructorId = auth()->user()->instructor_id;
            //----check if the instructor is on a plan--
            $existingPlan= Subscription::where('instructor_id', $instructorId )->first();
            if (!$existingPlan) {
                return redirect()->back()->with('error', 'Access denied, because you do not have an active subscription plan.');
            }
            //---check if the plan is still valid
            $currentDate = now(); 
            $dueDate = $existingPlan->end_date; 

            if ($currentDate > $dueDate) {
                return redirect()->back()->with('error', 'Your subscription plan has expired.');
            }   

            $enrollment = Enrollment::where('instructor_id', '=', $instructorId)
            ->get();

            return view('backend.enrollment.index', compact('enrollment'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = auth()->user();
        if($user){
            $data = Student::paginate(20);
            $course = Course::where('instructor_id', $user->instructor_id)->get();
        return view('backend.enrollment.view', compact('data','course'));
        }       
        return redirect()->route('logOut');

        //return redirect()->back()->with('error', 'This feature is not available. Please try again later.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}
