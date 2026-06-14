<?php

namespace App\Http\Controllers\backend\courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Material;


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

        $course->update([
            'status' => 2,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Course activated successfully'
        ]);
    }

        public function reject(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'note' => 'required'
        ]);

        $course = Course::findOrFail($request->course_id);

        $course->update([
            'status' => 1,
            'review_note' => $request->note ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Course rejected successfully'
        ]);
    }

}
