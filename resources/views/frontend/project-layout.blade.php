<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }} | Project</title>
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
                            <h6 class="font-title--xs"><a href="#">Final Project
                            </a></h6>
                            <div class="lesson-hours">
                                <div class="book-lesson">
                                    <!-- <i class="fas fa-book-open text-primary"></i> -->
                                    <span></span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="coursedescription-header-end">                  
                
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
                    <!-- <h5 class="font-title--sm material-title"> Final Project</h5>                     
                    <hr>                       -->
                    <!-- Lesson Container -->
                    <div id="lesson-container">
                        
                        <div class="text-area">
                            <div class="text-frame">
                                {!! $project->project_content !!}
                            </div>
                        </div>
                                          
                    </div>
                    <!-- Navigating Lessons in a Card -->
                    <!-- <div id ="lesson-navigate-container" class="card lesson-card">
                        <div class="lesson-navigation">
                           

                        </div>
                    </div>         -->
                     
            </div>
        </div>

            {{-- Index Course Contents --}}
            <div class="col-lg-4">
                <div class="videolist-area">
                    <div class="videolist-area-heading">
                        <h6>Project Submission</h6>
                    </div>                   
                    
                    <div class="videolist-area-bar__wrapper">                       
                            <div class="videolist-area-wizard">
                                <div class="wizard-heading">
                                    <h6 class="">You are expected to submit a valid link to access your project.</h6>
                                </div> 
                               
                                 <!-- insert input box -->
                                 <p>
                                    <label for="project_link" class="fw-bold">Project Link</label>
                                    <form action="{{route('project-submission' , encryptor('encrypt', $courseId))}}" method="POST">
                                        <div class="form-group mb-3">
                                            <input type="text" id="project_link" name="project_link" class="form-control" placeholder="Enter project link" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button button--purple">
                                                <i class="fas fa-paper-plane"></i> Submit
                                            </button>
                                        </div>
                                    </form>
                                </p>                             
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