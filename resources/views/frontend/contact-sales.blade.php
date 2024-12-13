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
                        <ul class="font-para--lg" style="color:black; list-style-type: none; margin-left: 0px;">
                            <li><i class="fas fa-book-open" style="color:blue;"></i> The number of courses you wish to upload</li>
                            <li><i class="fas fa-user-graduate" style="color:green;"></i> The number of students to enroll</li>
                            <li><i class="fas fa-database" style="color:orange;"></i> The required storage space</li>
                            <li><i class="fas fa-list-alt" style="color:red;"></i> Any additional requirements</li>
                        </ul><br>  
                        
                        <a href="#sales-form" class="button button-lg button--primary fw-normal">Fill Request Form</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Get in Touch Area Starts Here -->
<section id="sales-form" class="section getin-touch overflow-hidden"
    style="background-image: url({{asset('frontend/dist/images/contact/bg.png')}});">
    <div class="container">
        <div class="row">
            <h2 class="font-title--md text-center">Request Form</h2>
            <!-- <div class="col-lg-5 pe-lg-4 position-relative mb-4 mb-lg-0">
                <div class="contact-feature d-flex align-items-center">
                    <div class="contact-feature-icon primary-bg">
                     <i class="fas fa-map-marked-alt fa-2x"></i>
                    </div>
                    <div class="contact-feature-text">
                        <h6>Address</h6>
                        <p>Ibadan, Nigeria.</p>
                        <p>#15/B Chicago-60827, USA</p>
                    </div>
                </div>

                <div class="contact-feature d-flex align-items-center my-lg-4 my-3">
                    <div class="contact-feature-icon tertiary-bg">
                        <i class="far fa-envelope fa-2x"></i>
                    </div>
                    <div class="contact-feature-text">
                        <h6>Email</h6>
                        <p>kingsdigihub@gmail.com</p>
                    </div>
                </div>

                <div class="contact-feature d-flex align-items-center">
                    <div class="contact-feature-icon success-bg">
                       <i class="fas fa-phone-alt fa-2x"></i>
                    </div>
                    <div class="contact-feature-text">
                        <h6>Phone</h6>
                        <p>+234-916-988-6500</p>
                    </div>
                </div>
                <img src="{{asset('frontend/dist/images/shape/dots/dots-img-03.png')}}" alt="Shape"
                    class="img-fluid contact-feature-shape" />
            </div> -->
            <div class="col-lg-7 form-area">
                <form action="{{route('contact-sales.action')}}" method="POST">
                @csrf
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
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="name">No of Courses</label>
                            <input type="number" class="form-control form-control--focused" placeholder="Type here..."
                                name="noOfCourse" />
                        </div>
                        <div class="col-lg-6">
                            <label for="email">No of Students</label>
                            <input type="number" class="form-control" placeholder="Type here..." name="noOfStudent" />
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="name">Storage Space(Gb)</label>
                            <input type="number" class="form-control form-control--focused" placeholder="Type here..."
                                name="storageSpace" />
                        </div>                        
                    </div>                    
                    <div class="row">
                        <div class="col-12">
                            <label for="message">Additional Information</label>
                            <textarea name="addInfo" placeholder="Type here..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="text-end">
                            <button type="submit" class="button button-lg button--primary fw-normal">Send
                                Request</button>
                        </div>
                    </div>
                </form>
                <div class="form-area-shape">
                    <img src="{{asset('frontend/dist/images/shape/circle3.png')}}" alt="Shape"
                        class="img-fluid shape-01" />
                    <img src="{{asset('frontend/dist/images/shape/circle5.png')}}" alt="Shape"
                        class="img-fluid shape-02" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Get in Touch Area Ends Here -->
@endsection