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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
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
                    <div id="lesson-navigate-container" class="card lesson-card">
                        <div class="lesson-navigation">
                            <h4>Project Submission and Review</h4>
                        </div>
                        <div class="card-body">
                            @if($allProjectSubmission->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Link</th>
                                            <th>Status</th>
                                            <th>Comment</th>
                                            <th>Submitted At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allProjectSubmission as $index => $submission)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <a href="{{ $submission->project_link }}" target="_blank">
                                                        {{ Str::limit($submission->project_link, 30) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($submission->project_status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($submission->project_status == 'reviewed')
                                                        <span class="badge bg-primary">Reviewed</span>
                                                    @elseif($submission->project_status == 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>{{ $submission->comment ?? 'No comments yet' }}</td>
                                                <td>{{ $submission->created_at->format('d M Y, h:i A') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No project submissions yet.</p>
                            @endif
                        </div>
                    </div>
    
                     
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
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="text" id="project_link" name="project_link" class="form-control" placeholder="Enter project link" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button button--purple">
                                                <i class="fas fa-paper-plane"></i> Submit
                                            </button>
                                        </div>
                                        <input type="hidden" name="projectId" value="{{$project->id}}">
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