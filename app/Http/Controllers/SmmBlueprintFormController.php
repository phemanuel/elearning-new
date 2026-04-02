<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmmBlueprintForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class SmmBlueprintFormController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Create or update form entry based on email
        $form = SmmBlueprintForm::updateOrCreate(
            ['email' => $request->email], // Check if email exists
            ['name' => $request->name]    // Update name if exists or create new
        );

        // Send success email
        Mail::to($form->email)->send(new \App\Mail\PaymentSuccessMail($form));

        // Redirect to payment page with form ID
        return redirect()->route('smm.payment.page', ['form_id' => $form->id]);
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

        // First, find the form entry
        $form = SmmBlueprintForm::findOrFail(explode('-', $reference)[0]); // because we appended form_id in ref

        // Verify payment with Paystack server
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Accept' => 'application/json',
        ])->get("https://api.paystack.co/transaction/verify/{$reference}");

        $body = $response->json();

        if($body['status'] && $body['data']['status'] === 'success') {
            // Payment verified
            $form->update([
                'payment_status' => 'success',
                'transaction_reference' => $reference,
            ]);

            // Send success email
            Mail::to($form->email)->send(new \App\Mail\PaymentSuccessMail($form));

            return response()->json(['message' => 'Payment verified and successful.']);
        } else {
            // Payment failed
            $form->update([
                'payment_status' => 'failed',
                'transaction_reference' => $reference,
            ]);

            // Send failed email
            Mail::to($form->email)->send(new \App\Mail\PaymentFailedMail($form));

            return response()->json(['message' => 'Payment failed.']);
        }
    }

    public function thankYou(Request $request)
    {
        $status = $request->query('status'); // success or failed
        return view('smm.thankyou', compact('status'));
    }
}