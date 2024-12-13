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
                    <h4 class="font-title--md mb-0" style="color:green;">Request Successful</h4><br>
                    <p class="font-para--lg" style="color:black;"> Thank you for submitting your custom plan request! Our team has received your details and is reviewing your submission. 
                        <br>
                        <p class="font-para--lg" style="color:black;">We will contact you shortly to discuss your requirements 
                        and provide the best possible solution tailored to your needs.</p> 
                        </p>                         
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Get in Touch Area Starts Here -->
<!-- Get in Touch Area Ends Here -->
@endsection