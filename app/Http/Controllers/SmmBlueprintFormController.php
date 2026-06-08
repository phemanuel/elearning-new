<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmmBlueprintForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\DB ;

class SmmBlueprintFormController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Generate plain password (to email user once)
        // $plainPassword = Str::random(10);

        $form = SmmBlueprintForm::updateOrCreate(
            ['email' => $request->email],
            [
                'name'     => $request->name,
                'course'   => 'SMM BLUEPRINT',
                'course_code'   => 'VA', //--change to smm later
                // 'password' => Hash::make($plainPassword), // store hashed
            ]
        );

        // Send email with plain password
        // Mail::to($form->email)->send(
        //     new \App\Mail\PaymentSuccessMail($form, $plainPassword)
        // );

        return redirect()->route('smm.payment.page', [
            'form_id' => $form->id
        ]);
    }


    public function paymentPage($form_id)
    {
        $form = SmmBlueprintForm::findOrFail($form_id);
        return view('smmblueprint.payment', compact('form'));
    }

    // Webhook or callback from Paystack
    public function paymentCallback(Request $request)
    {              

        $reference = $request->reference;

        preg_match('/DH-SMM-(\d+)-/', $request->reference, $matches);

        $formId = $matches[1] ?? null;

        if (!$formId) {
            return response()->json([
                'message' => 'Invalid reference format'
            ], 400);
        }
        $form = SmmBlueprintForm::findOrFail($formId);

        // Verify payment
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Accept' => 'application/json',
        ])->get("https://api.paystack.co/transaction/verify/{$reference}");

        if (!$response->successful()) {
            \Log::error('Paystack HTTP error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'message' => 'Payment verification failed'
            ], 500);
        }

        $body = $response->json();

        if ($body['status'] && $body['data']['status'] === 'success') {

            if ($form->payment_status === 'success') {
                return response()->json(['message' => 'Already processed.']);
            }

            DB::beginTransaction();

            try {

                /*
                |-----------------------------------------
                | PASSWORD GENERATION
                |-----------------------------------------
                */
                $plainPassword = Str::random(12);
                $hashedPassword = Hash::make($plainPassword);

                /*
                |-----------------------------------------
                | UPDATE FORM
                |-----------------------------------------
                */
                $form->update([
                    'payment_status' => 'success',
                    'transaction_reference' => $reference,
                    'password' => $hashedPassword,
                ]);

                

                /*
                |-----------------------------------------
                | STUDENT TABLE
                |-----------------------------------------
                */
                $student = Student::updateOrCreate(
                    ['email' => $form->email],
                    [
                        'name_en' => $form->name,
                        'password' => $hashedPassword,
                        'contact_en' => '070',
                        'email_verified_status' => 1,
                        'email_verified_at' => now(),
                    ]
                );

                /*
                |-----------------------------------------
                | USER TABLE
                |-----------------------------------------
                */
                $user = User::updateOrCreate(
                    ['email' => $form->email],
                    [
                        'name_en' => $form->name,
                        'password' => $hashedPassword,
                        'role_id' => 4,
                        'email_verified_status' => 1,
                        'contact_en' => '070',
                        'email_verified_at' => now(),
                        'language'=> 'en',
                        'full_access'=> 0,
                        'status'=> 1,
                        'student_id' => $student->id,
                    ]
                );

                /*
                |-----------------------------------------
                | COURSE LOOKUP
                |-----------------------------------------
                */
                $course = Course::where('course_code', $form->course_code)->first();

                if ($course) {

                    /*
                    |-----------------------------------------
                    | GET INSTRUCTOR
                    |-----------------------------------------
                    */
                    $instructor = Instructor::where('id', $course->instructor_id)->first();

                    /*
                    |-----------------------------------------
                    | ENROLLMENT
                    |-----------------------------------------
                    */
                    Enrollment::updateOrCreate(
                        [
                            'student_id' => $student->id,
                            'course_id'  => $course->id,
                        ],
                        [
                            'instructor_id'   => $instructor ? $instructor->id : null,
                            'enrollment_date' => now(),
                        ]
                    );

                    /*
                    |-----------------------------------------
                    | PAYMENT RECORD
                    |-----------------------------------------
                    */
                    $currencyMap = [
                        '=N=' => 'NAIRA',
                        '$'   => 'USD',
                        '£'   => 'POUNDS',
                        '€'   => 'EURO',
                    ];

                    $currencySymbol = $course->currency_type ?? null;

                    $currency = $currencyMap[$currencySymbol] ?? 'NAIRA';

                    Payment::create([
                        'student_id'     => $student->id,
                        'course_id'      => $course->id,
                        'instructor_id'  => $instructor ? $instructor->id : null,
                        'currency'       => $currency,
                        'currency_code' =>  $currencySymbol,
                        'amount'         => $course->price,
                        'currency_value' => 1,
                        'method'         => 'Paystack',
                        'txnid'          => $reference,
                        'status'         => 1,
                    ]);
                }

                DB::commit();

                /*
                |-----------------------------------------
                | EMAIL
                |-----------------------------------------
                */
                Mail::to($form->email)->send(
                    new \App\Mail\PaymentSuccessMail($form, $plainPassword)
                );

                return response()->json([
                    'message' => 'Payment successful'
                ]);
                

            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json([
                    'message' => 'Error processing payment',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        /*
        |-----------------------------------------
        | FAILED PAYMENT
        |-----------------------------------------
        */
        $form->update([
            'payment_status' => 'failed',
            'transaction_reference' => $reference,
        ]);

        Mail::to($form->email)->send(new \App\Mail\PaymentFailedMail($form));

        return response()->json([
            'message' => 'Payment failed'
        ], 400);
    }

    public function thankYou(Request $request)
    {
        $status = $request->query('status'); // success or failed
        return view('smmblueprint.thankyou', compact('status'));
    }
}