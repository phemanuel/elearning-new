@extends('layouts.app')

@section('content')
<div class="hero" style="background:#1a1a2e; padding:40px 20px; color:#fff; text-align:center;">
    <div style="max-width:600px; margin:0 auto; text-align:left;">
        <h1 style="margin-bottom:15px;">Complete Your Payment</h1>
        <p style="margin-bottom:20px;">Hi <strong>{{ $form->name }}</strong>, please complete your payment to access the Social Media Management Blueprint.</p>

        <div style="background:#fff; color:#1a1a2e; padding:25px; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1); text-align:center;">
            <p><strong>Name:</strong> {{ $form->name }}</p>
            <p><strong>Email:</strong> {{ $form->email }}</p>
            <p><strong>Amount:</strong> ₦25,000</p>

            <button type="button" id="pay-button"
                style="padding:12px 20px; background:#1a1a2e; color:#fff; border:none; border-radius:6px; font-weight:600; cursor:pointer;">
                Pay Now
            </button>
        </div>
    </div>
</div>

<!-- Verification Overlay -->
<div id="verification-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.6); color:#fff; font-size:18px;
     justify-content:center; align-items:center; flex-direction:column; z-index:9999;">
    <div style="margin-bottom:15px;">
        <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </div>
    <p>Verifying your payment. Please wait...</p>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
document.getElementById('pay-button').addEventListener('click', function () {
    let handler = PaystackPop.setup({
        key: '{{ env('PAYSTACK_PUBLIC_KEY') }}', 
        email: '{{ $form->email }}',
        amount: 2500000, // ₦25,000 in kobo
        currency: "NGN",
        ref: 'DH-SMM-{{ $form->id }}-' + Math.floor(100000 + Math.random() * 900000),
        callback: function(response){
            // Show verification overlay
            document.getElementById('verification-overlay').style.display = 'flex';

            // Send reference to server for verification
            fetch("{{ route('smm.payment.callback') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ reference: response.reference })
            })
            .then(res => res.json())
            .then(data => {
                if(data.message.includes('successful')){
                    window.location.href = "{{ route('thankyou.page') }}?status=success";
                } else {
                    window.location.href = "{{ route('thankyou.page') }}?status=failed";
                }
            })
            .catch(err => {
                alert('An error occurred while verifying payment. Try again.');
                document.getElementById('verification-overlay').style.display = 'none';
            });
        },
        onClose: function(){
            alert('Payment window closed.');
        }
    });
    handler.openIframe();
});
</script>
@endsection