<!DOCTYPE html>
<html lang="{{str_replace('_','_', app()->getLocale())}}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- <link href="{{asset('frontend/summernote/summernote-lite.min.css')}}" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @stack('styles')
    <style>
       /* Ensure long URLs wrap properly */
.long-url {
    word-break: break-all; /* Allows the URL to break within words if necessary */
    overflow-wrap: break-word; /* Ensures the URL breaks in small containers */
    white-space: normal; /* Allows the text to wrap normally */
    width: 100%; /* Ensure the URL takes up available space */
}

/* Alternative: Truncate the URL with ellipsis if it overflows */
.ellipsis-url {
    display: block;
    max-width: 100%;        /* Ensure it fits the container */
    white-space: nowrap;    /* Prevent wrapping */
    overflow: hidden;       /* Hide the overflow */
    text-overflow: ellipsis; /* Show ellipsis if text overflows */
    word-break: break-word; /* Prevents breaking in the middle of URLs */
}
    </style>
    <style>
        .progress {
    height: 20px;
    margin-top: 15px;
}


.progress-bar {
    background-color: green;
    transition: width 0.4s ease-in-out;
    font-size: 14px;
    font-weight: bold;
    line-height: 25px; /* Matches progress bar height for perfect centering */
}
    </style>
    <style>
      .scrollable-list {
    max-height: 100px; /* Limit the height */
    overflow-y: auto; /* Enable vertical scrolling */
    border: 1px solid #ddd; /* Optional: border for better visibility */
    padding: 10px;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.bullet-list {
    list-style-type: disc !important; /* Force bullets */
    padding-left: 20px; /* Indent to display bullets properly */
    margin: 0;
}

.bullet-list li {
    margin-bottom: 5px; /* Add spacing between items */
    font-size: 14px; /* Adjust font size for readability */
    color: #333; /* Optional: Set text color */
}
    </style>
    <style>
    .scrollable-list-container {
    max-height: 350px; /* Adjust height as needed */
    overflow-y: auto; /* Enables vertical scrolling */
    overflow-x: hidden; /* Prevents horizontal scrolling */
    border: 1px solid #ddd; /* Optional: adds a border for clarity */
    padding: 10px; /* Optional: spacing around the list */
    background-color: #fff; /* Optional: ensures the background stays consistent */
}

/* Optional: Add a scrollbar style for better aesthetics */
.scrollable-list-container::-webkit-scrollbar {
    width: 8px;
}

.scrollable-list-container::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}

.scrollable-list-container::-webkit-scrollbar-thumb:hover {
    background: #999;
}

</style>
</head>

<body>


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
                <img class="logo-abbr" src="{{asset('images/kdh_logo.png')}}" alt="">
                <img class="logo-compact" src="{{asset('images/h-logo.png')}}" alt="">
                <img class="brand-title" src="{{asset('images/h-logo.png')}}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <!-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                                    <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                        unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" title="Profile Info" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{asset('uploads/users/'.request()->session()->get('image'))}}"
                                        width="20" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                @if(Auth::check() && auth()->user()->role_id == 1)
                                    <a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    @elseif(Auth::check() && auth()->user()->role_id == 2) 
                                    <a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    @elseif(Auth::check() && auth()->user()->role_id == 3)
                                    <a href="{{route('instructor.edit', encryptor('encrypt',auth()->user()->instructor_id))}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    @else
                                    <script>
                                        window.location.href = "{{ route('logOut') }}";
                                    </script>
                                    @endif
                                    <!-- <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="ml-2">Inbox </span>
                                    </a> -->
                                    <a href="{{route('logOut')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-log-out">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @if(fullAccess())
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Admin Panel</li>
                    <li><a class="ai-icon" href="{{route('home')}}" aria-expanded="false">
                            <i class="las la-home"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li><a class="ai-icon" href="{{route('dashboard')}}" aria-expanded="false">
                            <i class="las la-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li> 
                    @if(Auth::check() && auth()->user()->role_id == 1) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>   
                    @elseif(Auth::check() && auth()->user()->role_id == 2) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>  
                    @elseif(Auth::check() && auth()->user()->role_id == 3)     
                    <li><a href="{{route('instructor.edit', encryptor('encrypt',auth()->user()->instructor_id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li> 
                    @else
                    <script>
                        window.location.href = "{{ route('logOut') }}";
                    </script>
                    @endif        
                    <li class="nav-label">Main Menu</li>
                    <li><a class="" href="{{route('role.index')}}" aria-expanded="false">
                            <i class="las la-cog"></i>
                            <span class="nav-text">Permissions</span>
                        </a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-universal-access"></i>
                            <span class="nav-text">Roles</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('user.index')}}"><i class="la la-users"></i>Users</a></li>
                            <li><a href="{{route('instructor.index')}}"><i
                                        class="las la-chalkboard-teacher"></i>Instructors</a>
                            </li>
                            <li><a href="{{route('student.index')}}"><i class="las la-book-reader"></i>Students</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-school"></i>
                            <span class="nav-text">Courses</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('courseCategory.index')}}"><i class="la la-list"></i>Course
                                    Category</a>
                            </li>
                            <li><a href="{{route('courseList')}}"><i class="las la-school"></i>Courses List</a></li>
                            <li><a href="{{route('course.index')}}"><i class="las la-book-open"></i>All Courses</a></li>
                            <!-- <li><a href="{{route('lesson.index')}}"><i class="las la-chalkboard"></i>Lessons</a></li> -->
                            <!-- <li><a href="{{route('material.index')}}"><i class="las la-atom"></i></i>Materials</a></li> -->
                        </ul>
                    </li>
                    <li><a class="" href="{{route('enrollment.index')}}" aria-expanded="false">
                            <i class="las la-bullseye"></i>
                            <span class="nav-text">Enrollments</span>
                        </a>
                    </li>
                    <li><a class="" href="{{route('event.index')}}" aria-expanded="false">
                            <i class="las la-icons"></i>
                            <span class="nav-text">Events</span>
                        </a>
                    </li>
                    <li><a class="" href="{{route('coupon.index')}}" aria-expanded="false">
                            <i class="las la-tags"></i>
                            <span class="nav-text">Coupons</span>
                        </a>
                    </li>
                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-tasks"></i>
                            <span class="nav-text">Quizzes</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('quiz.index')}}"><i class="las la-icons"></i>All Quizzes</a></li>
                            <li><a href="{{route('question.index')}}"><i
                                        class="las la-question-circle"></i>Questions</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-clipboard-list"></i> <!-- Clipboard list icon for project -->
                            <span class="nav-text">Project</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="#"><i class="las la-folder-open"></i> All Projects</a> <!-- Folder open icon -->
                            </li>
                            <!-- Uncomment if needed -->
                            <!-- <li>
                                <a href="{{route('question.index')}}"><i class="las la-question-circle"></i> Questions</a>
                            </li> -->
                        </ul>
                    </li>
                    <li><a class="" href="{{route('certificates.index')}}" aria-expanded="false">
                    <i class="las la-atom"></i>
                            <span class="nav-text">Certificates</span>
                        </a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-star-half-alt"></i>
                            <span class="nav-text">Reviews</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('review.index')}}"><i class="las la-wave-square"></i>All Review</a>
                            </li>
                            <li><a href="{{route('review.index')}}"><i class="las la-star"></i>Ratings</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-comment"></i>
                            <span class="nav-text">Forum</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('discussion.index')}}"><i class="las la-comment-alt"></i>Discussion</a>
                            </li>
                            <li><a href="{{route('message.index')}}"><i class="las la-envelope"></i>Messages</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-money-check"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('courseFee')}}"><i class="las la-money-bill"></i>Course Payments</a></li>
                            <li><a href="{{route('subscriptionPlan.index')}}"><i class="las la-money-bill"></i>Subscription Plans</a></li>
                            <li><a href="{{route('subscription.index')}}"><i class="las la-money-bill"></i>Subscription Fees</a></li>
                            <li><a href="{{route('coupon.index')}}"><i class="las la-tags"></i>Coupons</a></li>
                        </ul>
                    </li> 
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-file-alt"></i>
                            <span class="nav-text">Report</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{route('customPlan')}}">
                                    <i class="las la-file-signature"></i> Custom Plan Request
                                </a>
                            </li>
                            <li>
                                <a href="{{route('contactReport')}}">
                                    <i class="las la-address-book"></i> Contact Report
                                </a>
                            </li>                            
                        </ul>
                    </li>
                    <li><a class="" href="{{route('logOut')}}" aria-expanded="false">
                            <i class="lab la-gg-circle"></i>
                            <span class="nav-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif

        @if(!fullAccess())
        <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">Instructor Panel</li>
                <li><a class="ai-icon" href="{{route('home')}}" aria-expanded="false">
                        <i class="las la-home"></i><span class="nav-text">Home</span>
                    </a>
                </li>
                <li><a class="ai-icon" href="{{route('dashboard')}}" aria-expanded="false">
                        <i class="las la-tachometer-alt"></i> <span class="nav-text">Dashboard</span>
                    </a>
                </li>  
                @if(Auth::check() && auth()->user()->role_id == 1) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>   
                    @elseif(Auth::check() && auth()->user()->role_id == 2) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>  
                    @elseif(Auth::check() && auth()->user()->role_id == 3)     
                    <li><a href="{{route('instructor.edit', encryptor('encrypt',auth()->user()->instructor_id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li> 
                    @else
                    <script>
                        window.location.href = "{{ route('logOut') }}";
                    </script>
                    @endif                     
                <li class="nav-label">Main Menu</li>                
                <!-- <li><a href="{{route('student.index')}}"><i class="las la-book-reader"></i>Students List</a></li> -->
                <li><a href="{{route('course.index')}}"><i class="las la-book-open"></i>My Courses</a></li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-tasks"></i>
                            <span class="nav-text">Quiz</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('quiz.index')}}"><i class="las la-icons"></i>All Quiz</a></li>
                            <!-- <li><a href="{{route('question.index')}}"><i
                                        class="las la-question-circle"></i>Questions</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-clipboard-list"></i> <!-- Clipboard list icon for project -->
                            <span class="nav-text">Project</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{route('project.index')}}"><i class="las la-folder-open"></i> All Projects</a> <!-- Folder open icon -->
                            </li>
                            <!-- Uncomment if needed -->
                            <!-- <li>
                                <a href="{{route('question.index')}}"><i class="las la-question-circle"></i> Questions</a>
                            </li> -->
                        </ul>
                    </li>
                    <li><a class="" href="{{route('certificates.index')}}" aria-expanded="false">
                    <i class="las la-atom"></i>
                            <span class="nav-text">Certificates</span>
                        </a>
                    </li>
                    <li><a href="{{route('coupon.index')}}"><i class="las la-tags"></i>Coupons</a></li>
                    <li><a class="" href="{{route('enrollment.index')}}" aria-expanded="false">
                            <i class="las la-bullseye"></i>
                            <span class="nav-text">Enrollments</span>
                        </a>
                    </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-money-check"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('courseFee')}}"><i class="las la-money-bill"></i>Course Payments</a></li>
                            <li><a href="{{route('subscription.view')}}"><i class="las la-money-bill"></i>Subscription</a></li>                            
                        </ul>
                    </li> 
                    <li><a href="{{route('instructor.index')}}">
                        <i class="las la-chalkboard-teacher"></i>Instructors List
                    </a>
                </li>
                <!-- <li><a href="{{route('enrollment.index')}}"><i class="las la-bullseye"></i>Enrollments</a></li> -->
                <li><a href="{{route('logOut')}}"><i class="lab la-gg-circle"></i>Logout</a></li>
            </ul>
        </div>
        </div>
        @endif
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->

        @yield('content')

        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Powered by <a href="{{route('about')}}" target="_blank">Kings Digital Literacy Hub</a> 2023 - <?php echo date('Y') ?></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('vendor/global/global.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/dlabnav-init.js')}}"></script>

    <!-- Svganimation scripts -->
    <script src="{{asset('vendor/svganimation/vivus.min.js')}}"></script>
    <script src="{{asset('vendor/svganimation/svg.animation.js')}}"></script>
    <script src="{{asset('js/styleSwitcher.js')}}"></script>

    @stack('scripts')
    {{-- TOASTER --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <script>
        @if(Session::has('success'))  
    				toastr.success("{{ Session::get('success') }}");  
    		@endif  
    		@if(Session::has('info'))  
    				toastr.info("{{ Session::get('info') }}");  
    		@endif  
    		@if(Session::has('warning'))  
    				toastr.warning("{{ Session::get('warning') }}");  
    		@endif  
    		@if(Session::has('error'))  
    				toastr.error("{{ Session::get('error') }}");  
    		@endif  
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    {!! Toastr::message() !!}

   
<!-- <script src="{{asset('frontend/summernote/summernote-lite.min.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myEditor').summernote({
      height: 200
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#comment').summernote({
      height: 120
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#edit-comment').summernote({
      height: 120
    });
  });
</script>
</body>

</html>