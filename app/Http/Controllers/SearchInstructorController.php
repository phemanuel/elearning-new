<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseCategory;
use App\Models\Instructor;
use Illuminate\Http\Request;

class SearchInstructorController extends Controller
{
    //

    public function index(Request $request)
    {
        // Retrieve all categories
        $categories = CourseCategory::all();

        // Retrieve selected categories and difficulties from the request
        $selectedCategories = $request->input('categories', []);
        $selectedDifficulty = $request->input('difficulty', []);

        // If no categories are selected (i.e., "All" is checked), use an empty array
        $applyCategoryFilter = !empty($selectedCategories) && $selectedCategories[0] != '';

        // Retrieve only instructors with active courses
        $allInstructors = Instructor::where('status', 1)
            ->whereHas('courses', function ($query) {
                $query->where('status', 2); // Active courses only
            })
            ->withCount(['courses as total_courses' => function ($query) {
                $query->where('status', 2);
            }])
            ->get();

        // Filter instructors based on selected categories and difficulty
        $instructors = Instructor::where('status', 1)
            ->whereHas('courses', function ($query) use ($selectedCategories, $selectedDifficulty, $applyCategoryFilter) {
                $query->where('status', 2)
                    ->when($applyCategoryFilter, function ($query) use ($selectedCategories) {
                        $query->whereIn('course_category_id', $selectedCategories);
                    })
                    ->when($selectedDifficulty, function ($query) use ($selectedDifficulty) {
                        $query->whereIn('difficulty', $selectedDifficulty);
                    });
            })
            ->withCount(['courses as total_courses' => function ($query) use ($selectedCategories, $selectedDifficulty, $applyCategoryFilter) {
                $query->where('status', 2)
                    ->when($applyCategoryFilter, function ($query) use ($selectedCategories) {
                        $query->whereIn('course_category_id', $selectedCategories);
                    })
                    ->when($selectedDifficulty, function ($query) use ($selectedDifficulty) {
                        $query->whereIn('difficulty', $selectedDifficulty);
                    });
            }])
            ->paginate(10);

        // Retrieve difficulty-specific instructors
        $difficulty_beginner = Instructor::whereHas('courses', function ($query) {
            $query->where('difficulty', 'Beginner')->where('status', 2);
        })->get();

        $difficulty_intermediate = Instructor::whereHas('courses', function ($query) {
            $query->where('difficulty', 'Intermediate')->where('status', 2);
        })->get();

        $difficulty_advanced = Instructor::whereHas('courses', function ($query) {
            $query->where('difficulty', 'Advanced')->where('status', 2);
        })->get();

        // Return view with all variables
        return view('frontend.searchInstructor', compact(
            'categories',
            'selectedCategories',
            'selectedDifficulty',
            'allInstructors',
            'instructors',
            'difficulty_beginner',
            'difficulty_intermediate',
            'difficulty_advanced'
        ));
    }

    public function instructorCourse($id)
    {
        $instructorId = encryptor('decrypt', $id);

        // Filter instructors based on selected categories and difficulty
        $course = Course::where('status', 2)
        ->where('instructor_id', $instructorId)
        ->withCount('lesson') 
        ->paginate(10); 

        $allCourse = Course::where('status', 2)
        ->where('instructor_id', $instructorId)
        ->withCount('lesson')
        ->get();  

        $instructor = Instructor::where('id', $instructorId)->first();

        return view('frontend.instructorCourse', compact('course', 'allCourse', 'instructor'));

    }    

}
