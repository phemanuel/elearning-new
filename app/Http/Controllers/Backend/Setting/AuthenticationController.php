<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\Authentication\SignUpRequest;
use App\Http\Requests\Authentication\SignInRequest;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{
    public function signUpForm()
    {
        return view('backend.Authentication.register');
    }

    public function signUpStore(SignUpRequest $request)
    {
        try {
            $user = new User;
            $user->name_en = $request->name;
            $user->contact_en = $request->contact_en;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 4;            
            // dd($request->all()); 
            if ($user->save()){ 
               return redirect('login')->with('success', 'Successfully Registered');                 
            }                               
            else{
                return redirect('login')->with('danger', 'Please Try Again');
            }
                
        } catch (Exception $e) {
            //dd($e);
            return redirect('login')->with('danger', 'Please Try Again');
        }
    }

    public function signInForm()
    {
        return view('backend.Authentication.login');
    }

    public function signInCheck(SignInRequest $request)
    {
        try { 
            // Attempt to log the user in using Laravel's Auth::attempt()
            if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
                $user = Auth::user();  // Get the authenticated user

                // Check if the user is active
                if ($user->status == 1) {
                    $this->setSession($user);
                    // Redirect to dashboard if successful
                    return redirect()->route('dashboard')->with('success', 'Successfully Logged In');
                } else {
                    // Logout the user and show inactive status message
                    //Auth::logout();
                    return redirect()->route('studentLogin')->with('error', 'You are not an active user! Please contact the Authority.');
                }
            } else {                
                return redirect()->route('studentLogin')->with('error', 'Username or Password is wrong!');
            }
        } catch (Exception $e) {
            Log::error('Signin Error: ' . $e->getMessage());                
                return redirect()->route('studentLogin')->with('error', 'An error occurred during login. Please try again.');
        }
    }


    public function setSession($user)
    {
        return request()->session()->put(
            [
                'userId' => encryptor('encrypt', $user->id),
                'userName' => encryptor('encrypt', $user->name_en),
                'emailAddress' => encryptor('encrypt', $user->email),
                'role_id' => encryptor('encrypt', $user->role_id),
                'accessType' => encryptor('encrypt', $user->full_access),
                'role' => encryptor('encrypt', $user->role->name),
                'roleIdentitiy' => encryptor('encrypt', $user->role->identity),
                'language' => encryptor('encrypt', $user->language),
                'image' => $user->image ?? 'No Image Found',
                'instructorImage' => $user?->instructor->image ?? 'No instructorImage Found',
            ]
        );
    }

    public function signOut()
    {
        if (auth()->check()) {
            // Capture the user's role_id before logging out
            $userRoleId = auth()->user()->role_id;           

            // Redirect based on role
            if ($userRoleId == 1) {
            Auth::logout();
            // Clear all session data
            request()->session()->flush();
                return redirect('login')->with('danger', 'Successfully Logged Out');
            } else {               
            Auth::logout();
            // Clear all session data
            request()->session()->flush();
                return redirect()->route('studentLogin')->with('danger', 'Successfully Logged Out');
            }
        } else {
            // If the user is not authenticated, just redirect them to the login page
            return redirect()->route('studentLogin')->with('danger', 'Successfully Logged Out');
        }
    }    

    public function show(User $data)
    {
        return view('backend.user.userProfile', compact('data'));
    }
}
