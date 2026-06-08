@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-16">

```
<div class="container mx-auto px-4">

    <div class="max-w-5xl mx-auto">

        <div class="grid lg:grid-cols-2 gap-10 items-center">

            <!-- Left Content -->
            <div>

                <span class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-6">
                    🚀 Social Media Management Blueprint
                </span>

                <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Complete Your Enrollment
                </h1>

                <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                    You're one step away from accessing the Social Media Management Blueprint.
                    Complete your payment and gain instant access to lessons, resources, and practical training.
                </p>

                <div class="space-y-4">

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            ✓
                        </div>
                        <span class="text-slate-700">Instant course access</span>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            ✓
                        </div>
                        <span class="text-slate-700">Student dashboard access</span>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            ✓
                        </div>
                        <span class="text-slate-700">Lifetime access to materials</span>
                    </div>

                </div>

            </div>

            <!-- Payment Card -->
            <div>

                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">

                        <h3 class="text-2xl font-bold mb-2">
                            Enrollment Summary
                        </h3>

                        <p class="text-blue-100">
                            Review your details before payment.
                        </p>

                    </div>

                    <div class="p-8">

                        <div class="space-y-5 mb-8">

                            <div class="flex justify-between border-b pb-3">
                                <span class="text-slate-500">Student Name</span>
                                <span class="font-semibold text-slate-800">{{ $form->name }}</span>
                            </div>

                            <div class="flex justify-between border-b pb-3">
                                <span class="text-slate-500">Email Address</span>
                                <span class="font-semibold text-slate-800">{{ $form->email }}</span>
                            </div>

                            <div class="flex justify-between border-b pb-3">
                                <span class="text-slate-500">Course</span>
                                <span class="font-semibold text-slate-800">SMM Blueprint</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">Amount</span>
                                <span class="text-3xl font-bold text-blue-600">₦25,000</span>
                            </div>

                        </div>

                        <button type="button"
                                id="pay-button"
                                class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition duration-300 shadow-lg">
                            Complete Payment
                        </button>

                        <div class="mt-6 text-center text-sm text-slate-500">
                            🔒 Secure payment powered by Paystack
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```

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
            .then(async res => {
                let data = await res.json().catch(() => null);

                if (!res.ok) {
                    throw data || { message: "Server error" };
                }

                return data;
            })
            .then(data => {
                console.log("PAYSTACK VERIFY RESPONSE:", data);

                if (data.message && data.message.includes('successful')) {
                    window.location.href = "{{ route('thankyou.page') }}?status=success";
                } else {
                    window.location.href = "{{ route('thankyou.page') }}?status=failed";
                }
            })
            .catch(err => {
                console.error("PAYSTACK ERROR:", err);

                alert(err.message || 'Payment verification failed');

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