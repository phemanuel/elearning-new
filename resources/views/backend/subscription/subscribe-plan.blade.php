@extends('backend.layouts.app')
@section('title', 'Subscribe')

@push('styles')
<!-- Pick date -->
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.date.css')}}">
@endpush

@section('content')

<!--**********************************
            Content body start
 ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    @if(empty($currentPlan))
                    <h4>Subscribe : No Plan <i class="la la-arrow-right mx-2"></i> {{$subscriptionPlans->name}}</h4>
                    @else
                    <h4>Subscribe : {{$currentPlan->subscriptionPlan->name}} <i class="la la-arrow-right mx-2"></i> {{$subscriptionPlans->name}}</h4>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('subscription.view')}}">Subscription</a></li>
                    <li class="breadcrumb-item active"><a href="#">Subscribe</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Subscription Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Name</label>
                                        <select name="subscriptionId" id="subscriptionId" class="form-control">                                            
                                                <option value="{{$subscriptionPlans->id}}">{{$subscriptionPlans->name}}</option>  
                                        </select>                                        
                                    </div>
                                    @if($errors->has('subscriptionId'))
                                    <span class="text-danger"> {{$errors->first('subscriptionId')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">No of Courses to Upload</label>
                                        <p>{{$subscriptionPlans->course_upload}}</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">No of Students to Upload</label>
                                        <p>{{$subscriptionPlans->student_upload}}</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Allocated Space for Materials</label>
                                        <p>{{$subscriptionPlans->allocated_space}}Gb</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Amount per Month/Year</label>
                                        <p>{{ number_format($subscriptionPlans->amount, 0) }}/month 
                                        or {{ number_format($subscriptionPlans->amount * 12 * 0.9, 0) }}/year</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                    <label for="no_of_months">Select Duration (Months):</label>
                                    <select id="no_of_months" name="no_of_months" class="form-control" onchange="calculateTotalAmount()">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }} {{ Str::plural('Month', $i) }}</option>
                                        @endfor
                                    </select>

                                    <div class="mt-3">
                                        <strong>Total Amount: ₦<span id="total_amount">{{ number_format($subscriptionPlans->amount, 2) }}</span></strong>
                                    </div>
                                    <div class="mt-3">
                                        <strong>Transaction Charges: ₦<span id="transaction_charges">{{ number_format(($subscriptionPlans->amount * 0.015) + 100, 2) }}</span></strong>
                                    </div>
                                    <div class="mt-3">
                                        <strong>Total Payable: ₦<span id="total_with_charges">{{ number_format($subscriptionPlans->amount + (($subscriptionPlans->amount * 0.015) + 100), 2) }}</span></strong>
                                    </div>

                                    <input type="hidden" id="hidden_total_amount" value="{{ $subscriptionPlans->amount + (($subscriptionPlans->amount * 0.015) + 100) }}">
                                    <input type="hidden" id="hidden_transaction_charges" value="{{ ($subscriptionPlans->amount * 0.015) + 100 }}">
                                    </div> 
                                    @if($errors->has('noOfMonth'))
                                    <span class="text-danger"> {{$errors->first('noOfMonth')}}</span>
                                    @endif                                   
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">                                  
                                
                                <input type="hidden" id="hidden_total_amount" value="{{ $subscriptionPlans->amount }}">
                                <input type="hidden" id="hidden_transaction_charges" value="0">
                                <input type="hidden" name="email_addy" id="email_addy" value="{{auth()->user()->email}}">
                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                <a class="btn btn-success btn-lg text-white" onClick="payWithPaystack()"> Click Here to Subscribe</a>                                     
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--**********************************
            Content body end
***********************************-->

@endsection

@push('scripts')
<!-- pickdate -->
<script src="{{asset('vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.date.js')}}"></script>

<!-- Pickdate -->
<script src="{{asset('js/plugins-init/pickadate-init.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const amountPerMonth = {{ $subscriptionPlans->amount }};

        function calculateTotalAmount() {
        // Default to 1 month if no value is selected
        const noOfMonths = parseInt(document.getElementById('no_of_months')?.value || 1, 10);
        let totalAmount = amountPerMonth * noOfMonths;

        // Apply 10% discount if the number of months is 12
        if (noOfMonths === 12) {
            totalAmount -= totalAmount * 0.10; // Subtract 10% of the total amount
        }

        // Calculate transaction charges: 1.5% of total amount + 100
        const transactionCharges = (totalAmount * 0.015) + 100;

        // Calculate total payable amount
        const totalWithCharges = totalAmount + transactionCharges;

        // Update the total amount displayed
        document.getElementById('total_amount').textContent = totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2 });

        // Update the transaction charges displayed
        document.getElementById('transaction_charges').textContent = transactionCharges.toLocaleString('en-US', { minimumFractionDigits: 2 });

        // Update the total payable amount displayed
        document.getElementById('total_with_charges').textContent = totalWithCharges.toLocaleString('en-US', { minimumFractionDigits: 2 });

        // Update hidden input values
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
@endpush
