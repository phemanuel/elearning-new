<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Coupon\AddNewRequest;
use App\Http\Requests\Backend\Coupon\UpdateRequest;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRoleId = auth()->user()->role_id;
        $instructorId = auth()->user()->instructor_id;
        if ($userRoleId == 1) {
            // Eager load the course relationship
            $coupon = Coupon::with('course')->get();

            return view('backend.coupon.index', compact('coupon'));
        } else {
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
           
            $coupon = Coupon::with('course')->where('instructor_id', $instructorId)->get();

            return view('backend.coupon.index', compact('coupon'));
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userRoleId = auth()->user()->role_id;
        $instructorId = auth()->user()->instructor_id;

        if($userRoleId == 1){
            $course = Course::get();
        }
        else{
            $course= Course::where('instructor_id', $instructorId)
            ->where('price','!=',0)
            ->get();
        }
        
        return view('backend.coupon.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewRequest $request)
    {
        try {
            // Check if a coupon already exists for the selected course
            $existingCoupon = Coupon::where('course_id', $request->course_id)->first();
            
            if ($existingCoupon) {
                // If a coupon already exists, return back with an error message
                return redirect()->route('coupon.index')->with('error', 'A coupon has already been created for this course.');
            }

            // If no coupon exists, proceed to create a new coupon
            $coupon = new Coupon;
            $coupon->course_id = $request->course_id;
            $coupon->instructor_id = $request->instructor_id;
            $coupon->code = $request->code;
            $coupon->discount = $request->discount;
            $coupon->valid_from = $request->valid_from;
            $coupon->valid_until = $request->valid_until;

            // Save the new coupon and check if successful
            if ($coupon->save()) {
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'Coupon Created by ' . auth()->user()->name_en,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('coupon.index')->with('success', 'Coupon Saved');
            } else {
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }

        } catch (\Exception $e) {
            // Log the error and return back with an error message
            Log::error('Create error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail(encryptor('decrypt', $id));
        $courseId = $coupon->course_id;
        $course = Course::where('id', $courseId)->first();
        return view('backend.coupon.edit', compact('coupon','course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $coupon = Coupon::findOrFail(encryptor('decrypt', $id));
            // $coupon->course_id = $request->course_id;
            // $coupon->instructor_id = $request->instructor_id;
            $coupon->code = $request->code;
            $coupon->discount = $request->discount;
            $coupon->valid_from = $request->valid_from;
            $coupon->valid_until = $request->valid_until;

            if ($coupon->save()){
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'Coupon Updated by ' . auth()->user()->name_en,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('coupon.index')->with('success', 'Coupon Saved');
            }                
            else{
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }                
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        if($coupon->delete()){
            if (auth()->check()) {
                \App\Models\LogActivity::create([
                    'user_id' => auth()->id(),
                    'ip_address' => request()->ip(),
                    'activity' => 'Coupon Deleted by ' . auth()->user()->name_en,
                    'activity_date' => now(),
                ]);
            }
        }
        return redirect()->back()->with('error','Data Deleted');
    }
}
