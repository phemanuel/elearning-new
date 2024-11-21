<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    //
    public function index()
    {
        //
        $subscriptionPlan = SubscriptionPlan::all();
        return view('backend.subscription.index', compact('subscriptionPlan'));
        
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $data = new SubscriptionPlan;
            $data->name = $request->subscriptionName;
            $data->course_upload = $request->courseUpload;
            $data->student_upload = $request->studentUpload;
            $data->allocated_space = $request->allocatedSpace;
            $data->status = $request->status;
            $data->amount = $request->amount;

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/subscriptions'), $imageName);
                $data->image = $imageName;
            }
            if ($data->save())
                return redirect()->route('subscriptionPlan.index')->with('success', 'Data Saved');
            else
                return redirect()->back()->withInput()->with('error', 'Please try again');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
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
    public function edit($id)
    {
        //
        $decryptedId = encryptor('decrypt', $id);
        $data = SubscriptionPlan::findOrFail($decryptedId);
        return view('backend.subscription.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $decryptedId = encryptor('decrypt', $id);
            $data = SubscriptionPlan::findOrFail($decryptedId);
            $data->name = $request->subscriptionName;
            $data->course_upload = $request->courseUpload;
            $data->student_upload = $request->studentUpload;
            $data->allocated_space = $request->allocatedSpace;
            $data->status = $request->status;
            $data->amount = $request->amount;

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/subscriptions'), $imageName);
                $data->image = $imageName;
            }
            if ($data->save())
                return redirect()->route('subscriptionPlan.index')->with('success', 'Data Saved');
            else
                return redirect()->back()->withInput()->with('error', 'Please try again');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
        $data = CourseCategory::findOrFail($id);
        $image_path = public_path('uploads/courseCategories/') . $data->category_image;

        if ($data->delete()) {
            if (File::exists($image_path))
                File::delete($image_path);

            return redirect()->back();
        }
    }
}
