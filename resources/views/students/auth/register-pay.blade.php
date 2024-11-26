@extends('frontend.layouts.app')
@section('title', 'Sign Up')
@section('header-attr') class="nav-shadow" @endsection

@section('content')
<!-- SignUp Area Starts Here -->
<section class="signup-area signin-area p-3">
    <div class="container">
        <div class="row align-items-center justify-content-md-center">
            <div class="col-lg-5 order-2 order-lg-0">
                <div class="signup-area-textwrapper">
                    <h2 class="font-title--md mb-0">Subscription - Pay</h2> <br>                   
                    <form action="" method="POST">
                        @csrf
                        <div class="form-element">
                                <!-- <label for="name">Subscription Plan</label> -->
                                <h5><i class="{{$subPlan->icon}}"></i> &nbsp;{{$subPlan->name}} Plan</h5>
                        </div>
                        <div class="form-element">
                                <label for="name">Select Duration (Months):</label>
                                <select id="no_of_months" class="form-control" onchange="calculateTotalAmount()">
                                    <option value="1">1 Month</option>
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                        </div>
                        <br>
                        <div class="mt-2">
                            <strong>Total Amount: ₦<span id="total_amount">₦{{ number_format($subPlan->amount, 2) }} </span>
                                <small style="color:red; font-size: 90%;"> 
                                saves <i><strong>₦<span id="savings">0.00</span></strong></i> 
                                </small>
                            </strong>
                        </div>
                            <div class="mt-3">
                                <strong>Transaction Charges: ₦<span id="transaction_charges">₦{{ number_format(($subPlan->amount * 0.015) + 100, 2) }}</span></strong>
                            </div>
                            <div class="mt-3">
                                <strong>Total Payable: ₦<span id="total_with_charges">₦{{ number_format($subPlan->amount + (($subPlan->amount * 0.015) + 100), 2) }}</span></strong>
                            </div>

                                    <input type="hidden" id="hidden_total_amount" value="{{ $subPlan->amount + (($subPlan->amount * 0.015) + 100) }}">
                                    <input type="hidden" id="hidden_transaction_charges" value="{{ ($subPlan->amount * 0.015) + 100 }}">                       
                    </form>
                    <br>
                    <br>
                    
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">                                  
                                
                                <input type="hidden" id="hidden_total_amount" value="{{ $subPlan->amount }}">
                                <input type="hidden" id="hidden_transaction_charges" value="0">
                                <input type="hidden" name="email_addy" id="email_addy" value="{{auth()->user()->email}}">
                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                <a class="btn btn-success btn-lg text-white" onClick="payWithPaystack()"> Click Here to Subscribe</a>                                     
                                    
                                </div>
            </div>
            <div class="col-lg-7 order-1 order-lg-0">
                <div class="signup-area-image">
                    <img src="{{asset('frontend/dist/images/sign/img-1.png')}}" alt="Illustration Image"
                        class="img-fluid" /> 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SignUp Area Ends Here -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const amountPerMonth = {{ $subPlan->amount }};

    function calculateTotalAmount() {
        // Default to 1 month if no value is selected
        const noOfMonths = parseInt(document.getElementById('no_of_months')?.value || 1, 10);
        let totalAmountNew = amountPerMonth * noOfMonths;
        let totalAmount = amountPerMonth * noOfMonths;

        // Apply discounts based on the number of months
        if (noOfMonths === 3) {
            totalAmount -= totalAmount * 0.02; // 2% discount
        }
        if (noOfMonths === 6) {
            totalAmount -= totalAmount * 0.05; // 5% discount
        }
        if (noOfMonths === 12) {
            totalAmount -= totalAmount * 0.10; // 10% discount
        }

        // Calculate transaction charges: 1.5% of total amount + 100
        const transactionCharges = (totalAmount * 0.015) + 100;

        // Calculate total payable amount
        const totalWithCharges = totalAmount + transactionCharges;

        // Calculate the amount saved (difference between new and discounted amounts)
        const savedAmount = totalAmountNew - totalAmount;

        // Update the total amount displayed
        document.getElementById('total_amount').textContent = totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2 });

        // Update the transaction charges displayed
        document.getElementById('transaction_charges').textContent = transactionCharges.toLocaleString('en-US', { minimumFractionDigits: 2 });

        // Update the total payable amount displayed
        document.getElementById('total_with_charges').textContent = totalWithCharges.toLocaleString('en-US', { minimumFractionDigits: 2 });

        // Update the savings amount displayed
        document.getElementById('savings').textContent = savedAmount.toLocaleString('en-US', { minimumFractionDigits: 2 });

        // Update hidden input values for form submission
        document.getElementById('hidden_total_amount').value = totalWithCharges.toFixed(2);
        document.getElementById('hidden_transaction_charges').value = transactionCharges.toFixed(2);
    }

    // Run the calculation on page load with default 1 month
    document.addEventListener('DOMContentLoaded', () => {
        calculateTotalAmount();
    });

    function payWithPaystack() {
        // Generate the custom reference
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Add leading zero
        const day = String(today.getDate()).padStart(2, '0'); // Add leading zero
        const datePart = `${year}${month}${day}`; // Format: YYYYMMDD
        const uniquePart = Math.random().toString(36).substr(2, 4).toUpperCase(); // 4 unique alphanumeric characters
        const reference = `KDH${datePart}${uniquePart}`;

        const noOfMonths = document.getElementById('no_of_months').value;

        // Save noOfMonths to the backend via an AJAX call or form submission
        console.log("Sending noOfMonths:", noOfMonths);

        fetch("{{ route('sub.storeNoOfMonths') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ noOfMonths })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response from server:", data);
        })
        .catch(error => {
            console.error("Error in AJAX request:", error);
        });
        const totalAmount = document.getElementById('hidden_total_amount').value;
        const email = document.getElementById('email_addy').value;

        const handler = PaystackPop.setup({
            key: 'pk_test_7e47750741148423f3607736bee347b8620fd0c2', 
            email: email,
            amount: totalAmount * 100, // Amount in kobo
            currency: 'NGN',

            ref: reference,

            callback: function(response) {
                var reference = response.reference;
            alert('Payment complete! Reference: ' + reference);

            // Use Laravel route for verifying the transaction
            window.location = "{{ route('sub.verify-transaction', ['ref' => '__reference__']) }}".replace('__reference__', reference);
            },
            onClose: function() {
                alert('Transaction Cancelled.');
                // Use Laravel route for cancelling the transaction
            window.location = "{{ route('sub.cancel-transaction') }}";
            },
        });

        handler.openIframe();
    }
</script>
@endsection