<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectSubmission;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Exception;
use File;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function index()
    {
        $userRoleId = auth()->user()->role_id;
        
        if ($userRoleId == 1) {
            // Admin can view all quizzes with their segments and question count
            $project = Project::withCount(['submissions as pending_submissions' => function ($query) {
                $query->where('project_status', 'pending');
            }])
            ->paginate(10);

            return view('backend.project.index', compact('project'));
        } elseif ($userRoleId == 3) {
            // Instructor can view only their quizzes with their segments and question count
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

            $project = Project::where('instructor_id', $instructorId)
            ->withCount(['submissions as pending_submissions' => function ($query) {
                $query->where('project_status', 'pending');
            }])
            ->paginate(10);

            return view('backend.project.index', compact('project'));
        }
    }

    public function create()
    {
        $instructorId = auth()->user()->instructor_id;
        $course = Course::where('instructor_id', $instructorId)->get();
        return view('backend.project.create', compact('course'));
    }

    public function store(Request $request)
    {
        try {
            // check if quiz is enabled for the segment---
            $projectEnabled = Course::where('id', $request->courseId)->first();
            if($projectEnabled->project == 0){
                return redirect()->back()->with('error', 'Project is not enabled for this course.');
            }
            // Check if a quiz already exists for the selected course and segment by the instructor
            $existingProject = Project::where('course_id', $request->courseId)
                ->where('instructor_id', auth()->user()->instructor_id)
                ->first();

            // If a quiz already exists, return with an error message
            if ($existingProject) {
                return redirect()->back()->withInput()->with('error', 'A project already exists for the selected course.');
            }

            // If no existing quiz, proceed to create a new one
            $project = new project;
            $project->course_id = $request->courseId;
            $project->course_title = $projectEnabled->title_en;
            $project->project_content = $request->projectContent;
            $project->additional_info = $request->additionalInfo;
            $project->instructor_id = auth()->user()->instructor_id;

            if ($project->save()) {
                $this->notice::success('Data Saved');
                return redirect()->route('project.index');
            } else {
                $this->notice::error('Please try again');
                return redirect()->back()->withInput();
            }
        } catch (Exception $e) {
            // Handle the exception and display the error
            dd($e); // You can replace this with a proper logging mechanism
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $instructorId = auth()->user()->instructor_id;
        $course = Course::where('instructor_id', $instructorId)->get();
        $project = Project::findOrFail(encryptor('decrypt', $id));        

        return view('backend.project.edit', compact('course', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $project = Project::findOrFail(encryptor('decrypt', $id));  
            $course = Course::where('id', $request->courseId)->first; 

            $project->course_id = $request->courseId;
            $project->course_title = $course->title_en;
            $project->project_content = $request->projectContent;
            $project->additional_info = $request->additionalInfo;
            $project->instructor_id = auth()->user()->instructor_id;

            if ($project->save()) {
                $this->notice::success('Data Saved');
                return redirect()->route('project.index');
            } else {
                $this->notice::error('Please try again');
                return redirect()->back()->withInput();
            }
        } catch (Exception $e) {
            dd($e);
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Project::findOrFail(encryptor('decrypt', $id));
        if ($data->delete()) {
            $this->notice::error('Data Deleted!');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $courseId = encryptor('decrypt', $id);

        // Get pending project submissions for this course
        $projectSubmissions = ProjectSubmission::where('course_id', $courseId)
        ->where('project_status', 'pending')
        ->with('student') 
        ->latest('created_at')
        ->get();

        return view('backend.project.project-submission', compact('projectSubmissions'));
    }

    public function reviewUpdate(Request $request)
    {
        Log::info("Review Update Request: " . json_encode($request->all())); // Log request data

        $request->validate([
            'id' => 'required|exists:project_submissions,id',
            'comment' => 'nullable|string',
            'status' => 'required|in:reviewed,approved',
        ]);

        // Find the project submission
        $submission = ProjectSubmission::findOrFail($request->id);

        // Update fields
        $submission->comment = $request->comment;
        $submission->project_status = $request->status;
        $submission->save();

        return response()->json(['success' => true, 'message' => 'Project reviewed successfully']);
    }


}
