<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
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
            // Fetch the subscription plan details
            $subscriptionPlan = SubscriptionPlan::where('id', $existingPlan->plan_id)->first();

            if (!$subscriptionPlan) {
                return redirect()->back()->with('error', 'Invalid subscription plan.');
            }

            // Check if the instructor is on a free plan
            if ($subscriptionPlan->amount > 0) {  
                $currentDate = now();
                $dueDate = $existingPlan->end_date;

                if ($currentDate > $dueDate) {
                    return redirect()->back()->with('error', 'Your subscription plan has expired.');
                }
            }      

            $enrollment = Enrollment::where('instructor_id', '=', $instructorId)
            ->get();            
            //---Check if the subscription plan can allow the instructor to add courses--
            $instructorNew = Instructor::where('id', $user->instructor_id)->first();
            $currentPlan = $instructorNew->current_plan ;
            //Get the current plan variables
            $subPlan = SubscriptionPlan::where('id', $currentPlan)->first();
            $noOfStudent = $subPlan->student_upload;
            //Get the current no of student that has enrolled
            $noOfStudentEnrolled = Enrollment::where('instructor_id', $instructorId)->count();

            return view('backend.enrollment.index', compact('enrollment', 'noOfStudentEnrolled', 'noOfStudent'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user) {
            $instructorId = $user->instructor_id;

            // Fetch students and their enrollments specific to the instructor
            $data = Student::with(['enrollments.course' => function ($query) use ($instructorId) {
                $query->where('instructor_id', $instructorId);
            }])->paginate(20);            

            $course = Course::where('instructor_id', $instructorId)
                ->where('status', 2)
                ->get();

            $instructorNew = Instructor::where('id', $user->instructor_id)->first();
            $currentPlan = $instructorNew->current_plan;

            $subPlan = SubscriptionPlan::where('id', $currentPlan)->first();
            $noOfStudent = $subPlan->student_upload;

            $noOfStudentEnrolled = Enrollment::where('instructor_id', $instructorId)->count();

            if ($noOfStudent > $noOfStudentEnrolled) {
                return view('backend.enrollment.view', compact('data', 'course'));
            } elseif ($noOfStudent == $noOfStudentEnrolled) {
                return redirect()->back()->with('error', 'You have reached the maximum number of students to enroll.');
            }
        }
        return redirect()->route('studentlogOut');
    }

    public function enroll(Request $request)
    {
        \Log::info('Enrollment Request Data:', $request->all());

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);
    
        \Log::info('Validated Data:', $validated);
        // Check if the enrollment already exists
        $exists = DB::table('enrollments')->where([
            'student_id' => $validated['student_id'],
            'course_id' => $validated['course_id'],
            'instructor_id' => $validated['instructor_id'],
        ])->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Student has already been enrolled for this course.']);
        }

        // Create the enrollment record
        DB::table('enrollments')->insert([
            'student_id' => $validated['student_id'],
            'course_id' => $validated['course_id'],
            'instructor_id' => $validated['instructor_id'],
            'segment' => 1,
            'completed' => 0,
            'enrollment_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $course = Course::where('id', $validated['course_id'])->first();
        $year = date('Y');
        $month = date('m');
        $day = date('d');        
        $randomChars = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

        // Generate the transaction reference
        $transactionRef = "KDH" . $year . $month . $day . $randomChars;
        // Create the payment record
        DB::table('payments')->insert([
            'student_id' => $validated['student_id'],
            'course_id' => $validated['course_id'],
            'instructor_id' => $validated['instructor_id'],
            'currency' => "NAIRA",
            'currency_code' => $course->currency_type,
            'currency_value' => 1,
            'txnid' =>  $transactionRef,
            'amount' => $course->price,
            'method' => "Manual",
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Enrollment created successfully.']);
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
