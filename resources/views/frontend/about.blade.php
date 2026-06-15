@extends('frontend.layouts.app')
@section('title', 'About')
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
                    <a href="{{route('about')}}" class="fs-6 text-secondary">About</a>
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
                    <img src="{{asset('frontend/dist/images/about/intro.jpg')}}" alt="Intro Image"
                        class="img-fluid rounded-2 ms-lg-5 position-relative intro-image" />
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
                    <h2 class="font-title--md mb-3">A Great Place to Grow.</h2>
                    <p class="mt-2 mt-lg-1 mb-2 mb-lg-4 text-secondary" style="color:black;">
                    Kings Digital Literacy Hub is a premier platform dedicated to empowering individuals with essential digital skills. We provide a wide range of online courses designed to enhance your proficiency in today’s technology-driven world. 
                    From beginner to advanced levels, our expertly crafted programs cover areas such as digital marketing, coding, data science, graphic design, and more.
                    </p>
                    <p class="mt-2 mt-lg-1 mb-2 mb-lg-4 text-secondary" style="color:black;">
                    At Kings Digital Literacy Hub, we believe in affordable and accessible education for all. With lifetime access to our resources, learners can study at their own pace, ensuring that knowledge is available whenever needed. Our platform is supported 
                    by expert instructors who are passionate about helping you achieve your career goals.
                    </p>
                    <p class="mt-2 mt-lg-1 mb-2 mb-lg-4 text-secondary" style="color:black;">
                    Whether you’re looking to advance your skills, switch careers, or grow your business, Kings Digital Literacy Hub is here to guide you every step of the way. 
                    Join us today and take control of your digital future!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Intro Ends Here -->

<!-- About Feature Starts Here -->
<section class="section aboutFeature pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-feature dark-feature">
                    <h5 class="text-white font-title--sm">Who We Are</h5>
                    <p class="text-lowblack" style="color:white;">
                    At Kings Digital Literacy Hub, we are a dynamic team committed to bridging the digital skills gap by providing top-notch, affordable education. Our mission is to empower individuals, businesses, 
                    and communities with the tools and knowledge needed to thrive in today’s digital world.
                    </p>
                    <p class="text-lowblack" style="color:white;">
                    We specialize in delivering a wide array of courses that cover essential digital skills, from coding and digital marketing to data science and graphic design. Our platform offers flexible learning options with lifetime access, 
                    enabling learners to grow at their own pace.
</p>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="about-feature">
                    <h5 class="font-title--sm">Our Mission</h5>
                    <p class="text-secondary" style="color:black;">
                    Our mission is to empower individuals with the digital skills necessary to succeed in an increasingly technology-driven world. We strive to provide accessible, affordable, and high-quality education that enables learners to unlock their potential, 
                    advance their careers, and positively impact their communities.
                    </p>
                    <p class="text-secondary" style="color:black;">
                    Through our expertly crafted courses and dedicated support, we aim to bridge the digital divide and create opportunities for lifelong learning and growth in the digital economy.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Feature Ends Here -->

<!-- Brands Starts Here -->
<!-- <section class="section overflow-hidden brands pb-lg-0">
    <div class="bg-secondary py-80">
        <div class="container">
            <div class="row mb-40">
                <div class="col-lg-6 mx-auto text-center">
                    <div class="brands__titleContent">
                        <h5 class="mb-2 dark-text font-title--sm">
                            Over 30,000+ Schools & College Learning With Us.
                        </h5>
                        <p class="font-para--lg">
                            Proin euismod elementum dolor, non iaculis velit mollis sed. In eleifend urna sit amet
                            purus
                            congue.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-area">
                        <div class="brand-area-image">
                            <img src="{{asset('frontend/dist/images/versity/1.png')}}" alt="Brand"
                                class="img-fluid" />
                        </div>
                        <div class="brand-area-image">
                            <img src="{{asset('frontend/dist/images/versity/2.png')}}" alt="Brand"
                                class="img-fluid" />
                        </div>
                        <div class="brand-area-image">
                            <img src="{{asset('frontend/dist/images/versity/3.png')}}" alt="Brand"
                                class="img-fluid" />
                        </div>
                        <div class="brand-area-image">
                            <img src="{{asset('frontend/dist/images/versity/4.png')}}" alt="Brand"
                                class="img-fluid" />
                        </div>
                        <div class="brand-area-image">
                            <img src="{{asset('frontend/dist/images/versity/2.png')}}" alt="Brand"
                                class="img-fluid" />
                        </div>
                        <div class="brand-area-image">
                            <img src="{{asset('frontend/dist/images/versity/5.png')}}" alt="Brand"
                                class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Brands Ends Here -->

<!-- Best Instructors Starts Here -->
<!-- Best Instructors Starts Here -->
<section class="section best-instructor-featured overflow-hidden main-instructor-featured bg-offwhite">
    <div class="container">

        <div class="row align-items-center mb-5">

            <div class="col-md-8">
                <h3 class="font-title--md mb-1">
                    Meet Our Best Instructors
                </h3>
        
                <p class="text-muted mb-0">
                    Learn from industry experts with years of practical experience.
                </p>
            </div>
        
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('searchInstructor') }}" class="instructor-view-all">
                    View All
                    <span>→</span>
                </a>
            </div>
        
        </div>

        <div class="row g-4 justify-content-center">

            @forelse ($instructor->take(4) as $i)
                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="instructor-card-modern">

                        <div class="instructor-img-wrapper">
                            <img src="{{ asset('public/uploads/users/'.$i->image) }}" alt="Instructor" />

                            <ul class="instructor-social">
                                @if(!empty($i->social_facebook))
                                    <li><a href="{{ $i->social_facebook }}">F</a></li>
                                @endif

                                @if(!empty($i->social_instagram))
                                    <li><a href="{{ $i->social_instagram }}">I</a></li>
                                @endif

                                @if(!empty($i->social_linkedin))
                                    <li><a href="{{ $i->social_linkedin }}">L</a></li>
                                @endif

                                @if(!empty($i->social_twitter))
                                    <li><a href="{{ $i->social_twitter }}">T</a></li>
                                @endif

                                @if(!empty($i->social_youtube))
                                    <li><a href="{{ $i->social_youtube }}">Y</a></li>
                                @endif
                            </ul>
                        </div>

                        <div class="instructor-info">
                            <h5>
                                <a href="{{ route('instructorProfile', encryptor('encrypt', $i->id)) }}">
                                    {{ $i->name_en }}
                                </a>
                            </h5>
                            <p>{{ $i->designation }}</p>
                        </div>

                        <div class="instructor-action">
                            <a href="{{ route('instructorProfile', encryptor('encrypt', $i->id)) }}"
                               class="button button-sm button--primary w-100">
                                View Profile
                            </a>
                        </div>

                    </div>

                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No instructors available at the moment.</p>
                </div>
            @endforelse

        </div>
       
    </div>
</section>
@endsection

@push('scripts')
@endpush