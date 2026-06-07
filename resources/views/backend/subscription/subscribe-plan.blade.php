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
                                        <p>₦{{ number_format($subscriptionPlans->amount, 0) }}/month 
                                        or ₦{{ number_format($subscriptionPlans->amount * 12 * 0.9, 0) }}/year</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                    <label for="no_of_months">Select Duration (Months):</label>
                                    <select id="no_of_months" name="no_of_months" class="form-control">

                                        @if($subscriptionPlans->name === 'BASIC' && $subscriptionPlans->amount == 0)
                                            <option value="1">1 Month</option>
                                        @else
                                            <option value="1">1 Month</option>
                                            <option value="3">3 Months</option>
                                            <option value="6">6 Months</option>
                                            <option value="12">12 Months</option>
                                        @endif

                                    </select>

                                    <!-- <div class="mt-3">
                                        <strong>Total Amount: ₦<span id="total_amount">₦{{ number_format($subscriptionPlans->amount, 2) }}</span></strong>
                                    </div> -->
                                    @php
                                        $isBasicFree = $subscriptionPlans->name === 'BASIC' && $subscriptionPlans->amount == 0;

                                        $transactionCharge = $isBasicFree
                                            ? 0
                                            : (($subscriptionPlans->amount * 0.015) + 100);

                                        $totalPayable = $subscriptionPlans->amount + $transactionCharge;
                                    @endphp

                                    <div class="mt-4">

                                        <table class="table table-bordered table-sm text-center">

                                        <thead class="table-light">
                                            <tr>
                                                <th>Original Price</th>
                                                <th>Discount</th>
                                                <th>Savings</th>
                                                <th>Final Price</th>
                                                <th>Transaction Charges</th>
                                                <th>Total Payable</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>

                                                <!-- Original Price -->
                                                <td>
                                                    <span id="original_amount"
                                                        style="color:red; text-decoration:line-through;"></span>
                                                </td>

                                                <!-- Discount % -->
                                                <td>
                                                    <span id="discount_percent">0%</span>
                                                </td>

                                                <!-- Savings -->
                                                <td>
                                                    ₦<span id="discount_amount">0.00</span>
                                                </td>

                                                <!-- Final Price -->
                                                <td>
                                                    ₦<span id="total_amount">
                                                        {{ number_format($subscriptionPlans->amount, 2) }}
                                                    </span>
                                                </td>

                                                <!-- Transaction Charges -->
                                                <td>
                                                    ₦<span id="transaction_charges">
                                                        {{ number_format($transactionCharge ?? 0, 2) }}
                                                    </span>
                                                </td>

                                                <!-- Total Payable -->
                                                <td>
                                                    ₦<span id="total_with_charges">
                                                        {{ number_format($totalPayable ?? 0, 2) }}
                                                    </span>
                                                </td>

                                            </tr>
                                        </tbody>

                                    </table>
                                </div>

                                    <input type="hidden" id="hidden_total_amount" value="{{ $totalPayable }}">
                                    <!-- <input type="hidden" id="hidden_transaction_charges" value="{{ $transactionCharge }}"> -->
                                    
                                    </div> 
                                    @if($errors->has('noOfMonth'))
                                    <span class="text-danger"> {{$errors->first('noOfMonth')}}</span>
                                    @endif                                   
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
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
 document.addEventListener('DOMContentLoaded', function () {

    console.log('DOM ready');

    const select = document.getElementById('no_of_months');

    if (!select) {
        console.log('Select not found');
        return;
    }

    const amountPerMonth = Number("{{ $subscriptionPlans->amount }}");

    const isBasicFreePlan =
        "{{ $subscriptionPlans->name }}" === "BASIC" &&
        amountPerMonth === 0;

    function format(amount) {
        return Number(amount).toLocaleString('en-US', {
            minimumFractionDigits: 2
        });
    }

    function calculateTotalAmount() {

        console.log('running');

        const noOfMonths = parseInt(select.value || 1);

        // =========================
        // 1. BASE AMOUNT
        // =========================
        const baseAmount = amountPerMonth * noOfMonths;

        // =========================
        // 2. DISCOUNT RULES
        // =========================
        let discountRate = 0;

        if (noOfMonths === 3) discountRate = 0.02;
        if (noOfMonths === 6) discountRate = 0.05;
        if (noOfMonths === 12) discountRate = 0.10;

        const discountAmount = baseAmount * discountRate;

        // =========================
        // 3. FINAL AMOUNT
        // =========================
        const finalAmount = baseAmount - discountAmount;

        // =========================
        // 4. TRANSACTION CHARGES
        // =========================
        let transactionCharges = 0;
        let totalPayable = finalAmount;

        if (!isBasicFreePlan) {
            transactionCharges = (finalAmount * 0.015) + 100; // 0.15%
            totalPayable = finalAmount + transactionCharges;
        }

        // =========================
        // 5. UI UPDATES
        // =========================

        const setText = (id, value) => {
            const el = document.getElementById(id);
            if (el) el.textContent = value;
        };

        const setHTML = (id, value) => {
            const el = document.getElementById(id);
            if (el) el.innerHTML = value;
        };

        // Original amount (strike-through)
        setHTML(
            'original_amount',
            discountRate > 0 ? '₦' + format(baseAmount) : ''
        );

        // Discount %
        setText('discount_percent', (discountRate * 100).toFixed(0) + '%');

        // Savings
        setText('discount_amount', format(discountAmount));

        // Final amount
        setText('total_amount', format(finalAmount));

        // Transaction charges
        setText(
            'transaction_charges',
            isBasicFreePlan ? '0.00' : format(transactionCharges)
        );

        // Total payable
        setText(
            'total_with_charges',
            isBasicFreePlan ? '0.00' : format(totalPayable)
        );

        // =========================
        // 6. HIDDEN INPUTS (PAYSTACK)
        // =========================
        const hiddenTotal = document.getElementById('hidden_total_amount');
        if (hiddenTotal) {
            hiddenTotal.value = isBasicFreePlan ? 0 : totalPayable.toFixed(2);
        }

        const hiddenCharges = document.getElementById('hidden_transaction_charges');
        if (hiddenCharges) {
            hiddenCharges.value = isBasicFreePlan ? 0 : transactionCharges.toFixed(2);
        }
    }

    // =========================
    // EVENTS
    // =========================
    select.addEventListener('change', calculateTotalAmount);

    // initial run
    calculateTotalAmount();
});

    function payWithPaystack() {

    const planId = document.getElementById('subscriptionId').value;
    const noOfMonths = document.getElementById('no_of_months').value;
    const totalAmount = Number(document.getElementById('hidden_total_amount').value);
    const email = document.getElementById('email_addy').value;

    // =========================
    // BASIC PLAN CHECK (FREE)
    // =========================    

    if (totalAmount <= 0) {

    console.log("Free plan detected");

    fetch("{{ route('sub.free-subscribe') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            planId: planId,
            noOfMonths: noOfMonths,
            email: email
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {

            // store message temporarily
            sessionStorage.setItem('toast_success', data.message);

            window.location = "{{ route('dashboard') }}";
        }

    })
    .catch(err => {
        console.error(err);
        alert("Subscription failed. Please try again.");
    });

    return;
}

    // =========================
    // PAYSTACK FLOW (PAID)
    // =========================

    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');

    const reference =
        `KDH${year}${month}${day}${Math.random().toString(36).substr(2, 4).toUpperCase()}`;

    console.log("Sending noOfMonths:", noOfMonths);

    // Save months before payment
    fetch("{{ route('sub.storeNoOfMonths') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ noOfMonths })
    })
    .catch(err => console.error("Month save error:", err));

    const handler = PaystackPop.setup({
        key: 'pk_test_e32b5f31947c4f718642eae0260d670253d4aa90',
        email: email,
        amount: totalAmount * 100,
        currency: 'NGN',
        ref: reference,

        callback: function (response) {

            const reference = response.reference;

            alert('Payment complete! Reference: ' + reference);

            window.location =
                "{{ route('sub.verify-transaction', ['ref' => '__reference__']) }}"
                .replace('__reference__', reference);
        },

        onClose: function () {
            alert('Transaction Cancelled.');

            window.location = "{{ route('sub.cancel-transaction') }}";
        },
    });

    handler.openIframe();
}
</script>

@endpush
