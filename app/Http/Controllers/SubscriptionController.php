<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Instructor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $instructorPlan = Instructor::where('current_plan', '!=' , 0)
        ->paginate(10);        
        return view('backend.subscription.subscription', compact('instructorPlan'));
        
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $instructor = Instructor::with('subscriptionPlan')->get();
        $subscriptionPlan = SubscriptionPlan::all();
        return view('backend.subscription.subscription-create', compact('instructor','subscriptionPlan'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $instructorId = $request->input('instructor_id');
        $planId = $request->input("subscriptionPlan.$instructorId");
        $duration = $request->input("subscriptionDuration.$instructorId");

        if (!$planId || !$duration) {
            return back()->with('error', 'Please select a valid subscription plan and duration.');
        }

        // Check if the instructor already has a subscription for the selected plan
        $existingSubscription = Subscription::where('instructor_id', $instructorId)
            ->where('plan_id', $planId)
            ->first();

        if ($existingSubscription) {
            return back()->with('error', 'Instructor is already subscribed to this plan. Please upgrade.');
        }

        // Fetch the amount for the selected plan
        $plan = SubscriptionPlan::find($planId);

        if (!$plan) {
            return back()->with('error', 'Selected subscription plan does not exist.');
        }

        $amount = $plan->amount; // Assuming the 'amount' column exists in the subscription_plans table
        $totalAmount = $amount * $duration;

        // Calculate subscription dates
        $startDate = now();
        $endDate = $startDate->copy()->addMonths($duration);

        // Create the subscription record
        Subscription::create([
            'instructor_id' => $instructorId,
            'plan_id' => $planId,
            'no_of_months' => $duration,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_amount' => $totalAmount,
            'status' => 'Active',
        ]);

        // Update the current_plan attribute in the instructor table
        $instructor = Instructor::find($instructorId);
        if ($instructor) {
            $instructor->current_plan = $planId;
            $instructor->save();
        }

        return back()->with('success', 'Subscription added and current plan updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
