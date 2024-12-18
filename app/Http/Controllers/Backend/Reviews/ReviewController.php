<?php

namespace App\Http\Controllers\Backend\Reviews;

use App\Models\Review;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review=Review::paginate(20);
        return view('backend.review.index', compact('review'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
    }
    
    public function saveReviews(Request $request)
    {
        try {
            $studentId = (int) $request->input('student_id');
            $courseId = (int) $request->input('course_id');

            // Merge the casted data back into the request
            $request->merge([
                'student_id' => $studentId,
                'course_id' => $courseId
            ]);
            // Validate the input to ensure both student_id and course_id exist
            $request->validate([
                'comment' => 'required|string|max:1000',
                'student_id' => 'required|integer|exists:students,id',
                'course_id' => 'required|integer|exists:courses,id',
            ]);
    
            // Check if a review already exists for the given student and course
            $review = Review::where('student_id', $request->student_id)
                            ->where('course_id', $request->course_id)
                            ->first();
    
            if ($review) {
                // If a review already exists, update it
                $review->update([
                    'comment' => $request->comment,
                ]);
                $message = 'Review updated successfully';
            } else {
                // If no review exists, create a new one
                Review::create([
                    'student_id' => $request->student_id,
                    'course_id' => $request->course_id,
                    'comment' => $request->comment,
                ]);
                $message = 'Review posted successfully';
            }
    
            // Return a JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
            
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error storing review: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
                'user_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
    
            // Return an error response to the client
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request. Please try again later.',
            ], 500); // 500 Internal Server Error
        }
    }

    public function getReviews($courseId)
    {
        // Eager load the course with reviews count
        $course = Course::withCount('reviews')->find($courseId);

        // Check if course exists
        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found',
            ], 404);
        }

        // Fetch the reviews for the course
        $reviews = Review::where('course_id', $courseId)->latest()->get();

        // Render the reviews as HTML to return via AJAX
        $html = view('partials.reviews', compact('reviews'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $course->reviews_count,
        ]);
    }

    public function storeRating(Request $request)
    {
        // Validate input
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',           
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
        ]);

        // Store the review in the database
        $review = Review::updateOrCreate(
            ['course_id' => $request->course_id, 'student_id' => $request->student_id],
            ['rating' => $request->rating]
        );

        return response()->json(['success' => true, 
        'message' => 'Rating submitted successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
