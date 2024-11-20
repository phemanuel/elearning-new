<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Checkout;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getEnrollee(Request $request)
    {
        $user = Student::findOrFail(currentUserId());
        $txnid = $request->transactionRef;
        $item_amount = session('cart_details')['total_amount']; 

        $cart_details = array('cart' => session('cart'), 'cart_details' => session('cart_details'));

        // Check if the student is already enrolled in any of the courses in the cart
        foreach ($cart_details['cart'] as $key => $course) {
            $existingEnrollment = Enrollment::where('student_id', $user->id)
                                ->where('course_id', $key)
                                ->first();

            if ($existingEnrollment) {
                return redirect()->back()->with('error', 'You have already enrolled in the course: ' . $course['title_en']);
            }
        }

        // Retrieve currency_type (assuming all items in the cart use the same currency)
        $currency_type = null;

        foreach ($cart_details['cart'] as $course) {
            $currency_type = $course['currency_type']; 
            $courseId = $course['id'];
            $instructorId = $course['instructor_id'];
            break; // Exit loop after retrieving the first currency_type
        }

        // Save Checkout details
        $check = new Checkout;
        $check->cart_data = base64_encode(json_encode($cart_details));
        $check->student_id = $user->id;
        $check->txnid = $txnid;
        $check->currency_code = $currency_type;

        if ($request->currency_type == '=N=') {
            $currency = 'NAIRA';
        } elseif ($request->currency_type == '$') {
            $currency = 'USD';
        } elseif ($request->currency_type == '£') {
            $currency = 'POUNDS';
        } elseif ($request->currency_type == '€') {
            $currency = 'EURO';
        }
        $check->currency = $currency;
        $check->status = 0;
        $check->save();

        // Save Payment details
        $deposit = new Payment;
        $deposit->student_id = $user->id;
        $deposit->currency_code = $currency_type;
        $deposit->currency = $currency;
        $deposit->course_id = $courseId;
        $deposit->instructor_id = $instructorId;
        $deposit->amount = session('cart_details')['total_amount'];
        $deposit->currency_value = 1;
        $deposit->method = 'Free';
        $deposit->txnid = $txnid;
        $deposit->save();

        // Mark deposit and checkout as successful
        $deposit = Payment::where('txnid', '=', $txnid)->orderBy('created_at', 'desc')->first();
        $check = Checkout::where('txnid', '=', $txnid)->orderBy('created_at', 'desc')->first();
        $check->status = 1;
        $check->save();

        $student = Student::findOrFail($deposit->student_id);
        $this->setSession($student);

        $deposit->status = 1;
        $deposit->save();

        // Store enrollment data if payment is successful
        if ($deposit->status == 1) {
            foreach (json_decode(base64_decode($check->cart_data))->cart as $key => $course) {
                $enrole = new Enrollment;
                $enrole->student_id = $check->student_id;
                $enrole->course_id = $key;
                $enrole->instructor_id = $course->instructor_id;
                $enrole->enrollment_date = date('Y-m-d');
                $enrole->completion_date = date('Y-m-d');
                $enrole->save();
            }

            // Clear the cart session after successful enrollment
            session()->forget('cart');
            session()->forget('cart_details');
        }

        return redirect()->route('studentdashboard')->with('success', 'Payment successful, and you have been enrolled!');
    }

    public function verifyTransaction($ref)
    {
        // Paystack API endpoint with the provided reference
        $url = "https://api.paystack.co/transaction/verify/" . rawurlencode($ref);

        // Make an HTTP GET request to Paystack API
        $response = Http::withHeaders([
           // 'Authorization' => 'Bearer sk_live_3cd4de2321edddfa4adc4cf77aeecc1f31f50e19',
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
            $this->saveEnrollee($status, $reference, $cus_email, $cus_amount);
            return redirect()->route('payment.success-transaction');
        } else {
            // Log the response or handle the error
            // Optionally, you can pass the error message to the session or view
            Session::flash('error', $result->message ?? 'Something went wrong');

            // Redirect to the error page
            return redirect()->route('payment.error-transaction');
        }
    }

    private function saveEnrollee($status, $reference, $cus_email, $cus_amount)
    {
        $user = Student::findOrFail(currentUserId());
        $txnid = $reference ;
        $item_amount = session('cart_details')['total_amount']; 
        $currency_type = session('currency_type');

        $cart_details = array('cart' => session('cart'), 'cart_details' => session('cart_details'));

        // Check if the student is already enrolled in any of the courses in the cart
        foreach ($cart_details['cart'] as $key => $course) {
            $existingEnrollment = Enrollment::where('student_id', $user->id)
                                ->where('course_id', $key)
                                ->first();

            if ($existingEnrollment) {
                return redirect()->back()->with('error', 'You have already enrolled in the course: ' . $course['title_en']);
            }
        }

        // Retrieve currency_type (assuming all items in the cart use the same currency)
        $currency_type = null;

        foreach ($cart_details['cart'] as $course) {
            $currency_type = $course['currency_type']; 
            $courseId = $course['id'];
            $instructorId = $course['instructor_id'];
            break; // Exit loop after retrieving the first currency_type
        }

        // If no currency_type is found (edge case)
        if (!$currency_type) {
            return redirect()->back()->with('error', 'Currency type is missing from the cart.');
        }

        // Save Checkout details
        $check = new Checkout;
        $check->cart_data = base64_encode(json_encode($cart_details));
        $check->student_id = $user->id;
        $check->txnid = $txnid;
        $check->currency_code = $currency_type; // Use the retrieved currency_type
        $check->save();

        if ($currency_type == '=N=') {
            $currency = 'NAIRA';
        } elseif ($currency_type == '$') {
            $currency = 'USD';
        } elseif ($currency_type == '£') {
            $currency = 'POUNDS';
        } elseif ($currency_type == '€') {
            $currency = 'EURO';
        }
        $check->currency = $currency;
        $check->status = 0;
        $check->save();

        // Save Payment details
        $deposit = new Payment;
        $deposit->student_id = $user->id;
        $deposit->currency_code = $currency_type;
        $deposit->currency = $currency;
        $deposit->course_id = $courseId;
        $deposit->instructor_id = $instructorId;
        $deposit->amount = session('cart_details')['total_amount'];
        $deposit->currency_value = 1;
        $deposit->method = 'Paystack';
        $deposit->txnid = $txnid;
        $deposit->save();

        // Mark deposit and checkout as successful
        $deposit = Payment::where('txnid', '=', $txnid)->orderBy('created_at', 'desc')->first();
        $check = Checkout::where('txnid', '=', $txnid)->orderBy('created_at', 'desc')->first();
        $check->status = 1;
        $check->save();

        $student = Student::findOrFail($deposit->student_id);
        $this->setSession($student);

        $deposit->status = 1;
        $deposit->save();

        // Store enrollment data if payment is successful
        if ($deposit->status == 1) {
            foreach (json_decode(base64_decode($check->cart_data))->cart as $key => $course) {
                $enrole = new Enrollment;
                $enrole->student_id = $check->student_id;
                $enrole->course_id = $key;
                $enrole->instructor_id = $course->instructor_id;
                $enrole->enrollment_date = date('Y-m-d');
                $enrole->completion_date = date('Y-m-d');
                $enrole->save();
            }

            // Clear the cart session after successful enrollment
            session()->forget('cart');
            session()->forget('cart_details');
        }        
    }

    public function cancelTransaction()    
    {
        return view('frontend.cancel-page');
        //return redirect()->route('home')->with('error','Transaction has been cancelled.');
    }

    public function errorTransaction()
    {
        return view('frontend.error-page');
    }

    public function successTransaction()
    {
        return view('frontend.success-page');
    }

    public function setSession($student){
        return request()->session()->put(
            [
                'userId' => encryptor('encrypt', $student->id),
                'userName' => encryptor('encrypt', $student->name_en),
                'emailAddress' => encryptor('encrypt', $student->email),
                'studentLogin' => 1,
                'image' => $student->image ?? 'No Image Found' 
            ]
        );
    }
    
}
