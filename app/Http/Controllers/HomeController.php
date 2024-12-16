<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Event;
use App\Models\Instructor;
use App\Models\CourseCategory;
use App\Models\Student;
use App\Models\ContactSales;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve all courses with segments and lessons
        $course = Course::with(
            'segments', 
            'lessons',
        )->get();

        $student = Student::find(currentUserId());
        // Check enrollment status for each course
            // $enrollmentStatus = [];
            // if ($student) {
            //     foreach ($courses as $course) {
            //         $enrollmentStatus[$course->id] = $student->enrollments()->where('course_id', $course->id)->exists();
            //     }
            // }
        
        // Retrieve events ordered by date
        $event = Event::orderBy('date', 'Desc')->get();

        // Retrieve all instructors
        $instructor = Instructor::get();

        // Retrieve all course categories
        $category = CourseCategory::get();

        // Retrieve popular courses with segments and lessons
        $popularCourses = Course::withCount('segments','lessons') // Eager load segment count
        ->where('tag', 'popular')
        ->where('status', 2)
        ->get();

        // Design category courses
        $designCategories = CourseCategory::whereIn('category_name', ['Graphics Design', 'Web Design', 'Video Editing'])->pluck('id')->toArray();
        $designCourses = Course::with(['segments', 'lessons'])
            ->whereIn('course_category_id', $designCategories)
            ->where('tag', 'popular')
            ->where('status', 2)
            ->get();

        // Development category courses
        $developmentCategories = CourseCategory::whereIn('category_name', ['Web Development', 'Mobile Development', 'Game Development', 'Database Design & Development'])->pluck('id')->toArray();
        $developmentCourses = Course::with(['segments', 'lessons'])
            ->whereIn('course_category_id', $developmentCategories)
            ->where('tag', 'popular')
            ->where('status', 2)
            ->get();

        // Data category courses
        $dataCategories = CourseCategory::whereIn('category_name', ['Data Science'])->pluck('id')->toArray();
        $dataCourses = Course::with(['segments', 'lessons'])
            ->whereIn('course_category_id', $dataCategories)
            ->where('tag', 'popular')
            ->where('status', 2)
            ->get();

        // Sales category courses
        $salesCategories = CourseCategory::whereIn('category_name', ['Digital Marketing', 'Social Media Manager', 'Content Creation', 'Social Media Marketing', 'Copywriting', 'Sales and Marketing'])->pluck('id')->toArray();
        $salesCourses = Course::with(['segments', 'lessons'])
            ->whereIn('course_category_id', $salesCategories)
            ->where('tag', 'popular')
            ->where('status', 2)
            ->get();

        // Business category courses
        $businessCategories = CourseCategory::whereIn('category_name', ['Digital Marketing', 'Entrepreneurship'])->pluck('id')->toArray();
        $businessCourses = Course::with(['segments', 'lessons'])
            ->whereIn('course_category_id', $businessCategories)
            ->where('tag', 'popular')
            ->where('status', 2)
            ->get();

        // IT category courses
        $itCategories = CourseCategory::whereIn('category_name', ['Hardware', 'Network Technology', 'Software & Security', 'Operating System & Server', '2D Animation', '3D Animation'])->pluck('id')->toArray();
        $itCourses = Course::with(['segments', 'lessons'])
            ->whereIn('course_category_id', $itCategories)
            ->where('tag', 'popular')
            ->where('status', 2)
            ->get();

        // Return the view with all the necessary data
        return view(
            'frontend.home',
            compact(
                'course', 
                'instructor', 
                'category', 
                'popularCourses', 
                'designCourses', 
                'developmentCourses', 
                'businessCourses', 
                'itCourses', 
                'salesCourses', 
                'dataCourses', 
                'event',
                // 'enrollmentStatus'
            )
        );
    }


    public function signUpForm()
    {
        return view('frontend.signup');
    }

    public function about()
    {
        $instructor = Instructor::where('status', 1)->get();

        return view('frontend.about', compact('instructor'));
    }
    public function contact()
    {
        $instructor = Instructor::get();

        return view('frontend.contact', compact('instructor'));
    }

    public function contactSales()
    {
        return view('frontend.contact-sales');
    }

    public function contactSalesAction(Request $request)
    {        
        try {
            // Validate input
            $request->validate([
                'fullName'      => 'required|string|max:255',
                'email'         => 'required|email|max:255',
                'noOfCourse'    => 'required|integer|min:1',
                'noOfStudent'   => 'required|integer|min:1',
                'storageSpace'  => 'required|integer|min:1',
                'addInfo'       => 'nullable|string|max:1000',
            ]);

            // Save to DB
            ContactSales::create([
                'name'      => $request->input('fullName'),
                'email'          => $request->input('email'),
                'no_of_course'  => $request->input('noOfCourse'),
                'no_of_student' => $request->input('noOfStudent'),
                'storage_space'  => $request->input('storageSpace'),
                'additional_information'=> $request->input('addInfo'),
            ]);

            // Redirect with success message
            return view('frontend.contact-sales-message');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Contact Sales Submission Error: ', [
                'message' => $e->getMessage(),
                'input'   => $request->all(),
            ]);

            // Redirect with error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function contactAction(Request $request)
    {        
        try {
            // Validate input
            $request->validate([
                'fullName'      => 'required|string|max:255',
                'email'         => 'required|email|max:255',
                'subject'       => 'required|string|max:1000',               
                'message'       => 'required|string|max:1000',
            ]);

            // Save to DB
            Contact::create([
                'name'      => $request->input('fullName'),
                'email'          => $request->input('email'),
                'subject'  => $request->input('subject'),
                'message' => $request->input('message'),
            ]);

            // Redirect with success message
            return redirect()->back()->with('success', 'Your message has been sent successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Contact Submission Error: ', [
                'message' => $e->getMessage(),
                'input'   => $request->all(),
            ]);

            // Redirect with error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function customPlan()
    {
        $customPlan = ContactSales::latest()->paginate(10);

        return view('backend.report.customPlan', compact('customPlan'));
    }

    public function contactReport()
    {
        $contact = Contact::latest()->paginate(10);

        return view('backend.report.contactReport', compact('contact'));
    }
}
