<?php

namespace App\Http\Controllers\backend\courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Material;
use App\Models\Instructor;


class CourseReviewController extends Controller
{
    //

    public function review($id)
    {
        $id = encryptor('decrypt', $id);

        $course = Course::with([
            'courseCategory',
            'instructor',
            'segments.lessons.materials'
        ])->findOrFail($id);        

        return view('backend.course.courses.review', compact('course'));
    }

    public function materialPreview($id)
    {
        $material = Material::findOrFail($id);

        return response()->json([
            'id' => $material->id,
            'type' => $material->type,
            'title' => $material->title,

            // FILE BASED (video/audio)
            'file_url' => $material->content
                ? asset('uploads/courses/contents/' . $material->content)
                : null,

            // TEXT BASED
            'html' => $material->content_data
        ]);
    }

    public function activate(Request $request)
    {
            $course = Course::findOrFail($request->course_id);
            $courseTitle = $course->title_en;
            $instructorId = $course->instructor_id;
            $instructor = Instructor::where('id', $instructorId)->first();
            $instructorName = $instructor->name_en;

            // YOUR RULE: approve = 2
            $course->status = 2;
            $course->save();

            if (auth()->check()) {
                \App\Models\LogActivity::create([
                    'user_id' => auth()->id(),
                    'ip_address' => request()->ip(),
                    'activity' => 'Course-' . $courseTitle . ' Created by ' . $instructorName . ' approved by ' . auth()->user()->name_en,
                    'activity_date' => now(),
                ]);
            }

            return response()->json([
                'success' => true
            ]);
    }    

    public function reject(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $courseTitle = $course->title_en;
        $instructorId = $course->instructor_id;
        $instructor = Instructor::where('id', $instructorId)->first();
        $instructorName = $instructor->name_en;

        $course->status = 1; // rejected
        $course->rejection_reason = $request->reason; // NEW FIELD
        $course->save();

        if (auth()->check()) {
                \App\Models\LogActivity::create([
                    'user_id' => auth()->id(),
                    'ip_address' => request()->ip(),
                    'activity' => 'Course-' . $courseTitle . ' Created by ' . $instructorName . ' rejected by ' . auth()->user()->name_en,
                    'activity_date' => now(),
                ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

}
