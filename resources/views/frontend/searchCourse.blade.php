@extends('frontend.layouts.student-app')
@section('title', 'Courses')
@section('body-attr') style="background-color: #ebebf2;" @endsection

@push('styles')
<link rel="stylesheet" href="{{asset('frontend/src/scss/vendors/plugin/css/jquery-ui.css')}}" />
@endpush

@section('content')


<!-- Event Search Starts Here -->
<section class="section event-search">
    <div class="container">
        <div class="course-search-hero">

            <div class="course-search-content">

                <h2>Discover Your Next Course</h2>
                <div class="course-search-links">

                    <a href="{{ route('studentdashboard') }}" class="hero-link">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>

                    <a href="{{route('student_profile')}}" class="hero-link">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                    

                    <a href="{{route('myCourses.index')}}" class="hero-link">
                        <i class="fas fa-graduation-cap"></i>
                        My Courses
                    </a>

                </div>

                <p>
                    Explore professional courses, certifications and learning paths.
                </p>

                <form action="#" class="course-search-form">

                    <i class="fas fa-search"></i>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search courses, instructors, topics..."
                    >

                    <button type="submit">
                        Search
                    </button>

                </form>

            </div>

        </div>
        <div class="row">
            <div class="col-lg-4 d-none d-lg-block">
                <div class="lms-filter-card" id="sidebarFilter">
                    <!-- Search by Category  -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="categoryAcc">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#categoryCollapse" aria-expanded="true"
                                aria-controls="categoryCollapse">
                                Category
                            </button>
                        </h2>
                        <div id="categoryCollapse" class="accordion-collapse collapse show"
                            aria-labelledby="categoryAcc" data-bs-parent="#sidebarFilter">
                            <div class="accordion-body">
                                <form action="{{route('searchCourse')}}" method="get">
                                    @csrf
                                    <div class="accordion-body__item">
                                        <div class="check-box">
                                            <input type="checkbox" class="checkbox-primary" name="category" value=""
                                                {{!$selectedCategories ? 'checked' : '' }}>
                                            <label> All </label>
                                        </div>
                                        <p class="check-details">
                                            {{$allCourse->count()}}
                                        </p>
                                    </div>
                                    @forelse($category as $cat)
                                    @php
                                    $courseCount = $cat->course()->where('status', 2)->count();
                                    @endphp
                                    <div class="accordion-body__item">
                                        <div class="check-box">
                                            <input type="checkbox" class="checkbox-primary" name="categories[]" value="{{ $cat->id }}" {{ in_array($cat->id,
                                            (array)$selectedCategories) ? 'checked' : '' }}>
                                            <label> {{$cat->category_name}} </label>
                                        </div>
                                        <p class="check-details">
                                            {{$courseCount}}
                                        </p>
                                    </div>
                                    @empty
                                    @endforelse
                                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Search by Level  -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="levelAcc">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#levelCollapse" aria-expanded="false" aria-controls="levelCollapse">
                                Level
                            </button>
                        </h2>
                        <div id="levelCollapse" class="accordion-collapse collapse" aria-labelledby="levelAcc"
                            data-bs-parent="#sidebarFilter">
                            <div class="accordion-body">
                                <form action="#">
                                    <div class="accordion-body__item">
                                        <div class="check-box">
                                        <input type="checkbox" class="checkbox-primary" name="category" value=""
                                        {{!$selectedDifficulty ? 'checked' : '' }}>
                                            <label> All </label>
                                        </div>
                                        <p class="check-details">
                                        {{$allCourse->count()}}
                                        </p>
                                    </div>
                                    <div class="accordion-body__item">
                                        <div class="check-box">
                                            <input type="checkbox" class="checkbox-primary" />
                                            <label> Beginner </label>
                                        </div>
                                        <p class="check-details">
                                            {{$difficulty_beginner->count()}}
                                        </p>
                                    </div>
                                    <div class="accordion-body__item">
                                        <div class="check-box">
                                            <input type="checkbox" class="checkbox-primary" />
                                            <label> Intermediate </label>
                                        </div>
                                        <p class="check-details">
                                        {{$difficulty_intermediate->count()}}
                                        </p>
                                    </div>
                                    <div class="accordion-body__item">
                                        <div class="check-box">
                                            <input type="checkbox" class="checkbox-primary" />
                                            <label> Advanced </label>
                                        </div>
                                        <p class="check-details">
                                        {{$difficulty_advanced->count()}}
                                        </p>
                                    </div>                                    
                                </form>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="col-lg-8">
                <div class="lms-results-card">                
                    <div class="event-search-results">
                        <div class="event-search-results-heading">
                            <div class="nice-select" tabindex="0">
                                <span class="current">Most Viewed</span>                            
                            </div>
                            <p>{{$course->count()}} results found.</p>
                            <button class="button button-lg button--primary button--primary-filter d-lg-none" id="filter">
                                <span>
                                    <svg width="19" height="16" viewBox="0 0 19 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.3335 14.9999V9.55554" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M3.3335 6.4444V1" stroke="white" stroke-width="1.7" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M9.55469 14.9999V8" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.55469 4.88886V1" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.7773 14.9999V11.1111" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.7773 7.99995V1" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M1 9.55554H5.66663" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M7.22217 4.88867H11.8888" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M13.4443 11.1111H18.111" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                Filter
                            </button>
                        </div>
                    </div>

                {{-- Courses --}}
                <div class="row event-search-content">
                    @forelse ($course as $c)
                    <div class="col-md-6 mb-4">
                        <div class="contentCard contentCard--course">
                            <div class="contentCard-top">
                                <a href="{{route('courseDetails', encryptor('encrypt', $c->id))}}"><img
                                        src="{{asset('uploads/courses/'.$c->image)}}" alt="images"
                                        class="img-fluid" /></a>
                            </div>
                            <div class="contentCard-bottom">
                                <h5>
                                    <a href="{{route('courseDetails', ['id' => encryptor('encrypt', $c->id)])}}"
                                        class="font-title--card">{{$c->title_en}}</a>
                                </h5>
                                <div class="contentCard-info d-flex align-items-center justify-content-between">
                                    <a href="{{route('instructorProfile', encryptor('encrypt', $c->instructor?->id))}}"
                                        class="contentCard-user d-flex align-items-center">
                                        <img src="{{asset('uploads/users/'.$c->instructor?->image)}}"
                                            alt="Instructor Image" class="rounded-circle" height="34" width="34" />
                                        <p class="font-para--md">{{$c->instructor?->name_en}}</p>
                                    </a>
                                    <div class="price">
                                    <span>{{ $c->price && $c->price > 0 ? $c->currency_type . number_format($c->price,2) : 'Free' }}</span>
                                    <del>{{ $c->old_price && $c->old_price > 0 ? $c->currency_type . number_format($c->old_price,2) : '' }}</del>
                                    </div>
                                </div>
                                <div class="contentCard-more">
                                    <div class="d-flex align-items-center">
                                        <div class="icon">
                                            <img src="{{asset('frontend/dist/images/icon/star.png')}}"
                                                alt="star" />
                                        </div>
                                        <span>4.5</span>
                                    </div>                                    
                                    <div class="book d-flex align-items-center">
                                        <div class="icon">
                                            <img src="{{asset('frontend/dist/images/icon/book.png')}}"
                                                alt="location" />
                                        </div>
                                        @if($c->lessons_count == 1)
                                        <span>{{ $c->lesson_count }} Lesson</span>
                                        @else
                                        <span>{{ $c->lesson_count }} Lessons</span>
                                        @endif
                                    </div>
                                    <div class="clock d-flex align-items-center">                                        
                                        <div class="contentCard-button text-center mt-3">
                            <a href="{{route('courseDetails', ['id' => encryptor('encrypt', $c->id)])}}" class="button button-lg button--primary">Enroll</a>
                    </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-6 mb-4">
                        <div class="contentCard contentCard--course">
                            <h3>No Course Found</h3>
                        </div>
                    </div>
                    @endforelse
                </div>

                <div class="pagination-group mt-lg-5 mt-2">
                    <p>{{$course->links()}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('scripts')
<script src="{{asset('frontend/src/scss/vendors/plugin/js/price_range_script.js')}}"></script>
<script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery-ui.min.js')}}"></script>
<script>
    const filterBtn = document.querySelector("#filter");
            const cross = document.querySelector(".filter--cross");

            filterBtn.addEventListener("click", function () {
                let sidebar = document.querySelector(".filter-sidebar");
                sidebar.classList.toggle("active");
            });

            cross.addEventListener("click", function () {
                let sidebar = document.querySelector(".filter-sidebar");
                sidebar.classList.remove("active");
            });
</script>

@endpush