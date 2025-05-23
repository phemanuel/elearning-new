<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Material;
use App\Models\Progress;
use App\Models\ProgressAll;
use App\Models\Segments;
use App\Models\Enrollment;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Project;
use App\Models\ProjectSubmission;

class WatchCourseController extends Controller
{
    public function watchCourse($id)
    {
        // Get the authenticated student's ID
        $studentId = currentUserId();     

        //Get segment no
        $segment = Segments::where('id' , encryptor('decrypt',$id))->first();
        // Count the total number of segments in the course
        $totalCourseSegment = Segments::where('course_id', $segment->course_id)->count();
        $segmentNo = $segment->segment_no;
        $courseId = $segment->course_id;
        $totalSegment = Segments::where('course_id',$courseId)->count();
        $enrollment = Enrollment::where('course_id',$courseId)
        ->where('student_id',$studentId)->first();

        if ($segmentNo == 1){
            $previousSegment = $segmentNo;
        }
        else{
            $previousSegment = $segmentNo - 1;
        }

        $course = Course::findOrFail($courseId);
        $instructorId = $course->instructor_id;
        $lessons = Lesson::where('segments_id', $segment->id)->with('material')->get();
        $lessonCount = $lessons->count();
        $lessonsFirst = Lesson::where('segments_id', $segment->id)->first();
        $materialFirst = Material::where('lesson_id', $lessonsFirst->id)->first();
        $courseNo = Course::where('instructor_id', $instructorId)->get();   

        //Get student segmentno for the course
        $stdSegment = Enrollment::where('student_id', $studentId)
        ->where('course_id', $courseId)
        ->first();
        $stdSegmentNo = $stdSegment->segment;
        
        //Check if student has completed a segment before proceeding to the next one
        if ($segmentNo > $stdSegmentNo ) {
            return redirect()->back()->with('error', 'You have not completed segment ' . $previousSegment);
        }

        //---get quiz for segment of a particular course if available
        $quiz= Quiz::where('course_id', $courseId)
        ->where('segment_id', $segment->id)
        ->first();

        if(!$quiz){
            return redirect()->back()->with('error', 'Quiz not found for the next segment');
        }
        // Check if progress record exists for the student and course
        $progress = Progress::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('segments_id', $segment->id)
            ->first();

        if ($progress) {
            // Progress record exists, get the last viewed material and last viewed time
            $lastViewedMaterial = $progress->last_viewed_material_id ? Material::find($progress->last_viewed_material_id) : null;
            $lastViewedAt = $progress->last_viewed_at;
            $lastviewedLesson = $progress->last_viewed_lesson_id;  
            $currentLesson = Lesson::where('segments_id', $segment->id)
            ->where('id', $lastviewedLesson)
            ->first();
            $currentMaterial = Material::where('lesson_id', $currentLesson->id)->first();  
            $lastViewedLessonId = $lastviewedLesson;
            $lastViewedMaterialId = $currentMaterial->id;     
        } else {
            // If no progress exists, initialize variables for the view
            $lastViewedMaterial = null; 
            $lastViewedAt = null; 
            $lastviewedLesson = null ;

            //Create a new ProgressAll record
            ProgressAll::Create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'progress_percentage' => 0, 
                'completed' => 1, 
                'material_id' => $materialFirst->id, 
                'lesson_id' => $lessonsFirst->id, 
                'last_viewed_at' => now(), 
                'segments_id' => $segment->id,
                'segment_no' => $segmentNo,
            ]);
            
            // Create a new progress record
            Progress::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'progress_percentage' => 0, 
                'completed' => 0, 
                'last_viewed_material_id' => $materialFirst->id, 
                'last_viewed_lesson_id' => $lessonsFirst->id, 
                'last_viewed_at' => now(), 
                'segments_id' => $segment->id,
                'segment_no' => $segmentNo,
                'quiz_attempt' => 0,
                'score' => 0,
            ]);           

            $progress = Progress::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('segments_id', $segment->id)
            ->first();

            $currentLesson = Lesson::where('segments_id', $segment->id)->first();
            $currentMaterial = Material::where('lesson_id', $lessonsFirst->id)->first();          
            
        }

        // Retrieve all progress records for this student and course
        $progressRecords = ProgressAll::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('segments_id', $segment->id)
            ->pluck('material_id') // Get the material IDs that have been clicked
            ->toArray();

        $segments = Segments::withCount('lesson')
            ->where('id', $segment->id)
            ->get();
        
            // Initialize an array to store progress percentages for each segment
        $segmentProgress = [];

        // Iterate through segments to calculate progress
        foreach ($segments as $segment) {
            // Get total lessons for the current segment
            $totalLessons = $segment->lesson_count; // Using withCount from Eloquent

            // Fetch completed lessons from ProgressAll model where the student and segment match
            $completedLessons = ProgressAll::where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->where('segments_id', $segment->id) // Ensure you're filtering by segment
                ->where('completed', 1) // Assuming 1 means completed
                ->count(); // Count the number of completed lessons

            // Avoid division by zero and calculate percentage
            $percentage = ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;

            // Store the percentage rounded to 2 decimal places
            $segmentProgress[$segment->id] = round($percentage, 2);
            //dd($totalLessons,$completedLessons,$segmentProgress);
        }
        
        $questions = Question::where('quiz_id', $quiz->id)->get();        
        // Continue with the course view, passing all necessary variables
        return view('frontend.watchCourse', compact(
            'course', 
            'lessons', 
            'courseNo', 
            'lastViewedMaterial', 
            'lastViewedAt', 
            'progressRecords','currentLesson','currentMaterial','progress','segment',
            'segmentProgress','studentId','courseId','quiz','questions','stdSegment','totalCourseSegment',
            'enrollment','lastViewedLessonId','lastViewedMaterialId','lessonCount'
        ));
    }

    public function watchCourseNext($id)
    {
        $decryptedId = encryptor('decrypt', $id);
        $studentId = currentUserId();

        // Get the current segment the student is in
        $stdSegment = Enrollment::where('student_id', $studentId)
            ->where('course_id', $decryptedId)
            ->first();

        // Count the total number of segments in the course
        $totalCourseSegment = Segments::where('course_id', $decryptedId)->count();
        // Get the next segment number
        $nextSegment = $stdSegment->segment;

        // Get the id for the next segment
        $nextSegmentData = Segments::where('course_id', $decryptedId)
            ->where('segment_no', $nextSegment)
            ->first();

        // Check if the next segment exists
        if (!$nextSegmentData) {
            return redirect()->back()->with('error', 'Next segment not found.');
        }
        // Check if the student is already in the last segment of the course
        if ($stdSegment->segment >= $totalCourseSegment) {
            return redirect()->route('watchCourse', encryptor('encrypt', $nextSegmentData->id))
            ->with('error', 'You are already in the last segment of the course');
        }        

        // Redirect to the next segment
        return redirect()->route('watchCourse', encryptor('encrypt', $nextSegmentData->id));
    }

    public function projectView($id)
    {
        $decryptedId = encryptor('decrypt', $id);
        $studentId = currentUserId();
        $courseId = $decryptedId;

        $project = Project::where('course_id', $decryptedId)->first();
        $projectId = $project->id;

        $allProjectSubmission = ProjectSubmission::where('course_id', $courseId)
        ->where('student_id', $studentId)
        ->orderBy('created_at', 'desc') // Orders by latest date
        ->get();

        $projectSubmission = ProjectSubmission::where('course_id', $courseId)
        ->where('student_id', $studentId)
        ->latest()
        ->first();

        if($projectSubmission){

            if($projectSubmission->project_status == 'Approved'){
                return redirect()->back()->with('error', 'Project has been submitted and approved.');
            }
        }        

        return view('frontend.project-layout', compact('project', 'studentId', 'courseId','projectId'
        ,'projectSubmission','allProjectSubmission'));
        
    }

    public function projectSubmission(Request $request, $id)
    {
        // Decrypt course ID
        $courseId = encryptor('decrypt', $id);
        $studentId = currentUserId();

        // Validate the request
        $request->validate([
            'project_link' => 'required|url', 
            'projectId' => 'required|exists:projects,id',
        ]);

        // Get the latest project submission
        $latestProjectSubmission = ProjectSubmission::where('course_id', $courseId)
            ->where('student_id', $studentId)
            ->latest()
            ->first();

        if ($latestProjectSubmission) {
            // If latest project is pending, do not allow submission
            if ($latestProjectSubmission->project_status === 'pending') {
                return redirect()->back()->with('info', 'Your last project submission is still under review. Please wait for feedback before submitting another.');
            }

            // If latest project is approved, do not allow submission
            if ($latestProjectSubmission->project_status === 'approved') {
                return redirect()->back()->with('success', 'Your project has been approved. You cannot submit another link.');
            }

            // If latest project is reviewed, allow a new submission
            if ($latestProjectSubmission->project_status === 'reviewed') {
                ProjectSubmission::create([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'project_id' => $request->projectId,
                    'project_link' => $request->project_link,
                    'comment' => null, 
                    'project_status' => 'pending', 
                ]);

                return redirect()->back()->with('success', 'Project submitted successfully and is pending review.');
            }
        } else {
            // If no previous submission, allow submission
            ProjectSubmission::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'project_id' => $request->projectId,
                'project_link' => $request->project_link,
                'comment' => null, 
                'project_status' => 'pending', 
            ]);

            return redirect()->back()->with('success', 'Project submitted successfully and is pending review.');
        }
    }



}
