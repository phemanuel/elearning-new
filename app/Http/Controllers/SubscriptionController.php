<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPayment;
use App\Models\Instructor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

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
        $currentDate = now();
        return view('backend.subscription.subscription-plans', compact('subscriptionPlans', 'subscriptions'
        ,'currentDate'));
    }

    public function subscribePlans($id)
    {
        $decryptedId = encryptor('decrypt', $id);
        $instructorId = auth()->user()->instructor_id;
        $currentPlan = Subscription::where('instructor_id' , $instructorId)->first();

        $subscriptionPlans = SubscriptionPlan::where('id', $decryptedId)->first();
        session(['planId' => $subscriptionPlans->id]);        

        //check if the user has an existing plan
        if($currentPlan){
            //---check if the active plan is valid---
            $currentDate = now();
            $dueDate = $currentPlan->end_date;
            if($currentDate > $dueDate){
                return redirect()->back()->with('error', 'You still have an active plan, to upgrade your plan, contact our support team.');
            }
            
        }

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

    public function verifyTransaction($ref)
    {
        // Paystack API endpoint with the provided reference
        $url = "https://api.paystack.co/transaction/verify/" . rawurlencode($ref);

        // Make an HTTP GET request to Paystack API
        $response = Http::withHeaders([           
            'Authorization' => 'Bearer sk_test_a68da4cd7971e573aa675946d8b2549ca819044e',
            'Cache-Control' => 'no-cache',
        ])->get($url);

        // Decode the JSON response
        $result = json_decode($response->body());

        if ($response->successful() && isset($result->data->status) && $result->data->status == 'success') {
            // Retrieve the needed details from the response
            $status = $result->data->status;
            $reference = $result->data->reference;
            $cus_email = $result->data->customer->email;
            $cus_amount = $result->data->amount;

            // Store the values in Laravel's session
            Session::put('status', $status);
            Session::put('reference', $reference);
            Session::put('cus_amount', $cus_amount);
            Session::put('cus_email', $cus_email);

            // Connect the save enrolle function           
            $this->saveSubscription($status, $reference, $cus_email, $cus_amount);            
            return redirect()->route('dashboard')->with('success', 'Payment Transaction and Subscription was successful.');
        } else {
            // Log the response or handle the error
            // Optionally, you can pass the error message to the session or view
            Session::flash('error', $result->message ?? 'Something went wrong');

            // Redirect to the error page
            return redirect()->route('sub.error-transaction');
        }
    }  
    
    private function saveSubscription($status, $reference, $cus_email, $cus_amount)
    {
        $instructorId = auth()->user()->instructor_id;
        $planId = session('planId');
        $duration = session('noOfMonths');
            
            // Validate inputs
        if (!$planId || !$duration) {
            return back()->with('error', 'A valid subscription plan and duration must be selected.');
        }

        // Fetch the instructor and plan
        $instructor = Instructor::find($instructorId);
        $plan = SubscriptionPlan::find($planId);

        if (!$instructor || !$plan) {
            return back()->with('error', 'Invalid instructor or subscription plan.');
        }

        $amount = $plan->amount;
        $totalAmount = $amount * $duration;
        if ($duration == 12) {
            $totalAmount -= ($totalAmount * 0.10); // Apply 10% discount for yearly subscriptions
        }

        $startDate = now();
        $endDate = $startDate->copy()->addMonths($duration);

        // Save payment details
        $payment = SubscriptionPayment::create([
            'instructor_id' => $instructorId,
            'amount' => $amount,
            'txnid' => $reference,
            'plan_id' => $planId,
            'status' => 1,
            'no_of_months' => $duration,
            'total_amount' => $totalAmount,
            'method' => 'Paystack',
            'currency' => 'Naira',
        ]);

        if (!$payment) {
            return back()->with('error', 'Failed to save payment details.');
        }

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

        // Clear session variables after successful subscription
        session()->forget(['planId', 'no_of_months']);

        //return redirect()->route('subscribe.view')->with('success', $message);        
    }


    public function storeNoOfMonths(Request $request)
    {
        try {
            // Log the incoming request data
            \Log::info('Received AJAX request with noOfMonths:', ['noOfMonths' => $request->input('noOfMonths')]);
    
            // Validate the input
            $request->validate([
                'noOfMonths' => 'required|integer|min:1',
            ]);
    
            // Log after successful validation
            \Log::info('Validation passed, saving to session.');
    
            // Store the number of months in session
            session(['noOfMonths' => $request->input('noOfMonths')]);
    
            // Log the session data
            \Log::info('No. of months saved in session:', ['noOfMonths' => session('noOfMonths')]);
    
            // Return success response
            return response()->json(['message' => 'No. of months saved in session']);
        } catch (\Exception $e) {
            // Log any errors
            \Log::error('Error in storeNoOfMonths:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred.'], 500);
        }
    }
    

    public function cancelTransaction()    
    {    
        // return response()->json([
        //     'status' => 'canceled',
        // ]);
        return redirect()->route('dashboard')->with('error','Transaction has been cancelled.');
    }


    public function errorTransaction()
    {
        return redirect()->route('dashboard')->with('error','An error occured while processing your transaction.');
    }

    public function successTransaction()
    {
        return redirect()->route('dashboard')->with('success','Transaction was successful, and your subscription is done.');
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
