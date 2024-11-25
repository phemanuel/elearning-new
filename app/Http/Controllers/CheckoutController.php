<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()  
    {
        // Check if the cart session is empty or not
        $cart = session('cart', []);

        if (empty($cart)) {
            // If the cart is empty, return back with a message
            return redirect()->back()->with('error', 'No items in the cart.');
        }

        // If cart is not empty, proceed to checkout view
       
        $total_amount = session('cart_details')['total_amount'];
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $randomChars = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);

        // Generate the transaction reference
        $transactionRef = "KDH" . $year . $month . $day . $randomChars;
        if($total_amount == 0) {
            return view('frontend.checkout', compact('transactionRef'));
            //return redirect()->route('payment.enrollee.submit');
        }
        elseif($total_amount > 0) {
            return view('frontend.checkout', compact('transactionRef'));
        }        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        //    $checkout = new Checkout;
        //    $checkout->cart_data = $request->base64_encode(json_encode(session('cart')));
        //    $checkout->payer_name = $request->payer_name;
        //    $checkout->payment_option = $request->payment_option;
        //    $checkout->status = $request->status;
        
        //     if ($checkout->save())
        //         return redirect()->route('instructor.index')->with('success', 'Data Saved');
        //     else
        //         return redirect()->back()->withInput()->with('error', 'Please try again');
        // } catch (Exception $e) {
        //     // dd($e);
        //     return redirect()->back()->withInput()->with('error', 'Please try again');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
