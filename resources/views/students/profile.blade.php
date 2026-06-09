@extends('frontend.layouts.student-app')
@section('title', "Student's Profile")
@section('body-attr') style="background-color: #ebebf2;" @endsection

@section('content')

<!-- Breadcrumb Starts Here -->
<div class="py-0">
    <div class="container">
        <div class="lms-header-card">

            <!-- LEFT SIDE: Title + Breadcrumb -->
            <div class="lms-header-left">

                <h1 class="lms-page-title">
                    My Profile
                </h1>

                <!-- <nav aria-label="breadcrumb" class="lms-breadcrumb-nav">
                    <ol class="breadcrumb mb-0">

                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            My Profile
                        </li>

                    </ol>
                </nav> -->

            </div>

            <!-- RIGHT SIDE: QUICK ACTIONS -->
            <div class="lms-header-right">
                <button class="lms-nav-item active" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                        aria-selected="true">My Profile</button>

                    <button class="lms-nav-item" id="nav-setting-tab" data-bs-toggle="tab" data-bs-target="#nav-setting"
                        type="button" role="tab" aria-controls="nav-setting" aria-selected="false">Setting</button>
                    <button class="lms-nav-item"><a href="{{route('studentdashboard')}}" class="text-secondary">My Dashboard</a></button>
                <!-- <a href="#" class="lms-btn lms-btn-outline">
                    <i class="fa fa-book"></i> Setting
                </a>

                <a href="#" class="lms-btn lms-btn-primary">
                    <i class="fa fa-plus"></i> My Dashboard
                </a> -->

            </div>

        </div>
    </div>
</div>

<!-- Students Info area Starts Here -->
<section class="section students-info">
    <div class="container">
        <!-- <div class="students-info-intro">

            <div class="students-info-intro__profile">

                <div class="students-info-intro-start">

                    <div class="image">
                        <img src="{{ asset('uploads/students/' . $student_info->image) }}"
                            alt="Student"
                            onerror="this.onerror=null;this.src='{{ asset('uploads/students/blank_new.png') }}';"/>
                    </div>

                    <div class="text">
                        <h5>{{ $student_info->name_en }}</h5>
                        <p>{{ $student_info->profession ?: 'Student' }}</p>

                        <span class="student-badge">
                            <i class="fas fa-graduation-cap"></i>
                            Active Student
                        </span>
                    </div>

                </div>

                <div class="students-info-intro-end">

                    <div class="enrolled-courses">
                        <div class="enrolled-courses-icon">
                            <i class="fas fa-book-open"></i>
                        </div>

                        <div class="enrolled-courses-text">
                            <h6>{{ $enrollment ? $enrollment->count() : 0 }}</h6>
                            <p style="color: white; font-weight: bold;">Enrolled</p>
                        </div>
                    </div>

                    <div class="completed-courses">
                        <div class="completed-courses-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>

                        <div class="completed-courses-text">
                            <h5>{{ $completedCourses }}</h5>
                            <p style="color: white; font-weight: bold;">Completed</p>
                        </div>
                    </div>

                </div>

            </div>
           
            <nav class="lms-dashboard-nav">
                
                <div class="lms-dashboard-nav-inner" id="nav-tab" role="tablist">
                    <button class="lms-nav-item active" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                        aria-selected="true">My Profile</button>

                    <button class="lms-nav-item" id="nav-setting-tab" data-bs-toggle="tab" data-bs-target="#nav-setting"
                        type="button" role="tab" aria-controls="nav-setting" aria-selected="false">Setting</button>
                    <button class="lms-nav-item"><a href="{{route('studentdashboard')}}" class="text-secondary">My Dashboard</a></button>
                </div>
            </nav>
        </div> -->

        <div class="students-info-main">
            <div class="tab-content" id="nav-tabContent">
                {{-- Profile Info --}}
                <div class="tab-pane fade show active"
                    id="nav-profile"
                    role="tabpanel"
                    aria-labelledby="nav-profile-tab">

                    <div class="student-profile-grid">

                        {{-- About Student --}}
                        <div class="profile-card profile-about-card">

                            <div class="profile-card-header">
                                <div class="profile-icon">
                                    <i class="fa fa-user"></i>
                                </div>

                                <div>
                                    <h5>About Me</h5>
                                    <span>Personal Bio</span>
                                </div>
                            </div>

                            <div class="profile-card-body">
                                <p>
                                    {{ $student_info->bio ?: "Welcome to my learning journey. I'm excited to grow my knowledge and skills through this platform." }}
                                </p>
                            </div>

                        </div>

                        {{-- Student Information --}}
                        <div class="profile-card">

                            <div class="profile-card-header">
                                <div class="profile-icon">
                                    <i class="fa fa-id-card"></i>
                                </div>

                                <div>
                                    <h5>{{ $student_info->name_en }}</h5>
                                    <span>Student Information</span>
                                </div>
                            </div>

                            <div class="profile-card-body">

                                <div class="profile-info-list">

                                    <div class="profile-info-item">
                                        <span class="label">
                                            <i class="fa fa-user"></i>
                                            Full Name
                                        </span>
                                        <span class="value">
                                            {{ $student_info->name_en }}
                                        </span>
                                    </div>

                                    <div class="profile-info-item">
                                        <span class="label">
                                            <i class="fa fa-envelope"></i>
                                            Email Address
                                        </span>
                                        <span class="value">
                                            {{ $student_info->email }}
                                        </span>
                                    </div>

                                    <div class="profile-info-item">
                                        <span class="label">
                                            <i class="fa fa-briefcase"></i>
                                            Profession
                                        </span>
                                        <span class="value">
                                            {{ $student_info->profession ?: 'Student' }}
                                        </span>
                                    </div>

                                    <div class="profile-info-item">
                                        <span class="label">
                                            <i class="fa fa-phone"></i>
                                            Phone Number
                                        </span>
                                        <span class="value">
                                            {{ $student_info->contact_en ?: 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="profile-info-item">
                                        <span class="label">
                                            <i class="fa fa-globe"></i>
                                            Nationality
                                        </span>
                                        <span class="value">
                                            {{ $student_info->nationality ?: 'N/A' }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                
                {{----Settings-----}}
                <div class="tab-pane fade"
                    id="nav-setting"
                    role="tabpanel"
                    aria-labelledby="nav-setting-tab">

                    <div class="settings-layout">

                        {{-- Main Content --}}
                        <div class="settings-main">

                            {{-- Profile Information --}}
                            <div class="settings-card">

                                <div class="settings-card-header">
                                    <div class="settings-icon">
                                        <i class="fa fa-user-circle"></i>
                                    </div>

                                    <div>
                                        <h5>Profile Information</h5>
                                        <span>Manage your personal information</span>
                                    </div>
                                </div>

                                <form action="{{ route('student_save_profile') }}"
                                    method="POST">

                                    @csrf

                                    <div class="settings-form-grid">

                                        <div class="form-group-modern">
                                            <label>Full Name</label>
                                            <input type="text"
                                                class="form-control"
                                                name="fullName_en"
                                                value="{{ $student_info->name_en }}"
                                                placeholder="Enter Full Name">
                                        </div>

                                        <div class="form-group-modern">
                                            <label>Date of Birth</label>
                                            <input type="date"
                                                class="form-control"
                                                name="dob">
                                        </div>

                                        <div class="form-group-modern full-width">
                                            <label>Email Address</label>
                                            <input type="email"
                                                class="form-control"
                                                name="emailAddress"
                                                value="{{ $student_info->email }}"
                                                placeholder="Enter Email Address">
                                        </div>

                                        <div class="form-group-modern full-width">
                                            <label>Profession</label>
                                            <input type="text"
                                                class="form-control"
                                                name="profession"
                                                value="{{ $student_info->profession }}"
                                                placeholder="What do you do?">
                                        </div>

                                        <div class="form-group-modern">
                                            <label>Phone Number</label>
                                            <input type="text"
                                                class="form-control"
                                                name="contactNumber_en"
                                                value="{{ $student_info->contact_en }}"
                                                placeholder="Phone Number">
                                        </div>

                                        <div class="form-group-modern">
                                            <label>Nationality</label>
                                            <input type="text"
                                                class="form-control"
                                                name="nationality"
                                                value="{{ $student_info->nationality }}"
                                                placeholder="Nationality">
                                        </div>

                                        <div class="form-group-modern full-width">
                                            <label>About You</label>
                                            <textarea class="form-control"
                                                    rows="5"
                                                    name="bio"
                                                    placeholder="Tell us about yourself">{{ $student_info->bio }}</textarea>
                                        </div>

                                    </div>

                                    <div class="settings-action">
                                        <button class="settings-btn-primary">
                                            Save Profile Changes
                                        </button>
                                    </div>

                                </form>

                            </div>

                            {{-- Security --}}
                            <div class="settings-card">

                                <div class="settings-card-header">
                                    <div class="settings-icon security">
                                        <i class="fa fa-lock"></i>
                                    </div>

                                    <div>
                                        <h5>Security Settings</h5>
                                        <span>Update your password</span>
                                    </div>
                                </div>

                                <form action="{{ route('change_password') }}"
                                    method="POST">

                                    @csrf

                                    <!-- <div class="form-group-modern">
                                        <label>Current Password</label>

                                        <div class="input-with-icon">
                                            <input type="password"
                                                id="cpass"
                                                name="current_password"
                                                class="form-control">

                                            <div class="input-icon"
                                                onclick="showPassword('cpass',this)">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="form-group-modern">
                                        <label>New Password</label>

                                        <div class="input-with-icon">
                                            <input type="password"
                                                id="npass"
                                                name="password"
                                                class="form-control">

                                            <div class="input-icon"
                                                onclick="showPassword('npass',this)">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group-modern">
                                        <label>Confirm Password</label>

                                        <div class="input-with-icon">
                                            <input type="password"
                                                id="cnpass"
                                                name="password_confirmation"
                                                class="form-control">

                                            <div class="input-icon"
                                                onclick="showPassword('cnpass',this)">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="settings-action">
                                        <button class="settings-btn-primary">
                                            Update Password
                                        </button>
                                    </div>

                                </form>

                            </div>

                        </div>

                        {{-- Sidebar --}}
                        <div class="settings-sidebar">

                            <div class="settings-card profile-image-card">

                                <div class="student-avatar-wrap">

                                    <img src="{{ asset('uploads/students/' . $student_info->image) }}"
                                        alt="Student"
                                        onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                    <h6>{{ $student_info->name_en }}</h6>

                                    <span>
                                        {{ $student_info->profession ?: 'Student' }}
                                    </span>

                                </div>

                                <form id="changeImageForm"
                                    action="{{ route('change_image') }}"
                                    method="POST"
                                    enctype="multipart/form-data">

                                    @csrf

                                    <input type="file"
                                        name="image"
                                        id="newImageInput">

                                    <button type="button"
                                            id="changeImageButton"
                                            class="settings-btn-outline">
                                        Change Profile Photo
                                    </button>

                                </form>

                                <small class="upload-note">
                                    JPG, PNG • Max Size 1MB
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
            // Hide the file input initially
            $('#newImageInput').hide();
    
            // Trigger the file input when the button is clicked
            $('#changeImageButton').click(function() {
                $('#newImageInput').click();
            });
    
            // Automatically submit the form when a file is selected
            $('#newImageInput').change(function() {
                $('#changeImageForm').submit();
            });
        });
</script>
@endpush