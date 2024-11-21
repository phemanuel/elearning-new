<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
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
        }
        elseif ($userRoleId == 3) {
            $instructorId = auth()->user()->instructor_id;
            $enrollment = Enrollment::where('instructor_id', '=', $instructorId)
            ->get();
        }

        return view('backend.enrollment.index', compact('enrollment'));
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
