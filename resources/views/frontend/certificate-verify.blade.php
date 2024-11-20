@extends('frontend.layouts.app')
@section('title', 'Certificate')
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
                    <a href="#" class="fs-6 text-secondary">Certificate</a>
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
                    <img src="{{asset('uploads/students/'. $studentInfo->image)}}" alt="Intro Image"
                        class="img-fluid rounded-2 ms-lg-5 position-relative intro-image" width="237" height="201" />
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
                    <h2 class="font-title--md mb-3" style="color: green;">Certificate Verified</h2>
                    
                    <table cellpadding="4" cellspacing="4" width="70%">
                        <tr>
                           <td>Full Name:</td>
                            <td>{{$studentInfo->name_en}}</td>
                        </tr>
                        <tr>
                            <td>Course:</td>
                            <td>{{$course->title_en}}</td>
                        </tr>
                        <tr>
                           <td>Completion Date:</td>
                            <td>{{date('F j, Y', strtotime($data->completion_date))}}</td>
                        </tr>
                    </table>
                    <br>
                    <p style="color:black;">
                    The student with the details above has successfully completed the certification program at Kings Digital Literacy Hub. This certificate has been verified and 
                    onfirms the student’s accomplishment and mastery in the designated course.
                    </p>
                    <br>
                    <p class="mt-2 mt-lg-1 mb-2 mb-lg-4 text-secondary" style="color:black;">
                        <a href="{{route('certificate-view', ['url' => $data->certificate_link])}}" target="_blank" style="text-decoration: none; color: black;">
                            <i class="fas fa-eye" style="margin-right: 5px;"></i>
                            View Certificate
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Intro Ends Here -->
 @endsection

@push('scripts')
@endpush