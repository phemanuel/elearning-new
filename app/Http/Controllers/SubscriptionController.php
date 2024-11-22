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
        $subscriptions = Subscription::with(['instructor', 'subscriptionPlan'])->paginate(10);
        return view('backend.subscription.subscription', compact('subscriptions'));
        
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

        // Fetch the instructor and plan
        $instructor = Instructor::find($instructorId);
        $plan = SubscriptionPlan::find($planId);

        if (!$instructor || !$plan) {
            return back()->with('error', 'Invalid instructor or subscription plan.');
        }

        $amount = $plan->amount;
        $totalAmount = $amount * $duration;
        $startDate = now();
        $endDate = $startDate->copy()->addMonths($duration);

        // Check if the instructor already has an active subscription
        $existingSubscription = Subscription::where('instructor_id', $instructorId)
            ->where('status', 'Active')
            ->first();

        if ($existingSubscription) {
            // Update the existing subscription
            $existingSubscription->update([
                'plan_id' => $planId,
                'no_of_months' => $duration,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_amount' => $totalAmount,
            ]);
            $message = 'Subscription updated successfully.';
        } else {
            // Create a new subscription
            Subscription::create([
                'instructor_id' => $instructorId,
                'plan_id' => $planId,
                'no_of_months' => $duration,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_amount' => $totalAmount,
                'status' => 'Active',
            ]);
            $message = 'Subscription created successfully.';
        }

        // Update the instructor's current plan
        $instructor->current_plan = $planId;
        $instructor->save();

        return back()->with('success', $message);
    }

    public function subscriptionPlans()
    {
        $instructorId = auth()->user()->instructor_id;
        $subscriptionPlans = SubscriptionPlan::all();
        $subscriptions = Subscription::where('instructor_id', $instructorId)->first();
        return view('backend.subscription.subscription-plans', compact('subscriptionPlans', 'subscriptions'));
    }

    public function subscribePlans($id)
    {
        $decryptedId = encryptor('decrypt', $id);
        $instructorId = auth()->user()->instructor_id;
        $currentPlan = Subscription::where('instructor_id' , $instructorId)->first();

        $subscriptionPlans = SubscriptionPlan::where('id', $decryptedId)->first();

        return view('backend.subscription.subscribe-plan', compact('subscriptionPlans', 'currentPlan'));
    }

    public function subscribePlansStore(Request $request ,  $id)
    {
        $decryptedId = encryptor('decrypt', $id);
        $instructorId = auth()->user()->instructor_id;
        $planId = $decryptedId;
        $duration = $request->noOfMonth;

        //check if no of month is passed
        if(empty($request->noOfMonth))
        {
            return back()->with('error', 'Select the no of months you are subscribing for.');
        }

        if (!$planId || !$duration) {
            return back()->with('error', 'A valid subscription plan and duration is not selected.');
        }

        // Fetch the instructor and plan
        $instructor = Instructor::find($instructorId);
        $plan = SubscriptionPlan::find($planId);

        if (!$instructor || !$plan) {
            return back()->with('error', 'Invalid instructor or subscription plan.');
        }

        $amount = $plan->amount;
        $totalAmount = $amount * $duration;
        $startDate = now();
        $endDate = $startDate->copy()->addMonths($duration);

        // Check if the instructor already has an active subscription
        $existingSubscription = Subscription::where('instructor_id', $instructorId)
            ->where('status', 'Active')
            ->first();

        if ($existingSubscription) {
            // Update the existing subscription
            $existingSubscription->update([
                'plan_id' => $planId,
                'no_of_months' => $duration,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_amount' => $totalAmount,
            ]);
            $message = 'Subscription upgraded successfully.';
        } else {
            // Create a new subscription
            Subscription::create([
                'instructor_id' => $instructorId,
                'plan_id' => $planId,
                'no_of_months' => $duration,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_amount' => $totalAmount,
                'status' => 'Active',
            ]);
            $message = 'Subscription successful.';
        }

        // Update the instructor's current plan
        $instructor->current_plan = $planId;
        $instructor->save();

        return redirect()->route('subscription.view')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show()
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

    public function upgrade($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the subscription
        $subscription = Subscription::findOrFail($id);

        // Get the instructor associated with this subscription
        $instructor = Instructor::find($subscription->instructor_id);

        // Delete the subscription
        if ($subscription->delete()) {
            // Update the instructor's current_plan to 0
            if ($instructor) {
                $instructor->current_plan = 0;
                $instructor->save();
            }

            return redirect()->back()->with('success', 'Subscription deleted and instructor plan updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to delete the subscription.');
    }

}
