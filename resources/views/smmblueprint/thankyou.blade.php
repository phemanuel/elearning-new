@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-16">
    <div class="container mx-auto px-4">

```
    <div class="max-w-3xl mx-auto">

        @if($status === 'success')

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Success Header -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-10 text-center text-white">
                    <div class="w-24 h-24 mx-auto bg-white/20 rounded-full flex items-center justify-center mb-6">
                        <i class="fa fa-check-circle text-5xl"></i>
                    </div>

                    <h1 class="text-4xl font-bold mb-3">
                        Payment Successful!
                    </h1>

                    <p class="text-lg opacity-90">
                        Welcome to KingsDigiHub 🎉
                    </p>
                </div>

                <!-- Body -->
                <div class="p-10">

                    <div class="bg-green-50 border border-green-100 rounded-2xl p-6 mb-8">
                        <h4 class="font-bold text-green-700 mb-2">
                            Enrollment Confirmed
                        </h4>

                        <p class="text-gray-700">
                            Your course enrollment has been completed successfully.
                            Login details have been sent to your email address.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-5 mb-8">

                        <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fa fa-envelope text-xl text-blue-600"></i>
                            </div>

                            <h5 class="font-bold text-slate-800 mb-2">
                                Check Email
                            </h5>

                            <p class="text-slate-600 text-sm">
                                Login credentials have been sent to your email address.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fa fa-graduation-cap text-xl text-purple-600"></i>
                            </div>

                            <h5 class="font-bold text-slate-800 mb-2">
                                Access Course
                            </h5>

                            <p class="text-slate-600 text-sm">
                                Your course is now available in your student dashboard.
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-amber-100 flex items-center justify-center">
                                <i class="fa fa-trophy text-xl text-amber-600"></i>
                            </div>

                            <h5 class="font-bold text-slate-800 mb-2">
                                Earn Skills
                            </h5>

                            <p class="text-slate-600 text-sm">
                                Complete lessons and track your learning progress.
                            </p>
                        </div>

                    </div>

                    <div class="flex flex-col md:flex-row gap-4 justify-center">

                        <a href="{{ url('/') }}"
                           class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold text-center transition">
                            Go to Homepage
                        </a>

                        <a href="https://www.kingsdigihub.org/user/login"
                        class="px-8 py-4 border border-slate-300 hover:bg-slate-100 rounded-xl font-semibold text-center transition text-slate-800">
                            Student Login
                        </a>

                    </div>

                </div>

            </div>

        @elseif($status === 'failed')

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <div class="bg-gradient-to-r from-red-500 to-rose-600 p-10 text-center text-white">

                    <div class="w-24 h-24 mx-auto bg-white/20 rounded-full flex items-center justify-center mb-6">
                        <i class="fa fa-times-circle text-5xl"></i>
                    </div>

                    <h1 class="text-4xl font-bold mb-3">
                        Payment Verification Failed
                    </h1>

                    <p class="text-lg opacity-90">
                        We couldn't verify your transaction.
                    </p>

                </div>

                <div class="p-10 text-center">

                    <p class="text-gray-600 text-lg mb-8">
                        Your payment could not be confirmed at this time.
                        If you have already been charged, please contact support with your payment reference.
                    </p>

                    <div class="flex flex-col md:flex-row gap-4 justify-center">

                        <a href="{{ url('/') }}"
                           class="px-8 py-4 bg-slate-700 hover:bg-slate-800 text-white rounded-xl font-semibold">
                            Return Home
                        </a>

                        <a href="mailto:support@kingsdigihub.org"
                           class="px-8 py-4 border border-slate-300 hover:bg-slate-100 rounded-xl font-semibold">
                            Contact Support
                        </a>

                    </div>

                </div>

            </div>

        @else

            <div class="bg-white rounded-3xl shadow-xl p-12 text-center">

                <div class="w-24 h-24 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fa fa-exclamation-triangle text-4xl text-yellow-600"></i>
                </div>

                <h1 class="text-4xl font-bold text-yellow-600 mb-4">
                    Status Unknown
                </h1>

                <p class="text-lg text-gray-600 mb-8">
                    We couldn't determine the status of your payment.
                    Please contact support for assistance.
                </p>

                <a href="{{ url('/') }}"
                   class="inline-block px-8 py-4 bg-slate-700 hover:bg-slate-800 text-white rounded-xl font-semibold">
                    Return Home
                </a>

            </div>

        @endif

    </div>

</div>
```

</div>
@endsection
