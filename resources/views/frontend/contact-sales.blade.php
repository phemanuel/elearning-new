@extends('frontend.layouts.app')
@section('title', 'Sales')
@section('header-attr') class="nav-shadow" @endsection

@section('content')

<!-- Breadcrumb Starts Here -->
<div class="py-0 section--bg-white">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb pb-0 mb-0">
                <li class="breadcrumb-item"><a href="{{route('home')}}" class="fs-6 text-secondary">Home</a></li>
                <li class="breadcrumb-item active"><a href="#" class="fs-6 text-secondary">Sales</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb Ends Here -->

<!-- Contact Hero Area Starts Here -->
<section class="section section--bg-white hero hero--one">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero__img-content">
                    <div class="hero__img-content--main">
                        <img src="{{asset('frontend/dist/images/contact/pricing.png')}}" alt="image" />
                    </div>
                    <img src="{{asset('frontend/dist/images/shape/dots/dots-img-02.png')}}" alt="shape"
                        class="hero__img-content--shape-01" />
                    <img src="{{asset('frontend/dist/images/shape/rec05.png')}}" alt="shape"
                        class="hero__img-content--shape-02" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero__content-info">
                    <h4 class="font-title--md mb-0">Request a Custom Plan</h4><br>
                    <p class="font-para--lg" style="color:black;"> Need a custom solution or have questions about our plans? 
                        Our sales team is ready to assist! Reach out to discuss tailored options that fit your specific needs and maximize your value. Kindly provide the following details: 
                        </p> 
                        <ul class="font-para--lg" style="color:black; list-style-type: disc; margin-left: 20px;"> 
                            <li>The number of courses you wish to upload</li> <li>The number of students to enroll</li> 
                            <li>The required storage space</li> 
                            <li>Any additional requirements</li> 
                        </ul> <p class="font-para--lg" style="color:black;"> 
                        Our team will respond promptly with a solution designed just for you! </p>
                    <form action="#">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control--focused" placeholder="Type here..."
                                name="fullName" />
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Type here..." name="email" />
                        </div>
                    </div>
                    <div class="row my-lg-2 my-2">
                        <div class="col-12">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Type here..." value="Custom Plan" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="message">Messages</label>
                            <textarea name="message" placeholder="Type here..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="text-end">
                            <button type="submit" class="button button-lg button--primary fw-normal">Send
                                Request</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection