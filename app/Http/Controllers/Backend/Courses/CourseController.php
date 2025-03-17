<?php

namespace App\Http\Controllers\Backend\Courses; 

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Course\Courses\AddNewRequest;
use App\Http\Requests\Backend\Course\Courses\UpdateRequest;
use App\Models\CourseCategory;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Segments;
use App\Models\Material;
use App\Models\Coupon;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Str;
use Exception;
use File; 
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$course = Course::paginate(10);
        $userRoleId = auth()->user()->role_id;
        $instructorId = auth()->user()->instructor_id;
        if($userRoleId == 1) {
            $course = Course::withCount('segment')->paginate(10);
            return view('backend.course.courses.index', compact('course'));
        }
        else {
            $course = Course::where('instructor_id', $instructorId)->withCount('segment')->paginate(10);
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

            $instructorNew = Instructor::where('id', $instructorId)->first();
            //---Check if the subscription plan can allow the instructor to add courses--
            $currentPlan = $instructorNew->current_plan ;
            $subPlan = SubscriptionPlan::where('id', $currentPlan)->first();
            $noOfCourses = $subPlan->course_upload;
            //Get the current no of courses upload by the instructor
            $noOfCoursesInstructor = Course::where('instructor_id', $instructorId)->count();

            //---if there is an active plan.
            return view('backend.course.courses.index', compact('course', 'noOfCourses','noOfCoursesInstructor'));
        }        
        
    }

    public function indexForAdmin()
    {
        $course = Course::paginate(10);
        return view('backend.course.courses.indexForAdmin', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courseCategory = CourseCategory::get();
        $userRoleId = auth()->user()->role_id;
        $instructorId = auth()->user()->instructor_id;
        if($userRoleId == 1){
            $instructor = Instructor::get();
            return view('backend.course.courses.create', compact('courseCategory', 'instructor'));
        }
        else{
            $instructor = Instructor::where('id', $instructorId)->get();
            $instructorNew = Instructor::where('id', $instructorId)->first();
            //---Check if the subscription plan can allow the instructor to add courses--
            $currentPlan = $instructorNew->current_plan ;
            //Get the current plan variables
            $subPlan = SubscriptionPlan::where('id', $currentPlan)->first();
            $noOfCourses = $subPlan->course_upload;
            //Get the current no of courses upload by the instructor
            $noOfCoursesInstructor = Course::where('instructor_id', $instructorId)->count();

            if($noOfCourses > $noOfCoursesInstructor){
                return view('backend.course.courses.create', compact('courseCategory', 'instructor',));
            }
            elseif($noOfCourses == $noOfCoursesInstructor){
                return redirect()->back()->with('error', 'You have reached the maximum number of courses to add.');
            }    

        }       
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewRequest $request)
    {
        try {
            $course = new Course;
            $course->title_en = $request->courseTitle_en;
            $course->title_bn = $request->courseTitle_bn;
            $course->description_en = $request->courseDescription_en; 
            $course->description_bn = $request->courseDescription_bn;
            $course->course_category_id = $request->categoryId;
            $course->instructor_id = $request->instructorId;
            $course->type = $request->courseType;
            $course->currency_type = $request->currencyType;
            $course->price = $request->coursePrice;
            $course->old_price = $request->courseOldPrice;
            $course->subscription_price = $request->subscriptionPrice;
            $course->start_from = $request->start_from;
            $course->duration = $request->duration;
            $course->segment = $request->segment;
            $course->difficulty = $request->courseDifficulty;
            $course->course_code = $request->course_code;
            $course->prerequisites_en = $request->prerequisites_en;
            $course->prerequisites_bn = $request->prerequisites_bn;
            $course->thumbnail_video = $request->thumbnail_video;
            $course->tag = $request->tag; 
            $course->date_enabled = $request->dateEnabled;
            $courseUrl = Str::random(40);
            $course->course_url = $courseUrl;
            $course->language = 'en';

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/courses'), $imageName);
                $course->image = $imageName;
            }
            if ($request->hasFile('thumbnail_image')) {
                $thumbnailImageName = rand(111, 999) . time() . '.' . $request->thumbnail_image->extension();
                $request->thumbnail_image->move(public_path('uploads/courses/thumbnails'), $thumbnailImageName);
                $course->thumbnail_image = $thumbnailImageName;
            }
            if ($course->save()){
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'New Course Created by ' . auth()->user()->name_en,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('course.index')->with('success', 'Data Saved');
            }                
            else{
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }                
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 
        
    }

    public function frontShow($id)
    {
        $student = Student::find(currentUserId());
        //check if student exists
        if(!$student)   {
        $course = Course::findOrFail(encryptor('decrypt', $id));
        $courseId = $course->id;
        $courseCategoryId = $course->course_category_id;
        $instructorId = $course->instructor_id;
        
        $lesson = Lesson::where('course_id', $courseId)->get(); 
        $courseNo = Course::where('instructor_id', $instructorId)->get();
        $coupon = Coupon::where('course_id', $courseId)->first();
        
        // Exclude the current course from related courses
        $relatedCourse = Course::where('course_category_id', $courseCategoryId)
            ->where('id', '!=', $courseId) // Exclude the current course
            ->get();
        //Get the subscription plan the current course is subscribed to----
        $instructor = Instructor::where('id', $instructorId)->first();
        $subPlan = SubscriptionPlan::where('id', $instructor->current_plan)->first();
        
        return view('frontend.courseDetails', compact('course','lesson',
        'courseNo','coupon','relatedCourse','subPlan'));
        } 
        else{
            $course = Course::findOrFail(encryptor('decrypt', $id));
            $courseId = $course->id;
            $courseCategoryId = $course->course_category_id;
            $instructorId = $course->instructor_id;
            $lesson = Lesson::where('course_id', $courseId)->get(); 
            $courseNo = Course::where('instructor_id', $instructorId)->get();
            $coupon = Coupon::where('course_id', $courseId)->first();
        
            // Exclude the current course from related courses
            $relatedCourse = Course::where('course_category_id', $courseCategoryId)
            ->where('id', '!=', $courseId) // Exclude the current course
            ->get();
            $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $courseId)->first();
            //Get the subscription plan the current course is subscribed to----
            $instructor = Instructor::where('id', $instructorId)->first();
            $subPlan = SubscriptionPlan::where('id', $instructor->current_plan)->first();

            if($enrollment){                
                return redirect()->route('studentdashboard')->with('error', 'You have already enrolled for this course.');
            }
            else{                               
                return view('frontend.courseDetails', compact('course','lesson','courseNo','coupon',
                'relatedCourse','subPlan'));
            }
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {    
        $course = Course::findOrFail(encryptor('decrypt', $id));
        $instructorId = $course->instructor_id;
        $courseCategory = CourseCategory::get();
        $instructor = Instructor::where('id', $instructorId)->get();
        
        return view('backend.course.courses.edit', compact('courseCategory', 'instructor', 'course'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $course = Course::findOrFail(encryptor('decrypt', $id));
            if ($request->has('start_from') && !empty($request->start_from)) {
                $course->start_from = $request->start_from; // Update if the date is chosen
            }
            $course->title_en = $request->courseTitle_en;
            $course->title_bn = $request->courseTitle_bn;
            $course->description_en = $request->courseDescription_en;
            $course->description_bn = $request->courseDescription_bn;
            $course->course_category_id = $request->categoryId;
            $course->instructor_id = $request->instructorId;
            $course->type = $request->courseType;
            $course->currency_type = $request->currencyType;
            $course->price = $request->coursePrice;
            $course->old_price = $request->courseOldPrice; 
            $course->subscription_price = $request->subscription_price;
            $course->duration = $request->duration;
            $course->segment = $request->segment;
            $course->difficulty = $request->courseDifficulty;
            $course->course_code = $request->course_code;
            $course->prerequisites_en = $request->prerequisites_en;
            $course->prerequisites_bn = $request->prerequisites_bn;
            $course->thumbnail_video = $request->thumbnail_video;
            $course->tag = $request->tag;
            $course->date_enabled = $request->dateEnabled;
            $course->language = 'en';

            // Generate course URL if not present
            if (empty($course->course_url)) {
                $course->course_url = Str::random(40);
            }

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/courses'), $imageName);
                $course->image = $imageName;
            }
            if ($request->hasFile('thumbnail_image')) {
                $thumbnailImageName = rand(111, 999) . time() . '.' . $request->thumbnail_image->extension();
                $request->thumbnail_image->move(public_path('uploads/courses/thumbnails'), $thumbnailImageName);
                $course->thumbnail_image = $thumbnailImageName;
            }
            if ($course->save()){
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'Course updated by ' . auth()->user()->name_en,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('course.index')->with('success', 'Data Saved');
            }                
            else{
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }                
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    public function updateforAdmin(UpdateRequest $request, $id)
    {
        try {
            $course = Course::findOrFail(encryptor('decrypt', $id));
            if ($request->has('start_from') && !empty($request->start_from)) {
                $course->start_from = $request->start_from; // Update if the date is chosen
            }
            $course->title_en = $request->courseTitle_en;
            $course->title_bn = $request->courseTitle_bn;
            $course->description_en = $request->courseDescription_en;
            $course->description_bn = $request->courseDescription_bn;
            $course->course_category_id = $request->categoryId;
            $course->instructor_id = $request->instructorId;
            $course->type = $request->courseType;
            $course->currency_type = $request->currencyType;
            $course->price = $request->coursePrice;
            $course->old_price = $request->courseOldPrice; 
            $course->subscription_price = $request->subscription_price;
            $course->duration = $request->duration;
            $course->segment = $request->segment;
            $course->difficulty = $request->courseDifficulty;
            $course->course_code = $request->course_code;
            $course->prerequisites_en = $request->prerequisites_en;
            $course->prerequisites_bn = $request->prerequisites_bn;
            $course->thumbnail_video = $request->thumbnail_video;
            $course->tag = $request->tag;
            $course->status = $request->status;
            $course->language = 'en';

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/courses'), $imageName);
                $course->image = $imageName;
            }
            if ($request->hasFile('thumbnail_image')) {
                $thumbnailImageName = rand(111, 999) . time() . '.' . $request->thumbnail_image->extension();
                $request->thumbnail_image->move(public_path('uploads/courses/thumbnails'), $thumbnailImageName);
                $course->thumbnail_image = $thumbnailImageName;
            }
            if ($course->save()){
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'Course updated by ' . auth()->user()->name_en,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('courseList')->with('success', 'Data Saved');
            }                
            else{
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }                
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    public function getSegments($courseId)
    {
        try {
            // Log the incoming request
            //Log::info('Fetching segments for course', ['course_id' => $courseId]);

            // Fetch segments
            $segments = Segments::where('course_id', $courseId)->get(['id', 'title_en']);

            // Log the retrieved segments
            // if ($segments->isEmpty()) {
            //     Log::info('No segments found for course', ['course_id' => $courseId]);
            // } else {
            //     Log::info('Segments found', ['course_id' => $courseId, 'segments' => $segments]);
            // }
            //\Log::info('Returning segments as JSON', ['segments' => $segments]);

            return response()->json($segments);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error fetching segments for course', ['course_id' => $courseId, 'error' => $e->getMessage()]);
            
            // Return a JSON error response
            return response()->json(['error' => 'Failed to retrieve segments'], 500);
        }
    }

    public function courseFee()
    {
        // Fetch all payments and their related courses and instructors
        $userRoleId = auth()->user()->role_id;
        if ($userRoleId == 1) {
            $payments = Payment::with(['student', 'course', 'course.instructor'])
            ->orderBy('created_at')
            ->get();

            return view('backend.course.courses.course-fees', compact('payments'));
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

            $payments = Payment::where('instructor_id', '=', $instructorId)
            ->with(['student', 'course', 'course.instructor'])
            ->orderBy('created_at')
            ->get();

            return view('backend.course.courses.course-fees', compact('payments'));
        }               
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Course::findOrFail(encryptor('decrypt', $id));
        $image_path = public_path('uploads/courses') . $data->image;

        if ($data->delete()) {
            if (auth()->check()) {
                \App\Models\LogActivity::create([
                    'user_id' => auth()->id(),
                    'ip_address' => request()->ip(),
                    'activity' => 'Course Deleted by ' . auth()->user()->name_en,
                    'activity_date' => now(),
                ]);
            }

            if (File::exists($image_path))
                File::delete($image_path);

            return redirect()->back();
        }
    }
}
