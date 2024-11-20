@extends('frontend.layouts.app')
@section('title', 'Success')
@section('header-attr') class="nav-shadow" @endsection

@section('content')
<!-- Breadcrumb Starts Here -->
<div class="py-0">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}" class="fs-6 text-secondary">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{route('searchCourse')}}" class="fs-6 text-secondary">Courses</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb Ends Here -->

<!-- About Intro Starts Here -->
<section class="about-intro section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 position-relative mt-4 mt-lg-0" style="z-index: 0;">
                <div class="about-intro__img-wrapper">
                    <img src="{{asset('frontend/dist/images/about/success.png')}}" alt="Intro Image"
                        class="img-fluid rounded-2 ms-lg-5 position-relative intro-image" width="350" height="310" />
                </div>
                <div class="intro-shape">
                    <img src="{{asset('frontend/dist/images/shape/rec04.png')}}" alt="Shape"
                        class="img-fluid shape-01" />
                    <img src="{{asset('frontend/dist/images/shape/dots/dots-img-09.png')}}" alt="Shape"
                        class="img-fluid shape-02" />
                </div>
            </div>
            <div class="col-lg-6">
            <div class="about-intro__textContent">
                <h2 class="font-title--md mb-3" style="color:green;">Transaction Successful.</h2>
                <p class="mt-2 mt-lg-1 mb-2 mb-lg-4">
                    Your transaction has been completed successfully! Thank you for your payment. A confirmation receipt has been sent to your email.                     
                </p>
                <p class="mt-2 mt-lg-1 mb-2 mb-lg-4">
                You have been automatically enrolled in the course you paid for. You can now access the course materials and start learning immediately.                
                </p>
                <p>
                If you have any questions or need further assistance, feel free to reach out to our support team at <a href="mailto:support@kingsdigihub.org">support@kingsdigihub.org</a>. Thank you for trusting us!
                </p>
                <div class="mt-3">
                    <a href="{{ route('studentdashboard') }}" class="btn btn-primary text-white">Go to Dashboard</a>
                </div>
            </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
@endpush