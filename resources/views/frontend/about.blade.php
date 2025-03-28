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
<section class="section best-instructor-featured overflow-hidden main-instructor-featured">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 position-relative">
                <h2 class="text-center mb-40 font-title--md">Meet Our Best Instructor</h2>
                <div class="ourinstructor__wrapper mt-lg-5 mt-0">
                <div class="ourinstructor-active">
                        @forelse ($instructor as $i)
                        <div class="mentor">
                            <div class="mentor__img">
                                <img src="{{asset('uploads/users/'.$i->image)}}" alt="Mentor image" />
                                <ul class="list-inline">
                                @if(!empty($i->social_facebook)) 
                                    <li class="list-inline-item">
                                        <a href="{{$i->social_facebook}}" tabindex="0">
                                            <svg width="9" height="18" viewBox="0 0 9 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.3575 2.98875H9.00075V0.12675C8.71725 0.08775 7.74225 0 6.60675 0C4.2375 0 2.6145 1.49025 2.6145 4.22925V6.75H0V9.9495H2.6145V18H5.82V9.95025H8.32875L8.727 6.75075H5.81925V4.5465C5.82 3.62175 6.069 2.98875 7.3575 2.98875Z"
                                                    fill="#25252E"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty($i->social_instagram))
                                    <li class="list-inline-item">
                                        <a href="{{$i->social_instagram}}" tabindex="0">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.9507 5.29205C17.9086 4.33564 17.7539 3.67812 17.5324 3.10836C17.3038 2.50359 16.9522 1.96213 16.4915 1.51201C16.0414 1.05489 15.4963 0.699691 14.8986 0.474702C14.3255 0.253147 13.6714 0.0984842 12.715 0.0563159C11.7515 0.0105764 11.4456 0 9.00174 0C6.55791 0 6.25202 0.0105764 5.29204 0.0527447C4.33563 0.0949129 3.67811 0.249713 3.1085 0.471131C2.50358 0.699691 1.96213 1.05132 1.51201 1.51201C1.05489 1.96213 0.699827 2.50716 0.474701 3.10493C0.253147 3.67812 0.098484 4.33207 0.0563158 5.28848C0.0105764 6.25203 0 6.55792 0 9.00176C0 11.4456 0.0105764 11.7515 0.0527446 12.7115C0.0949128 13.6679 0.249713 14.3254 0.471267 14.8952C0.699827 15.4999 1.05489 16.0414 1.51201 16.4915C1.96213 16.9486 2.50715 17.3038 3.10493 17.5288C3.67811 17.7504 4.33206 17.905 5.28861 17.9472C6.24845 17.9895 6.55448 17.9999 8.99831 17.9999C11.4421 17.9999 11.748 17.9895 12.708 17.9472C13.6644 17.905 14.3219 17.7504 14.8916 17.5288C16.1012 17.0611 17.0577 16.1047 17.5254 14.8952C17.7468 14.322 17.9016 13.6679 17.9437 12.7115C17.9859 11.7515 17.9965 11.4456 17.9965 9.00176C17.9965 6.55792 17.9929 6.25203 17.9507 5.29205ZM16.3298 12.6411C16.2911 13.5202 16.1434 13.9949 16.0203 14.3114C15.7179 15.0956 15.0955 15.7179 14.3114 16.0204C13.9949 16.1434 13.5168 16.2911 12.6411 16.3297C11.6917 16.372 11.407 16.3824 9.00531 16.3824C6.60365 16.3824 6.31534 16.372 5.36937 16.3297C4.4903 16.2911 4.01559 16.1434 3.69913 16.0204C3.3089 15.8761 2.9537 15.6476 2.66539 15.3487C2.3665 15.0568 2.13794 14.7052 1.99372 14.315C1.87065 13.9985 1.72299 13.5202 1.68439 12.6447C1.64209 11.6953 1.63165 11.4104 1.63165 9.00876C1.63165 6.60709 1.64209 6.31878 1.68439 5.37295C1.72299 4.49387 1.87065 4.01917 1.99372 3.7027C2.13794 3.31234 2.3665 2.95727 2.66896 2.66883C2.9607 2.36994 3.31233 2.14138 3.7027 1.99729C4.01917 1.87422 4.49744 1.72656 5.37294 1.68783C6.32235 1.64566 6.60722 1.63508 9.00875 1.63508C11.414 1.63508 11.6987 1.64566 12.6447 1.68783C13.5238 1.72656 13.9985 1.87422 14.3149 1.99729C14.7052 2.14138 15.0604 2.36994 15.3487 2.66883C15.6476 2.96071 15.8761 3.31234 16.0203 3.7027C16.1434 4.01917 16.2911 4.49731 16.3298 5.37295C16.372 6.32236 16.3826 6.60709 16.3826 9.00876C16.3826 11.4104 16.372 11.6917 16.3298 12.6411Z"
                                                    fill="#25252E"></path>
                                                <path
                                                    d="M9.00188 4.37695C6.44912 4.37695 4.37793 6.44801 4.37793 9.0009C4.37793 11.5538 6.44912 13.6249 9.00188 13.6249C11.5548 13.6249 13.6258 11.5538 13.6258 9.0009C13.6258 6.44801 11.5548 4.37695 9.00188 4.37695ZM9.00188 12.0003C7.34578 12.0003 6.00244 10.6571 6.00244 9.0009C6.00244 7.34467 7.34578 6.00146 9.00188 6.00146C10.6581 6.00146 12.0013 7.34467 12.0013 9.0009C12.0013 10.6571 10.6581 12.0003 9.00188 12.0003Z"
                                                    fill="#25252E"></path>
                                                <path
                                                    d="M14.8876 4.19472C14.8876 4.79085 14.4043 5.2742 13.808 5.2742C13.2119 5.2742 12.7285 4.79085 12.7285 4.19472C12.7285 3.59845 13.2119 3.11523 13.808 3.11523C14.4043 3.11523 14.8876 3.59845 14.8876 4.19472Z"
                                                    fill="#25252E"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty($i->social_linkedin))
                                    <li class="list-inline-item">
                                        <a href="{{$i->social_linkedin}}" tabindex="0">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.9955 18.0002V17.9994H18V11.3979C18 8.16841 17.3047 5.68066 13.5292 5.68066C11.7142 5.68066 10.4962 6.67666 9.99896 7.62091H9.94646V5.98216H6.3667V17.9994H10.0942V12.0489C10.0942 10.4822 10.3912 8.96716 12.3315 8.96716C14.2432 8.96716 14.2717 10.7552 14.2717 12.1494V18.0002H17.9955Z"
                                                    fill="#25252E"></path>
                                                <path d="M0.296997 5.98242H4.029V17.9997H0.296997V5.98242Z"
                                                    fill="#25252E"></path>
                                                <path
                                                    d="M2.1615 0C0.96825 0 0 0.96825 0 2.1615C0 3.35475 0.96825 4.34325 2.1615 4.34325C3.35475 4.34325 4.323 3.35475 4.323 2.1615C4.32225 0.96825 3.354 0 2.1615 0V0Z"
                                                    fill="#25252E"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty($i->social_twitter))
                                    <li class="list-inline-item">
                                        <a href="{{$i->social_twitter}}" tabindex="0">
                                            <svg width="18" height="15" viewBox="0 0 18 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 1.73137C17.3306 2.025 16.6174 2.21962 15.8737 2.31412C16.6388 1.85737 17.2226 1.13962 17.4971 0.2745C16.7839 0.69975 15.9964 1.00013 15.1571 1.16775C14.4799 0.446625 13.5146 0 12.4616 0C10.4186 0 8.77387 1.65825 8.77387 3.69113C8.77387 3.98363 8.79862 4.26487 8.85938 4.53262C5.7915 4.383 3.07687 2.91263 1.25325 0.67275C0.934875 1.22513 0.748125 1.85738 0.748125 2.538C0.748125 3.816 1.40625 4.94887 2.38725 5.60475C1.79437 5.5935 1.21275 5.42138 0.72 5.15025C0.72 5.1615 0.72 5.17613 0.72 5.19075C0.72 6.984 1.99912 8.4735 3.6765 8.81662C3.37612 8.89875 3.04875 8.93812 2.709 8.93812C2.47275 8.93812 2.23425 8.92463 2.01038 8.87512C2.4885 10.3365 3.84525 11.4109 5.4585 11.4457C4.203 12.4279 2.60888 13.0196 0.883125 13.0196C0.5805 13.0196 0.29025 13.0061 0 12.969C1.63462 14.0231 3.57188 14.625 5.661 14.625C12.4515 14.625 16.164 9 16.164 4.12425C16.164 3.96112 16.1584 3.80363 16.1505 3.64725C16.8829 3.1275 17.4982 2.47837 18 1.73137Z"
                                                    fill="#25252E"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty($i->social_youtube))
                                    <li class="list-inline-item">
                                        <a href="{{$i->social_youtube}}" tabindex="0">
                                            <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M16.0427 0.885481C16.8137 1.09312 17.4216 1.70094 17.6291 2.47204C18.0148 3.88048 17.9999 6.81629 17.9999 6.81629C17.9999 6.81629 17.9999 9.73713 17.6293 11.1457C17.4216 11.9167 16.8138 12.5246 16.0427 12.7321C14.6341 13.1029 8.99996 13.1029 8.99996 13.1029C8.99996 13.1029 3.38048 13.1029 1.95721 12.7174C1.18611 12.5098 0.57829 11.9018 0.37065 11.1309C0 9.73713 0 6.80146 0 6.80146C0 6.80146 0 3.88048 0.37065 2.47204C0.578153 1.70108 1.20094 1.07829 1.95707 0.870787C3.36565 0.5 8.99983 0.5 8.99983 0.5C8.99983 0.5 14.6341 0.5 16.0427 0.885481ZM11.8913 6.80154L7.20605 9.50006V4.10303L11.8913 6.80154Z"
                                                    fill="#25252E"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif                                    
                                </ul>
                            </div>
                            <div class="mentor__title">
                                <h6>
                                    <a href="{{route('instructorProfile', encryptor('encrypt', $i->id))}}"
                                        tabindex="0">{{$i->name_en}}</a>
                                </h6>
                                <p>{{$i->designation}}</p>
                            </div>
                        </div>
                        @empty
                        @endforelse
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-instructor-featured-shape">
        <img src="{{asset('frontend/dist/images/shape/dots/dots-img-14.png')}}" alt="shape"
            class="img-fluid shape01" />
        <img src="{{asset('frontend/dist/images/shape/triangel2.png')}}" alt="shape" class="img-fluid shape02" />
    </div>
</section>
@endsection

@push('scripts')
@endpush