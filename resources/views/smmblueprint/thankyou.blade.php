@extends('layouts.app')

@section('content')
<div class="container text-center py-20">
    @if($status === 'success')
        <h1 class="text-3xl font-bold text-green-500 mb-5">Payment Successful!</h1>
        <p class="text-lg mb-5">Thank you for enrolling. A confirmation email has been sent to you.</p>
        <a href="{{ url('/') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Go Back Home
        </a>
    @elseif($status === 'failed')
        <h1 class="text-3xl font-bold text-red-500 mb-5">Payment Failed!</h1>
        <p class="text-lg mb-5">Your transaction could not be verified. Please try again.</p>
        <a href="{{ url('/') }}" class="inline-block mt-4 bg-gray-600 text-white px-6 py-3 rounded hover:bg-gray-700">
            Go Back Home
        </a>
    @else
        <h1 class="text-3xl font-bold text-yellow-500 mb-5">Payment Status Unknown</h1>
        <p class="text-lg mb-5">Something went wrong. Please contact support.</p>
    @endif
</div>
@endsection