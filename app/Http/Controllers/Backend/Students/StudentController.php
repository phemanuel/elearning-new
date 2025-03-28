<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Students\AddNewRequest;
use App\Http\Requests\Backend\Students\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user){
            $data = Student::paginate(20);
        return view('backend.student.index', compact('data'));
        }       
        return redirect()->route('logOut');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::get();
        return view('backend.student.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewRequest $request)
    {
        try {
            $student = new Student();
            $student->name_en = $request->fullName_en;
            // $student->name_bn = $request->fullName_bn;
            $student->contact_en = $request->contactNumber_en;
            // $student->contact_bn = $request->contactNumber_bn;
            $student->email = $request->emailAddress;
            $student->role_id = $request->roleId;
            $student->date_of_birth = $request->birthDate;
            $student->gender = $request->gender;
            $student->status = $request->status;
            $student->password = Hash::make($request->password);
            $student->language = 'en';
            $student->access_block = $request->accessBlock;

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/students'), $imageName);
                $student->image = $imageName;
            }
            if ($student->save()){
                //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'New student created by ' . auth()->user()->name_en,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('student.index')->with('success', 'Data Saved');
            }   
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
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::get();
        $student = Student::findOrFail(encryptor('decrypt', $id));

        return view('backend.student.edit', compact('role', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {           
            // Find the student by ID
            $student = Student::findOrFail(encryptor('decrypt', $id));
            
            // Update student fields
            $student->name_en = $request->fullName_en;
            $student->contact_en = $request->contactNumber_en;
            $student->email = $request->emailAddress;
            $student->date_of_birth = $request->birthDate;
            $student->gender = $request->gender;
            $student->status = $request->status;
            $student->language = 'en';
            
            // Update the student password only if a new one is provided
            if ($request->filled('password')) {
                $student->password = Hash::make($request->password);
            }
            
            // Find the associated user
            $user = User::where('student_id', $student->id)->first();
            
            if ($user) {
                // Update user fields
                $user->name_en = $request->fullName_en;
                $user->contact_en = $request->contactNumber_en;
                $user->email = $request->emailAddress;
                
                // Update the user password only if a new one is provided
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }
                
                $user->save(); // Save the user record
            }
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/students'), $imageName);
                $student->image = $imageName;
            }

            // Save the student record
            if ($student->save()) {
                return redirect()->route('student.index')->with('success', 'Data Saved');
            } else {
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }
        } catch (Exception $e) {
            // Debug the exception
            //dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Student::findOrFail(encryptor('decrypt', $id));
        $image_path = public_path('uploads/students') . $data->image;

        if ($data->delete()) {
            if (File::exists($image_path))
                File::delete($image_path);

            return redirect()->back();
        }
    }
}
