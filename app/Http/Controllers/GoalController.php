<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Goal;
use Illuminate\Support\Facades\Log;

class GoalController extends Controller
{
    public function index()
    {
        $studentId = currentUserId();

        $student = Student::findOrFail($studentId);

        $enrollments = Enrollment::where('student_id', $student->id)
            ->with('course')
            ->get();

        $totalCourses = $enrollments->count();

        $completedCourses = $enrollments
            ->where('progress', '>=', 100)
            ->count();

        $activeCourses = $totalCourses - $completedCourses;

        $goals = Goal::where('student_id', $studentId)
            ->latest()
            ->get();

        $totalGoals = $goals->count();

        $completedGoals = $goals
            ->where('status', 'completed')
            ->count();

        $activeGoals = $goals
            ->where('status', 'in_progress')
            ->count();

        $pendingGoals = $goals
            ->where('status', 'not_started')
            ->count();

        return view(
            'students.goals',
            compact(
                'student',
                'goals',
                'totalCourses',
                'completedCourses',
                'activeCourses',
                'totalGoals',
                'completedGoals',
                'activeGoals',
                'pendingGoals'
            )
        );
    }

    public function store(Request $request)
    {
        Log::info('GOAL STORE HIT', [
            'user_id' => auth()->id(),
            'request_data' => $request->all()
        ]);

        $studentId = currentUserId();

        $student = Student::findOrFail($studentId);

        try {

            $request->validate([
                'title' => 'required|string|max:255',
                'goal_type' => 'required|string',
                'target_value' => 'required|integer|min:1',
                'target_date' => 'required|date|after_or_equal:today',
                'description' => 'nullable|string',
            ]);

            $goal = Goal::create([
                'student_id' => $studentId,
                'title' => $request->title,
                'goal_type' => $request->goal_type,
                'target_value' => $request->target_value,
                'target_date' => $request->target_date,
                'description' => $request->description,
            ]);

            Log::info('GOAL CREATED SUCCESSFULLY', [
                'goal_id' => $goal->id,
                'goal' => $goal
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Goal created successfully',
                'goal' => $goal
            ]);

        } catch (\Exception $e) {

            Log::error('GOAL STORE FAILED', [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Server error occurred'
            ], 500);
        }
        

    }

    public function edit($id)
    {
        $studentId = currentUserId();
        $goal = Goal::where('student_id', $studentId)
                    ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'goal' => $goal
        ]);
    }

    public function update(Request $request, $id)
    {
        $studentId = currentUserId();
        $goal = Goal::where('student_id', $studentId)
                    ->findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'goal_type' => 'required|string',
            'target_value' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'target_date' => 'nullable|date', // 🔥 important
        ]);

        // 🔥 ONLY update date if provided
        if ($request->filled('target_date')) {
            $data['target_date'] = $request->target_date;
        } else {
            unset($data['target_date']);
        }

        $goal->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Goal updated successfully',
            'goal' => $goal
        ]);
    }

    public function destroy($id)
    {
        $studentId = currentUserId();
        $goal = Goal::where('id', $id)
            ->where('student_id', $studentId)
            ->firstOrFail();

        $goal->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Goal deleted successfully'
        ]);
    }

}
