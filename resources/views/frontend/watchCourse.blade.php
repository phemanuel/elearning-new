<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }} | @yield('title', 'Watch Course')</title>
    <link rel="stylesheet" href="{{asset('frontend/src/scss/vendors/plugin/css/video-js.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/src/scss/vendors/plugin/css/star-rating-svg.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/dist/main.css')}}" />
    <link rel="icon" type="image/png" href="{{asset('frontend/dist/images/favicon/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('frontend/fontawesome-free-5.15.4-web/css/all.min.css')}}">
    <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
<style>
    .highlight {
        background-color: #e0f7fa; /* Light blue background for highlighting */
        border-left: 4px solid #007bff; /* Blue left border for additional emphasis */
    }
    
    .text-frame, .document-frame {
        max-height: 700px; /* Set your desired height */
        overflow-y: auto;  /* Enable vertical scrolling */
        border: 2px solid #ccc; /* Optional: Border for visual separation */
        padding: 10px; /* Optional: Padding for better spacing */
        background-color: #f9f9f9; /* Optional: Background color */
    }
    
</style>
<style>
    /* General video area styles */
/* Lesson Container */
#lesson-container {
    position: relative;
    height: auto; /* Set height as needed */
    margin-bottom: 5px; /* Spacing below the lesson container */
    overflow: hidden; /* Prevent overflow and keep things within bounds */
}

/* Video and Text Areas */
.video-area, 
.text-area {
    height: auto; /* Set desired height */
    position: relative;
    overflow: hidden; /* Prevent content from overflowing */
}

/* Video and Text Containers */
.video-container, 
.text-container {
    width: 100%; /* Ensure full width */
    margin: auto; /* Center the content */
    position: relative; /* Control stacking */
    z-index: 1; /* Set lower z-index to prevent overlap */
}

/* Styling for Containers */
.video-container, 
.text-frame {
    padding: 15px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow effect */
}

/* Lesson Card and Tab Container */
.lesson-card, 
#tab-container {
    position: relative;
    z-index: 1; /* Ensure they appear on top */
}

/* Lesson button navigation */
/* Lesson Navigation (Make sure it stays below lesson container) */
.card.lesson-card {
    position: relative; /* Ensure it stays within the flow */
    width: 100%; /* Take full width */
    margin-top: 5px; /* Space between content and navigation */
    margin-bottom: 5px;
    text-align: center;
    box-sizing: border-box;
}

/* Lesson Navigation Buttons */
.lesson-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

/* Button Styling */
.btn {
    font-size: 16px;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    color: white;
    cursor: pointer;
}

/* Button Colors */
.prev-lesson {
    background-color: rgb(8, 84, 70);  /* Dark Green */
}

.next-lesson {
    background-color: rgb(7, 12, 114);  /* Dark Blue */
}

/* Disabled Button Style */
.btn:disabled {
    background-color: gray;
    cursor: not-allowed;
}

/* Styling for the Quiz Button */
#quiz-button {
    background-color:rgb(101, 6, 89); /* Gold background (adjust to match your branding) */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

#quiz-button:hover {
    background-color:rgb(66, 2, 65); /* Darker gold shade on hover */
}

#quiz-button:active {
    background-color: rgb(66, 2, 65); /* Even darker gold shade on click */
}



/* Ensure the video fills the container properly */
/* .video-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; 
    object-fit: contain; 
} */

/* Customize video.js skin */
/* .video-js {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
} */

/* Ensure fullscreen and volume controls are visible */
/* .video-js .vjs-volume-panel,
.video-js .vjs-fullscreen-control {
    display: inline-block;
} */

/* Optionally hide default browser controls panel (if needed) */
 /* video::-webkit-media-controls-panel {
    display: none !important; 
}  */

/* Prevent selection and copying */
body {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>

<style>
.videolist-area-bar {
    background-color: #e0e0e0; /* Light grey for the background */
    border-radius: 5px; /* Rounded corners for the background */
    height: 5px; /* Height of the progress bar */
    position: relative; /* For positioning the icon */
}

.videolist-area-bar--progress {
    background-color: green; /* Progress bar color */
    display: block;
    height: 100%; /* Full height of the container */
    border-radius: 5px; /* Rounded corners for the progress bar */
}

.videolist-area-bar p {
    display: flex; /* Align icon and text */
    align-items: center; /* Center icon vertically with text */
}

.videolist-area-bar i {
    margin-right: 8px; /* Space between icon and text */
    color: green; /* Icon color */
}

</style>
<style>
    .star-rating {
    font-size: 2rem;
    color: #ccc; /* Default color for stars */
}

.star {
    cursor: pointer;
    transition: color 0.2s;
}

.star:hover,
.star.selected {
    color: gold; /* Change color when hovered or selected */
}
</style>
<style>
    .button--green {
    background-color: #28a745;
    color: #fff;
    padding: 13px 20px;
    border-radius: 5px;
    text-decoration: none;
}
.button--green:hover {
    background-color: #218838; /* Darker shade for hover effect */
    color: #fff;
}

.button--gold {
    background-color: darkgoldenrod; /* Set the background color to gold */
    color: #fff; /* Set the text color to white for contrast */
    padding: 13px 20px; /* Add padding for better appearance */
    border: none; /* Remove border */
    border-radius: 5px; /* Optional: rounded corners */
    text-decoration: none; /* Remove underline from link */
    display: inline-block; /* Ensures padding and margins work correctly */
    transition: background-color 0.3s; /* Add transition for hover effect */
}

.button--gold:hover {
    background-color: darkgoldenrod; /* Darken the gold on hover */
    color: #fff;
}
</style>
<style>
    .button--purple {
    background-color: #6f42c1; /* Bootstrap Purple */
    color: white;
    padding: 13px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.button--purple:hover {
    background-color: #59329c; /* Darker Purple on hover */
    color: #fff;
}
</style>
</head>

<body style="background-color: #ebebf2;">

    <!-- Title Starts Here -->
    <header class="bg-transparent">
        <div class="container-fluid">
            <div class="coursedescription-header">
                <div class="coursedescription-header-start">
                    <a class="logo-image" href="{{route('home')}}">
                        <img src="{{asset('frontend/dist/images/logo/new_logo.png')}}" alt="Logo" />
                    </a>
                    <div class="topic-info">
                        <div class="topic-info-arrow">
                            <a href="{{ route('courseSegment', encryptor('encrypt', $courseId)) }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <div class="topic-info-text">
                            <h6 class="font-title--xs"><a href="#">{{$segment->title_en}}
                            </a></h6>
                            <div class="lesson-hours">
                                <div class="book-lesson">
                                    <i class="fas fa-book-open text-primary"></i>
                                    <span>{{$lessons->count()}} Lesson</span>
                                </div>
                                <div class="totoal-hours">
                                @if($segmentProgress[$segment->id] == 100)
                                    <i class="fas fa-check-circle text-success"></i> 
                                    <span>{{ $segmentProgress[$segment->id] ?? 0 }}%</span>
                                @elseif($segmentProgress[$segment->id] < 100 && $segmentProgress[$segment->id] != 0)
                                    <i class="fas fa-spinner text-warning"></i> 
                                    <span>{{ $segmentProgress[$segment->id] ?? 0 }}%</span>
                                @elseif($segmentProgress[$segment->id] == 0 )
                                    <i class="far fa-clock text-danger"></i> 
                                    <span>{{ $segmentProgress[$segment->id] ?? 0 }}%</span>
                                @endif
                                    <!-- <i class="far fa-clock text-danger"></i>
                                    <span>{{ $segmentProgress[$segment->id] ?? 0 }}%</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="coursedescription-header-end">  
                @if($progress->completed == 1 && $stdSegment->segment == $totalCourseSegment)
                <a href="{{route('project-view', encryptor('encrypt', $courseId))}}" class="button button--purple">
                    <i class="fas fa-clipboard-list"></i> Project
                </a>
                @endif
                @if($enrollment->completed == 1)
                    <a href="{{ route('certificate.show', encryptor('encrypt', $course?->id)) }}" target="_blank" class="button button--gold">
                        <i class="fas fa-certificate"></i> Certificate
                    </a>
                @endif
                @if($progress->completed == 1 && $stdSegment->segment < $totalCourseSegment)
                    <a href="{{route('watchCourseNext', encryptor('encrypt', $courseId))}}" 
                    class="button button--green">
                        <i class="fas fa-arrow-right"></i> Next Segment
                    </a>
                @endif               
                
                <a href="#" class="button button--dark" data-bs-toggle="modal" data-bs-target="#ratingModal">
                    <i class="fas fa-star"></i> Leave a Rating
                </a>
                <a href="{{ route('studentdashboard') }}" class="button button--primary">
                    <i class="fas fa-user"></i> My Dashboard
                </a>              
                </div>
            </div>
        </div>
    </header>
    <!-- Ttile Ends Here -->

    <!-- Course Description Starts Here -->
    <div class="container-fluid" style="margin: 20px auto;">
        <div class="row course-description">              
            {{-- Video Area --}}
            <div class="col-lg-8">
                <div class="course-description-start">                    
                    <h5 class="font-title--sm material-title"> {{$currentLesson->title}}</h5>                     
                    <hr>                      
                    <!-- Lesson Container -->
                    <div id="lesson-container">
                        @if($currentMaterial->type == 'video')
                            <div class="video-area">                             
                                <div class="video-container">                             
                                    @if(!empty($currentMaterial->content))
                                    <video 
                                        id="myvideo" 
                                        class="video-js vjs-default-skin w-100" 
                                        controls controlsList="nodownload"
                                        preload="auto" 
                                        autoplay
                                        poster="{{ asset('uploads/courses/contents/' . $currentMaterial->content) }}">
                                        <source src="{{ asset('uploads/courses/contents/' . $currentMaterial->content) }}" type="video/mp4">
                                    </video>                                                                 
                                    @else
                                        <p>No valid content available for this lesson.</p>
                                    @endif
                                </div>
                            </div>
                        @elseif($currentMaterial->type == 'text')
                        <div class="text-area">
                            <div class="text-frame">
                                {!! $currentMaterial->content_data !!}
                            </div>
                        </div>
                        @elseif($currentMaterial->type == 'document')
                        <div class="text-area">
                            <div class="text-frame">
                                {!! $currentMaterial->content_data !!}
                            </div>
                        </div>
                        @else
                            <p>No valid content available for this lesson.</p>
                        @endif                    
                    </div>
                    <!-- Navigating Lessons in a Card -->
                    <div id ="lesson-navigate-container" class="card lesson-card" data-quiz-id="{{ $quiz->id }}">
                        <div class="lesson-navigation">
                            <button id="prev-lesson" disabled class="btn prev-lesson">
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
                            <button id="next-lesson" class="btn next-lesson">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                            <!-- Quiz Button -->
                            @if($questions->count() > 0)
                                @if($progress->completed != 1 && $progress->quiz_attempt == 0)  
                                <button id="quiz-button" style="display:none;"  
                                class="button button--primary start-quiz-btn" 
                                            data-quiz-id="{{$quiz->id}}"
                                            data-quiz-pass-mark="{{$quiz->pass_mark}}"
                                            data-student-id="{{$studentId}}"
                                            data-course-id="{{$course->id}}"
                                            data-segment-id="{{$segment->id}}"
                                            data-segment-no="{{$segment->segment_no}}">
                                    Start Quiz
                                </button>
                                @elseif($progress->completed != 1 && $progress->quiz_attempt >= 1)
                                    <button id="quiz-button" style="display:none;" 
                                    class="button button--primary start-quiz-btn" 
                                            data-quiz-id="{{$quiz->id}}"
                                            data-quiz-pass-mark="{{$quiz->pass_mark}}"
                                            data-student-id="{{$studentId}}"
                                            data-course-id="{{$course->id}}"
                                            data-segment-id="{{$segment->id}}"
                                            data-segment-no="{{$segment->segment_no}}">
                                        Re-take Quiz
                                    </button>
                                @elseif($progress->completed == 1 )
                                <button id="quiz-button" style="display:none;" class="btn quiz-btn">
                                        Quiz Completed
                                </button>
                                @else
                                <button id="quiz-button" style="display:none;" 
                                class="button button--primary start-quiz-btn" 
                                            data-quiz-id="{{$quiz->id}}"
                                            data-quiz-pass-mark="{{$quiz->pass_mark}}"
                                            data-student-id="{{$studentId}}"
                                            data-course-id="{{$course->id}}"
                                            data-segment-id="{{$segment->id}}"
                                            data-segment-no="{{$segment->segment_no}}">
                                        Re-take Quiz
                                </button>
                                @endif
                            @endif

                        </div>
                    </div>
                
                <!-- Quiz Section (Initially hidden) -->
                    <div id="quiz-container" style="display: none; border: 2px solid #ccc; padding: 20px; border-radius: 10px; margin: 20px auto; max-width: 100%; background-color: #fff;">
                        <div class="text-area">
                            <div class="text-container">
                                <!-- Question content with number -->
                                <div id="question-content" style="font-size: 28px; font-weight: bold; margin-bottom: 20px;"></div>
                                <br>
                                <!-- Options with A, B, C, D labels -->
                                <div id="options" style="font-size: 24px;">
                                    <label><input type="radio" name="answer" value="a"> A. <span id="option-a"></span></label><br>
                                    <label><input type="radio" name="answer" value="b"> B. <span id="option-b"></span></label><br>
                                    <label><input type="radio" name="answer" value="c"> C. <span id="option-c"></span></label><br>
                                    <label><input type="radio" name="answer" value="d"> D. <span id="option-d"></span></label>
                                </div>
                                <br>
                                <!-- Quiz navigation buttons -->
                                <div class="quiz-navigation" style="margin-top: 20px; text-align: center;">
                                    <button id="prev-question" disabled style="font-size: 16px; padding: 10px 15px; background-color: #f5a623; border: none; color: white; cursor: pointer;">Previous</button>
                                    <button id="next-question" style="font-size: 16px; padding: 10px 15px; background-color: #4a90e2; border: none; color: white; cursor: pointer;">Next</button>
                                    <button id="finish-quiz" style="display:none; font-size: 16px; padding: 10px 15px; background-color: #7ed321; border: none; color: white; cursor: pointer;">Finish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="tab-container">
                        <div class="course-description-start-content"> 
                                <nav class="course-description-start-content-tab">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-ldescrip-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-ldescrip" type="button" role="tab" aria-controls="nav-ldescrip"
                                            aria-selected="true">
                                            Lesson Description
                                        </button>
                                        <button class="nav-link" id="nav-lnotes-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-lnotes" type="button" role="tab" aria-controls="nav-lnotes"
                                            aria-selected="false">Lesson Notes</button>
                                        <button class="nav-link" id="nav-lcomments-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-lcomments" type="button" role="tab"
                                            aria-controls="nav-lcomments" aria-selected="false">Comments</button>
                                        <button class="nav-link" id="nav-loverview-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-loverview" type="button" role="tab"
                                            aria-controls="nav-loverview" aria-selected="false">Course Overview</button>
                                        <button class="nav-link" id="nav-linstruc-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-linstruc" type="button" role="tab" aria-controls="nav-linstruc"
                                            aria-selected="false">Instructor</button>
                                    </div>
                                </nav>                        
                            
                            <div class="tab-content course-description-start-content-tabitem" id="nav-tabContent">
                                <!-- Lesson Description Starts Here -->
                                <div class="tab-pane fade show active" id="nav-ldescrip" role="tabpanel"
                                    aria-labelledby="nav-ldescrip-tab">
                                    <div class="lesson-description">
                                        <p>
                                        {{$currentLesson->description}}
                                        </p>
                                    </div>
                                    <!-- Lesson Description Ends Here -->
                                </div>
                                <!-- Course Notes Starts Here -->
                                <div class="tab-pane fade" id="nav-lnotes" role="tabpanel" aria-labelledby="nav-lnotes-tab">
                                    <div class="course-notes-area">
                                        <div class="course-notes">
                                            <div class="course-notes-item">
                                                <p>
                                                {{$currentLesson->notes}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Course Notes Ends Here -->
                                </div>
                                <!-- Lesson Comments Starts Here -->
                            <div class="tab-pane fade" id="nav-lcomments" role="tabpanel"
                                    aria-labelledby="nav-lcomments-tab">
                                <div class="lesson-comments">
                                    <div class="feedback-comment pt-0 ps-0 pe-0">
                                        <h6 class="font-title--card">Add a Comment about this course.</h6>
                                        <form id="comment-form">
                                            @csrf
                                            <label for="comment">Comment</label>
                                            <textarea class="form-control" id="comment" name="comment" placeholder="Add a Comment" required></textarea>
                                            <input type="hidden" name="student_id" id="student_id" value="{{ $studentId }}">
                                            <input type="hidden" name="course_id" id="course_id" value="{{ $courseId }}">
                                            <button type="submit" class="button button-md button--primary float-end">Post Comment</button>
                                        </form>
                                    </div>

                                    <!-- Display Comments Section -->
                                    <div class="students-feedback pt-0 ps-0 pe-0 pb-0 mb-0">
                                        <div class="students-feedback-heading">
                                            <h5 class="font-title--card">Comments <span id="comment-count">({{ $course->reviews->count() }})</span></h5>
                                        </div>
                                        <div id="comments-container">
                                            <!-- Comments will be loaded here dynamically -->
                                            @foreach($course->reviews as $review)
                                                <div class="students-feedback-item">
                                                    <div class="feedback-rating">
                                                        <div class="feedback-rating-start">
                                                            <div class="image">
                                                                <img src="{{ $review->student->image ? asset('uploads/students/' . $review->student->image) : asset('frontend/dist/images/ellipse/2.png') }}" alt="Image"  />
                                                            </div>
                                                            <div class="text">
                                                                <h6><a href="#">{{ $review->student->name_en }}</a></h6>
                                                                <p>{{ $review->created_at->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- Lesson Comments Ends Here -->
                                </div>
                            </div>
                                <!-- Course Overview Starts Here -->
                                <div class="tab-pane fade" id="nav-loverview" role="tabpanel"
                                    aria-labelledby="nav-loverview-tab">
                                    <div class="row course-overview-main">
                                        <div class="course-overview-main-item">
                                            <h6 class="font-title--card">Description</h6>
                                            <p class="mb-3 font-para--lg">
                                            {{$course->description_en}}
                                            </p>
                                        </div>
                                        <div class="course-overview-main-item">
                                            <h6 class="font-title--card">Requirments</h6>
                                            <p class="mb-2 font-para--lg">
                                            {{$course->prerequisites_en}}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Course Overview Ends Here -->
                                </div>
                                <!-- course details instructor  -->
                                <div class="tab-pane fade" id="nav-linstruc" role="tabpanel"
                                    aria-labelledby="nav-linstruc-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="course-instructor mw-100">
                                                <div class="course-instructor-info">
                                                    <div class="instructor-image">
                                                        <img src="{{asset('uploads/users/'.$course?->instructor?->image)}}"
                                                            alt="Instructor" width="160" height="120" />
                                                    </div>
                                                    <div class="instructor-text">
                                                        <h6 class="font-title--xs">
                                                            <a href="{{route('instructorProfile', encryptor('encrypt', $course->instructor->id))}}">
                                                                {{$course?->instructor?->name_en}}</a></h6>
                                                        <p>{{$course?->instructor?->designation}}</p>
                                                        <div class="d-flex align-items-center instructor-text-bottom">
                                                            <div class="d-flex align-items-center ratings-icon">
                                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M9.94438 2.34287L11.7457 5.96656C11.8359 6.14934 12.0102 6.2769 12.2124 6.30645L16.2452 6.88901C16.4085 6.91079 16.5555 6.99635 16.6559 7.12701C16.8441 7.37201 16.8153 7.71891 16.5898 7.92969L13.6668 10.7561C13.5183 10.8961 13.4522 11.1015 13.4911 11.3014L14.1911 15.2898C14.2401 15.6204 14.0145 15.93 13.684 15.9836C13.5471 16.0046 13.4071 15.9829 13.2826 15.9214L9.69082 14.0384C9.51037 13.9404 9.29415 13.9404 9.1137 14.0384L5.49546 15.9315C5.1929 16.0855 4.82267 15.9712 4.65778 15.6748C4.59478 15.5551 4.57301 15.419 4.59478 15.286L5.29479 11.2975C5.32979 11.0984 5.26368 10.8938 5.11901 10.753L2.18055 7.92735C1.94099 7.68935 1.93943 7.30201 2.17821 7.06246C2.17899 7.06168 2.17977 7.06012 2.18055 7.05935C2.27932 6.9699 2.40066 6.91001 2.5321 6.88668L6.56569 6.30412C6.76713 6.27223 6.94058 6.14623 7.03236 5.96345L8.83215 2.34287C8.90448 2.19587 9.03281 2.08309 9.18837 2.03176C9.3447 1.97965 9.51582 1.99209 9.66282 2.06598C9.78337 2.12587 9.88215 2.22309 9.94438 2.34287Z"
                                                                        stroke="#FF7A1A" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                                <p>4.9 Star Rating</p>
                                                            </div>
                                                            <div class="d-flex align-items-center ratings-icon">
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M1.5 2.25H6C6.79565 2.25 7.55871 2.56607 8.12132 3.12868C8.68393 3.69129 9 4.45435 9 5.25V15.75C9 15.1533 8.76295 14.581 8.34099 14.159C7.91903 13.7371 7.34674 13.5 6.75 13.5H1.5V2.25Z"
                                                                        stroke="#00AF91" stroke-width="1.8"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M16.5 2.25H12C11.2044 2.25 10.4413 2.56607 9.87868 3.12868C9.31607 3.69129 9 4.45435 9 5.25V15.75C9 15.1533 9.23705 14.581 9.65901 14.159C10.081 13.7371 10.6533 13.5 11.25 13.5H16.5V2.25Z"
                                                                        stroke="#00AF91" stroke-width="1.8"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>

                                                                @if($courseNo->count() > 1)
                                                                <p class="font-para--md">{{$courseNo->count()}} Courses</p>
                                                                @elseif($courseNo->count() == 1)
                                                                <p class="font-para--md">{{$courseNo->count()}} Course</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <p class="lead-p">{{$course?->instructor?->title}} -->
                                                </p>
                                                <p class="course-instructor-description">
                                                    {!! $course?->instructor?->bio !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div> 
            </div>
        </div>

            {{-- Index Course Contents --}}
            <div class="col-lg-4">
                <div class="videolist-area">
                    <div class="videolist-area-heading">
                        <h6>Course Contents</h6>
                    </div>
                    <p>
                        <i class="fas fa-tasks"></i> Progress
                    </p>
                    <div class="videolist-area-bar">
                        <span class="videolist-area-bar--progress" 
                            style="width: {{ $segmentProgress[$segment->id] ?? 0 }}%;" 
                            data-progress="{{ $segmentProgress[$segment->id] ?? 0 }}">
                        </span>
                    </div>
                    <!-- <div>
                        <p>Progress: {{ $segmentProgress[$segment->id] ?? 0 }}%</p>
                    </div> -->
                    <div class="videolist-area-bar__wrapper">
                        @foreach($lessons as $lesson)
                            <div class="videolist-area-wizard" 
                                data-lesson-description="{{$lesson->description}}"
                                data-lesson-notes="{{$lesson->notes}}">
                                <div class="wizard-heading">
                                    <h6 class="">{{$loop->iteration}}. {{$lesson->title}}</h6>
                                </div>
                                @foreach ($lesson->material as $material)
                                    <div class="main-wizard lesson-wizard"
                                        data-lesson-id="{{ $lesson->id }}"
                                        data-material-title="{{$loop->parent->iteration}}.{{$loop->iteration}} {{$material->title}}"
                                        data-material-type="{{$material->type}}"
                                        data-material-content="{{$material->content}}"
                                        data-material-content-data="{{ $material->content_data }}"
                                        data-material-description="{{$lesson->description}}"
                                        data-material-notes="{{$lesson->notes}}"
                                        data-material-id="{{ $material->id }}"
                                        data-course-id="{{$course->id}}"
                                        data-segment-id="{{$segment->id}}"
                                        data-segment-no="{{$segment->segment_no}}">
                                        
                                        <div class="main-wizard__wrapper">
                                            <a class="main-wizard-start lesson-start">
                                                @if ($material->type == 'video')
                                                    <div class="main-wizard-icon">
                                                        <i class="far fa-play-circle fa-lg"></i>
                                                    </div>
                                                @else
                                                    <div class="main-wizard-icon">
                                                        <i class="far fa-file fa-lg text-success"></i>
                                                    </div>
                                                @endif
                                                <div class="main-wizard-title">
                                                    <p>{{$loop->parent->iteration}}.{{$loop->iteration}} {{$material->title}}</p>
                                                </div>
                                            </a>
                                            <div class="main-wizard-end d-flex align-items-center">
                                                @if ($material->type == 'video')
                                                    <strong><span style="color:green;">{{$material->file_duration}}</span></strong>
                                                @else
                                                    <span></span>
                                                @endif
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        style="border-radius: 0px; margin-left: 5px;"
                                                        @if(in_array($material->id, $progressRecords)) checked @endif />
                                                </div>
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                @endforeach
                            </div>                            
                        @endforeach  

                    <div id="start-quiz-container">
                        @if($questions->count() > 0)
                            @if($progress->completed != 1 && $progress->quiz_attempt == 0)                            
                                <div class="videolist-area-wizard"> 
                                    <div class="wizard-heading">
                                        <h6 class="">Quiz</h6>
                                    </div> 
                                    <div class="main-wizard quiz-wizard" data-quiz-id="{{ $quiz->id }}">
                                        <div class="main-wizard__wrapper"> 
                                            <button class="button button--primary start-quiz-btn" 
                                            data-quiz-id="{{$quiz->id}}"
                                            data-quiz-pass-mark="{{$quiz->pass_mark}}"
                                            data-student-id="{{$studentId}}"
                                            data-course-id="{{$course->id}}"
                                            data-segment-id="{{$segment->id}}"
                                            data-segment-no="{{$segment->segment_no}}">
                                            Start Quiz</button>
                                            <p>{{ $progress->quiz_attempt }} {{ $progress->quiz_attempt > 1 ? 'attempts' : 'attempt' }}</p>
                                        </div>  
                                    </div>
                                </div> 
                            @elseif($progress->completed != 1 && $progress->quiz_attempt >= 1)
                            <div class="videolist-area-wizard"> 
                                    <div class="wizard-heading">
                                        <h6 class="">Quiz</h6>
                                    </div> 
                                    <div class="main-wizard quiz-wizard" data-quiz-id="{{ $quiz->id }}">
                                        <div class="main-wizard__wrapper"> 
                                            <button class="button button--primary start-quiz-btn" 
                                            data-quiz-id="{{$quiz->id}}"
                                            data-quiz-pass-mark="{{$quiz->pass_mark}}"
                                            data-student-id="{{$studentId}}"
                                            data-course-id="{{$course->id}}"
                                            data-segment-id="{{$segment->id}}"
                                            data-segment-no="{{$segment->segment_no}}">
                                            Re-take Quiz</button>
                                            <p>{{ $progress->quiz_attempt }} {{ $progress->quiz_attempt > 1 ? 'attempts' : 'attempt' }}</p>
                                        </div>  
                                    </div>
                                </div>
                            @elseif($progress->completed == 1 )
                                <div class="videolist-area-wizard"> 
                                        <div class="wizard-heading">
                                            <h6 class="">Quiz</h6>
                                        </div> 
                                       <strong><p>Quiz Completed</p></strong> 
                                </div>
                            @else
                            <div class="videolist-area-wizard"> 
                                    <div class="wizard-heading">
                                        <h6 class="">Quiz</h6>
                                    </div> 
                                    <div class="main-wizard quiz-wizard" data-quiz-id="{{ $quiz->id }}">
                                        <div class="main-wizard__wrapper"> 
                                            <button class="button button--primary start-quiz-btn" 
                                            data-quiz-id="{{$quiz->id}}"
                                            data-quiz-pass-mark="{{$quiz->pass_mark}}"
                                            data-student-id="{{$studentId}}"
                                            data-course-id="{{$course->id}}"
                                            data-segment-id="{{$segment->id}}"
                                            data-segment-no="{{$segment->segment_no}}">
                                            Re-take Quiz</button>
                                            <p>
                                                {{ $progress->quiz_attempt == 0 ? $progress->quiz_attempt : 0 }} 
                                                {{ $progress->quiz_attempt > 1 ? 'attempts' : 'attempt' }}
                                            </p>
                                        </div>  
                                    </div>
                                </div>
                            @endif                   
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Course Description Ends Here -->

    <!-- Rating Modal -->
    
        <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" 
        aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">How would you rate this course ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <!-- Star Rating -->
                        <div class="star-rating">
                            <i class="star fa fa-star" data-value="1"></i>
                            <i class="star fa fa-star" data-value="2"></i>
                            <i class="star fa fa-star" data-value="3"></i>
                            <i class="star fa fa-star" data-value="4"></i>
                            <i class="star fa fa-star" data-value="5"></i>
                        </div>
                        <p class="mt-2">Rating: <span id="selected-rating">0</span> / 5</p>
                    </div>
                    <!-- Rating Form -->
                    <form id="rating-form">
                        <input type="hidden" id="rating" name="rating" value="0"> <!-- Hidden field for rating -->
                        <input type="hidden" id="course_id" name="course_id" value="{{ $courseId }}">
                        <input type="hidden" id="student_id" name="student_id" value="{{ $studentId }}">
                        <!-- <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="3" placeholder="How do you feel about this course?"></textarea>
                        </div> -->
                        <button type="submit" class="btn btn-primary w-100">Submit Rating</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="{{asset('frontend/src/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/src/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/video.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.star-rating-svg.js')}}"></script>
    <script src="{{asset('frontend/src/js/app.js')}}"></script>
    <!-- <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script> -->
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>   
    
    <!-- Lesson -->
    <script>
    function show_content(material) {
        const contentType = material.type;
        const contentLink = "{{ asset('uploads/courses/contents') }}/" + material.content;

        // Clear any existing content in the lesson container
        $('#lesson-container').empty();

        // Determine content type and render accordingly
        if (contentType === 'video') {
            $('.material-title').html(material.title); 
            // Render video content
            const videoHTML = `      
                <div class="video-area">
                    <div class="video-container"> 
                        <video id="myvideo" 
                            class="video-js vjs-default-skin w-100" 
                            controls controlsList="nodownload"
                            preload="auto" autoplay
                            poster="${contentLink}">
                            <source src="${contentLink}" type="video/mp4">
                        </video>
                    </div>
                </div>
            `;
            $('#lesson-container').append(videoHTML);
            $('#myvideo').get(0).play(); // Auto-play video
        } else if (contentType === 'text') {
            $('.material-title').html(material.title); 
            // Render text content
            const textHTML = `
                <div class="text-area">
                    <div class="text-frame">
                        <p>${material.content_data ? material.content_data : 'No content available.'}</p>
                    </div>
                </div>
            `;
            $('#lesson-container').append(textHTML);
        } else if (contentType === 'document') {
            $('.material-title').html(material.title); 
            // Render document content (corrected to display document content)
            const documentHTML = `
                <div class="document-content">
                    <div class="document-frame">
                        ${material.content_data ? material.content_data : 'No content available.'}
                    </div>
                </div>
            `;
            $('#lesson-container').append(documentHTML);
        } else {
            console.log('No valid content available for this lesson.');
        }

        // Display the lesson container and hide others
        $('#lesson-container').show();
        $('#tab-container').show();
        $('#lesson-navigate-container').show();
        $('#quiz-container').hide();

        // Scroll to the top of the lesson container
        scrollToTop();

        // Scroll function for smooth experience
        function scrollToTop() {
            $('html, body').animate({
                scrollTop: $('#lesson-container').offset().top
            }, 'fast');
        }
    }

    $(document).ready(function() {
        // Set the initial checked state for checkboxes based on progress records
        var progressRecords = @json($progressRecords); // Pass this from the server-side
        $('.main-wizard').each(function() {
            var materialId = $(this).data('material-id');
            if (progressRecords.includes(materialId)) {
                $(this).find('.form-check-input').prop('checked', true); // Check the checkbox if progress exists
            }
        });

        $('.main-wizard').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior

            // Get material data attributes
            var material = {
                title: $(this).data('material-title'),
                type: $(this).data('material-type'),
                content: $(this).data('material-content'),
                content_data: $(this).data('material-content-data') || '', // Ensure it's set
                description: $(this).data('material-description'), // Capture lesson description
                notes: $(this).data('material-notes'), // Capture lesson notes
                id: $(this).data('material-id'), // Capture material ID
                course_id: $(this).data('course-id'), // Capture course ID
                lesson_id: $(this).data('lesson-id'), // Capture lesson ID
                segment_id: $(this).data('segment-id'),
                segment_no: $(this).data('segment-no')
            };

            // Check the checkbox for the clicked lesson
            $(this).find('.form-check-input').prop('checked', true); // Check the current checkbox

            // Highlight the current lesson
            $(this).addClass('highlight'); // Add highlight class to the clicked lesson

            // Update lesson description and notes
            $('#nav-ldescrip .lesson-description p').html(material.description); // Update description
            $('#nav-lnotes .course-notes-area .course-notes-item p').html(material.notes); // Update notes
            
            // Show content based on the type
            show_content(material);

            // Send AJAX request to update progress and update the last viewed lesson/material
            $.ajax({
                url: "{{ route('update.progress') }}", 
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",                   
                    courseid: material.course_id,
                    lessonid: material.lesson_id, // Use the captured lesson ID
                    materialid: material.id,
                    segmentid: material.segment_id,
                    segmentno: material.segment_no
                },
                success: function(response) {
                    // Update the frontend variables with the returned values from the server
                    lastViewedLessonId = material.lesson_id;
                    lastViewedMaterialId = material.id;
                    console.log('Progress updated successfully');
                },
                error: function(error) {
                    console.log('Error updating progress:', error);
                }
            });
        });
    });
</script>

<script>
let currentIndex = 0; // Default index
let lessons = []; // Store all lessons

// Last viewed lesson data from PHP
let lastViewedLessonId = @json($lastViewedLessonId); 
let lastViewedMaterialId = @json($lastViewedMaterialId);

// Total number of lessons from PHP
let lessonCount = @json($lessonCount);

$(document).ready(function () {
    // Load lessons from page
    $('.main-wizard').each(function () {
        lessons.push({
            title: $(this).data('material-title'),
            type: $(this).data('material-type'),
            content: $(this).data('material-content'),
            content_data: $(this).data('material-content-data') || '',
            description: $(this).data('material-description'),
            notes: $(this).data('material-notes'),
            id: $(this).data('material-id'),
            course_id: $(this).data('course-id'),
            lesson_id: $(this).data('lesson-id'),
            segment_id: $(this).data('segment-id'),
            segment_no: $(this).data('segment-no')
        });
    });

    // Find the index of the last viewed lesson
    currentIndex = lessons.findIndex(lesson => lesson.id === lastViewedMaterialId);

    // Function to load a specific lesson
    function loadLesson(index) {
        const material = lessons[index];
        show_content(material);

        // Update description and notes
        $('#nav-ldescrip .lesson-description p').html(material.description);
        $('#nav-lnotes .course-notes-area .course-notes-item p').html(material.notes);

        // Update progress via AJAX
        $.ajax({
            url: "{{ route('update.progress') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                courseid: material.course_id,
                lessonid: material.lesson_id,
                materialid: material.id,
                segmentid: material.segment_id,
                segmentno: material.segment_no
            },
            success: function (response) {
                console.log('Progress updated successfully');
            },
            error: function (error) {
                console.log('Error updating progress:', error);
            }
        });

        // Check corresponding checkbox
        $('.main-wizard').eq(index).find('.form-check-input').prop('checked', true);

        // Highlight current lesson
        $('.main-wizard').removeClass('highlight');
        $('.main-wizard').eq(index).addClass('highlight');

        // Enable or disable navigation buttons based on the current index
        $('#prev-lesson').prop('disabled', index === 0); // Disable "Previous" if first lesson
        $('#next-lesson').prop('disabled', index === lessonCount - 1); // Disable "Next" if last lesson

        // Show quiz button only if there are more than one lesson and it's the last lesson
        if (lessonCount > 1) {
            if (index === lessonCount - 1) {
                $('#next-lesson').hide(); // Hide next button
                $('#prev-lesson').show(); // Show previous button
                $('#quiz-button').show(); // Show quiz button
            } else {
                $('#next-lesson').show(); // Show next button
                $('#prev-lesson').show(); // Show previous button
                $('#quiz-button').hide(); // Hide quiz button
            }
        } else {
            $('#quiz-button').show(); // Show quiz button if only one lesson
            $('#next-lesson').hide(); // Hide next button
            $('#prev-lesson').hide(); // Hide previous button
        }
    }

    // Next Button Click
    $('#next-lesson').on('click', function () {
        if (currentIndex < lessonCount - 1) {
            currentIndex++;
            loadLesson(currentIndex);
        }
    });

    // Previous Button Click
    $('#prev-lesson').on('click', function () {
        if (currentIndex > 0) {
            currentIndex--;
            loadLesson(currentIndex);
        }
    });

    // Initial lesson load
    if (lessons.length > 0) {
        loadLesson(currentIndex);
    }

    // Quiz Button Click (hides containers and initializes quiz)
    $('#quiz-button').on('click', function () {
        // Hide all lesson-related containers
        $('.lesson-container').hide();
        $('.video-container').hide();
        $('.tab-container').hide();
        $('.lesson-navigate-container').hide();

        // Initialize the quiz using the 'start-quiz-btn' class
        const quizButton = $(this);
        const quizId = quizButton.data('quiz-id');
        const studentId = quizButton.data('student-id');
        const courseId = quizButton.data('course-id');
        const segmentId = quizButton.data('segment-id');
        const segmentNo = quizButton.data('segment-no');
        const passMark = quizButton.data('quiz-pass-mark');

        // Example function to start the quiz (you already have a similar function for this)
        startQuiz(quizId, studentId, courseId, segmentId, segmentNo, passMark);

        // Optionally, you can show a loading state or redirect to the quiz page, etc.
    });
});

// Example function for initializing the quiz (replace with your existing function)
function startQuiz(quizId, studentId, courseId, segmentId, segmentNo, passMark) {
    console.log("Starting quiz with the following data:");
    console.log("Quiz ID:", quizId);
    console.log("Student ID:", studentId);
    console.log("Course ID:", courseId);
    console.log("Segment ID:", segmentId);
    console.log("Segment No:", segmentNo);
    console.log("Pass Mark:", passMark);
    // Implement your quiz initialization logic here
}
</script>


<!-- Quiz -->
<script>
let questions = [];
let currentQuestionIndex = 0;
let selectedAnswers = {};
let quizAttempt = 1; // Initial attempt count

// Function to save or update the question response in the database
function saveQuestionResponse(questionId, studentId, answer = '') {
    $.ajax({
        url: `/students/quiz/save-answer`,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            student_id: studentId,
            question_id: questionId,
            answer: answer
        },
        success: function() {
            console.log('Answer saved successfully.');
        },
        error: function() {
            console.log('Failed to save the answer.');
        }
    });
}

// Load a question based on the current index
function loadQuestion(index) {
    const question = questions[index];
    if (!question) return;

    $('#total-questions').text(`Total Questions: ${questions.length}`);
    $('#question-content').html(`Question ${index + 1} of ${questions.length}: <br>${question.content}`);
    $('#option-a').text(question.option_a);
    $('#option-b').text(question.option_b);
    $('#option-c').text(question.option_c);
    $('#option-d').text(question.option_d);

    $('input[name="answer"]').prop('checked', false);
    if (selectedAnswers[question.id]) {
        $(`input[name="answer"][value="${selectedAnswers[question.id]}"]`).prop('checked', true);
    }

    $('#prev-question').prop('disabled', index === 0);
    $('#next-question').toggle(index < questions.length - 1);
    $('#finish-quiz').toggle(index === questions.length - 1);

    const studentId = $('.start-quiz-btn').data('student-id');
    saveQuestionResponse(question.id, studentId, selectedAnswers[question.id] || '');
}

// Save the selected answer for the current question
function saveAnswer() {
    const selectedAnswer = $('input[name="answer"]:checked').val();
    if (selectedAnswer) {
        const currentQuestionId = questions[currentQuestionIndex].id;
        selectedAnswers[currentQuestionId] = selectedAnswer;

        const studentId = $('.start-quiz-btn').data('student-id');
        saveQuestionResponse(currentQuestionId, studentId, selectedAnswer);
    }
}

// Calculate and return the quiz score as a percentage
function calculateScore() {
    let correctAnswers = 0;
    questions.forEach((question) => {
        if (selectedAnswers[question.id] === question.correct_answer) {
            correctAnswers++;
        }
    });
    return (correctAnswers / questions.length) * 100;
}

// Display user results (correct and incorrect answers)
function displayResults() {
    let resultHTML = '<div style="border: 2px solid #ccc; padding: 20px; border-radius: 10px; background-color: #fff;">';
    resultHTML += '<h2>Quiz Results</h2><ul>';

    questions.forEach((question, index) => {
        const userAnswer = selectedAnswers[question.id] || 'No answer';
        const isCorrect = userAnswer === question.correct_answer;
        const resultClass = isCorrect ? 'correct-answer' : 'wrong-answer';
        const correctAnswerText = isCorrect ? 'Correct!' : `Wrong! Correct answer: ${question.correct_answer.toUpperCase()}`;

        resultHTML += `
            <li style="margin-bottom: 10px;">
                <strong>Question ${index + 1}:</strong> ${question.content}<br>
                <span class="${resultClass}">Your answer: ${userAnswer.toUpperCase()}</span><br>
                <span>${correctAnswerText}</span>
            </li>`;
    });

    resultHTML += '</ul></div>';
    return resultHTML;
}

// Fetch quiz questions when the quiz is clicked
function fetchQuizQuestions(quizId) {
    $.ajax({
        url: `/students/quiz/${quizId}/questions`,
        method: 'GET',
        success: function(data) {
            questions = data;
            $('.material-title').html('Quiz'); 
            $('#quiz-container').show(); // Ensure it’s shown on success
            $('#tab-container').hide();
            $('#lesson-navigate-container').hide();
            if (questions.length > 0) {
                loadQuestion(0);
                $('html, body').animate({
                    scrollTop: $('#quiz-container').offset().top
                }, 'fast');
            } else {
                $('#quiz-container').html('<p>No questions available for this quiz.</p>');
            }
        },
        error: function(xhr) {
            if (xhr.status === 403) {
                let errorMessage = xhr.responseJSON.error;
                let displayMessage = '';
                let buttonLabel = '';
                let buttonAction;

                if (errorMessage.includes("complete all lessons")) {
                    displayMessage = `<strong>Notice:</strong> ${errorMessage}`;
                    buttonLabel = "Continue";
                    buttonAction = function() {
                        location.reload();
                    };
                } else if (errorMessage.includes("wait 2 hours")) {
                    displayMessage = `<strong>Notice:</strong> ${errorMessage}`;
                    buttonLabel = "Exit";
                    buttonAction = function() {
                        window.location.href = `{{ route('home') }}`;
                    };
                } else {
                    displayMessage = `<strong>Notice:</strong> Unable to access quiz at the moment.`;
                    buttonLabel = "Exit";
                    buttonAction = function() {
                        window.location.href = `{{ route('home') }}`;
                    };
                }

                $('#quiz-container').html(`
                    <div style="text-align: center; padding: 20px; background-color: #f8d7da; color: #721c24; border-radius: 10px; border: 1px solid #f5c6cb;">
                        ${displayMessage}
                        <br><br>
                        <button id="dynamic-button" style="margin-top: 10px; padding: 8px 16px; background-color: #721c24; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                            ${buttonLabel}
                        </button>
                    </div>
                `);
                $('#quiz-container').show();
                $('#tab-container').hide();

                $('#dynamic-button').on('click', buttonAction);
            } else {
                $('#quiz-container').html('<p>Failed to load questions. Please try again later.</p>');
                $('#tab-container').hide();
            }
        }
    });
}
$(document).ready(function() {
    // Start quiz on button click
    $('.start-quiz-btn').click(function() {
        const quizId = $(this).data('quiz-id');
        const quizPassMark = $(this).data('quiz-pass-mark');
        const studentId = $(this).data('student-id');

        fetchQuizQuestions(quizId);
        $('html, body').animate({
            scrollTop: $('#quiz-container').offset().top
        }, 'fast');
    });

    // Question navigation
    $('#next-question').click(() => {
        saveAnswer();
        currentQuestionIndex++;
        loadQuestion(currentQuestionIndex);
    });

    $('#prev-question').click(() => {
        saveAnswer();
        currentQuestionIndex--;
        loadQuestion(currentQuestionIndex);
    });
    
    // Finish quiz
        $('#finish-quiz').click(() => {
            saveAnswer();
            const scorePercentage = calculateScore();
            const quizPassMark = $('.start-quiz-btn').data('quiz-pass-mark');
            const quizId = $('.start-quiz-btn').data('quiz-id');
            const studentId = $('.start-quiz-btn').data('student-id');
            const segmentId = $('.start-quiz-btn').data('segment-id');
            const courseId = $('.start-quiz-btn').data('course-id');
            const resultHTML = displayResults();

            // Save final quiz attempt results
            $.ajax({
                url: `/students/quiz/${quizId}/finish`,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    student_id: studentId,
                    quiz_id: quizId,
                    course_id: courseId,
                    segment_id: segmentId,
                    score: scorePercentage,
                    quiz_attempt: quizAttempt,
                    pass_mark: quizPassMark,
                    completed: scorePercentage >= quizPassMark ? 1 : 0,
                    last_attempt_time: new Date().toISOString(),
                },
                success: function() {
                    console.log('Quiz attempt saved.');
                },
                error: function(xhr, status, error) {
                    console.error('Failed to save quiz attempt:', xhr.responseText || error);
                }
            });

            // Determine the result message based on the score
            let resultMessage;
            if (scorePercentage < quizPassMark) {
                resultMessage = 'Sorry, you did not pass.';
            } else {
                resultMessage = 'Congratulations, you passed the quiz! You can move to the next segment.';
            }

            // Display results to the user
            $('#quiz-container').html(`
                <div style="text-align: center; padding: 30px; border-radius: 10px; background-color: #f5f5f5; max-width: 600px; margin: 0 auto;">
                    <h3>Quiz Finished!</h3>
                    <p>Your score: <strong>${scorePercentage}%</strong> - PassMark: <strong>${quizPassMark}%</strong></p>
                    <p><strong>${resultMessage}</strong></p>
                    <div>${resultHTML}</div>
                    <button id="exit-quiz" class="button button--primary start-quiz-btn" style="margin-top: 20px;">Exit</button>
                </div>
            `);

            // Reload the page when the Exit button is clicked
            $('#exit-quiz').click(() => {
                location.reload();
            });
        });

        // Auto-save answer on selection
        $('input[name="answer"]').change(function() {
            saveAnswer();
        });

    });
</script>


<!-- User Comments -->
<script>
    $(document).ready(function () {        
      // Submit comment via AJAX
            $('#comment-form').submit(function (event) {
                event.preventDefault(); // Prevent default form submission

                let formData = {
                    comment: $('#comment').val(),
                    student_id: parseInt($('#student_id').val(), 10), // Force to integer
                    course_id: parseInt($('#course_id').val(), 10), // Force to integer
                    _token: $('input[name="_token"]').val()
                };

                $.ajax({
                    url: "{{ route('review.save') }}",  // Your route to save the comment
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            // Clear the comment textarea
                            $('#comment').val('');

                            // Reload the comments section
                            loadComments();
                        } else {
                            alert('Error: ' + response.message); // Handle error message
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error submitting the comment: ', error);
                        alert('Error submitting the comment. Please try again.');
                    }
                });
            });

        // Function to load comments dynamically
        function loadComments() {
            let courseId = $('#course_id').val(); // Get the course ID from the form

            $.ajax({
                url: "/students/course-review/" + courseId,  // Adjust the route to fetch reviews
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        // Populate the comments container with the fetched comments
                        $('#comments-container').html(response.html);

                        // Update the comment count
                        $('#comment-count').text(`(${response.count})`);
                    } else {
                        alert('Error loading comments.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error loading comments: ', error);
                    alert('Error loading comments. Please try again.');
                }
            });
        }

        // Initially load comments when the page is ready
        loadComments();
    });
</script>
<!-- User Rating  -->
<script>
    $(document).ready(function () {
        // Handle star click
        $('.star').click(function () {
            let ratingValue = $(this).data('value');
            
            // Update the hidden input field
            $('#rating').val(ratingValue);

            // Update the displayed rating
            $('#selected-rating').text(ratingValue);

            // Highlight the selected stars and reset the others
            $('.star').each(function () {
                if ($(this).data('value') <= ratingValue) {
                    $(this).addClass('selected');
                } else {
                    $(this).removeClass('selected');
                }
            });
        });

        // Submit rating form via AJAX
        $('#rating-form').submit(function (event) {
            event.preventDefault();

            let formData = {
                rating: $('#rating').val(),
                course_id: $('#course_id').val(),
                student_id: $('#student_id').val(),
                _token: $('input[name="_token"]').val()
            };

            $.ajax({
                url: "{{ route('course.rating.store') }}",  // Your route to store the rating
                method: 'POST',
                data: formData,
                success: function (response) {
                    // Close the modal
                    $('#ratingModal').modal('hide');
                    
                    // Show a success message
                    alert('Rating submitted successfully!');
                    
                    // Reload the page after a short delay (e.g., 1 second)
                    setTimeout(function() {
                        window.location.reload();  // Reload the page
                    }, 1000);  // 1 second delay
                },
                error: function (response) {
                    alert('Error submitting rating.');
                }
            });
        });
    });
</script>

<script>
    // Disable right-click and keyboard shortcuts
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && (e.key === 'c' || e.key === 's')) {
            e.preventDefault();
        }
    });
</script>



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


</body>

</html>