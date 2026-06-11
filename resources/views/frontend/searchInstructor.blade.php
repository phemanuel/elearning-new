@extends('frontend.layouts.student-app')
@section('title', 'Instructors')
@section('body-attr') style="background-color: #ebebf2;" @endsection

@push('styles')
<link rel="stylesheet" href="{{asset('frontend/src/scss/vendors/plugin/css/jquery-ui.css')}}" />
@endpush

@section('content')
<!-- Breadcrumb Starts Here -->
<section class="lms-breadcrumb-wrap">
    <div class="container">

        <div class="lms-breadcrumb-card">

            <div class="lms-breadcrumb-content">

                <span class="lms-breadcrumb-label">
                    Find Instructors
                </span>

                <h1 class="lms-breadcrumb-title">
                    Browse Expert Instructors
                </h1>

                <p class="lms-breadcrumb-text">
                    Discover experienced instructors, explore their profiles,
                    and connect with the right mentor for your learning journey.
                </p>

            </div>

            <!-- Search Area -->
            <div class="lms-search-area">

                <form action="#" class="lms-search-form">

                    <div class="lms-search-box">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="22"
                            height="22"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>

                        </svg>

                        <input type="text"
                            class="lms-search-input"
                            placeholder="Search instructors, courses, skills..." />

                        <button type="submit" class="lms-search-btn">
                            Search
                        </button>

                    </div>

                </form>

            </div>

            <nav aria-label="breadcrumb">

                <ol class="lms-breadcrumb">

                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('searchInstructor') }}">
                            Instructors
                        </a>
                    </li>

                </ol>

            </nav>

        </div>

    </div>
</section>
<!-- Breadcrumb Ends Here -->

<!-- Event Search Starts Here -->
<section class="section event-search">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-4 d-none d-lg-block">

                <div class="lms-filter-sidebar">

                    <div class="accordion lms-filter-accordion" id="lmsFilterAccordion">

                        <!-- CATEGORY FILTER -->
                        <div class="lms-filter-card">

                            <h2 class="accordion-header">

                                <button class="accordion-button lms-filter-toggle"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#lmsCategoryFilter"
                                    aria-expanded="true">

                                    <span>Categories</span>

                                </button>

                            </h2>

                            <div id="lmsCategoryFilter"
                                class="accordion-collapse collapse show"
                                data-bs-parent="#lmsFilterAccordion">

                                <div class="lms-filter-body">

                                    <form action="{{ route('searchInstructor') }}" method="GET">

                                        <div class="lms-filter-item">

                                            <label class="lms-checkbox">

                                                <input type="checkbox"
                                                    name="categories[]"
                                                    value=""
                                                    {{ empty($selectedCategories) || in_array('', (array)$selectedCategories) ? 'checked' : '' }}>

                                                <span class="lms-checkbox-mark"></span>

                                                <span class="lms-filter-name">
                                                    All Categories
                                                </span>

                                            </label>

                                            <span class="lms-filter-count">
                                                {{ $allInstructors->count() }}
                                            </span>

                                        </div>

                                        @foreach($categories as $cat)

                                            @php
                                                $courseCount = $cat->course()->where('status',2)->count();
                                            @endphp

                                            <div class="lms-filter-item">

                                                <label class="lms-checkbox">

                                                    <input type="checkbox"
                                                        name="categories[]"
                                                        value="{{ $cat->id }}"
                                                        {{ in_array($cat->id,(array)$selectedCategories) ? 'checked' : '' }}>

                                                    <span class="lms-checkbox-mark"></span>

                                                    <span class="lms-filter-name">
                                                        {{ $cat->category_name }}
                                                    </span>

                                                </label>

                                                <span class="lms-filter-count">
                                                    {{ $courseCount }}
                                                </span>

                                            </div>

                                        @endforeach

                                        <button type="submit" class="lms-filter-btn">
                                            Apply Filter
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <!-- LEVEL FILTER -->
                        <div class="lms-filter-card">

                            <h2 class="accordion-header">

                                <button class="accordion-button lms-filter-toggle collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#lmsLevelFilter"
                                    aria-expanded="false">

                                    <span>Difficulty Level</span>

                                </button>

                            </h2>

                            <div id="lmsLevelFilter"
                                class="accordion-collapse collapse"
                                data-bs-parent="#lmsFilterAccordion">

                                <div class="lms-filter-body">

                                    <div class="lms-filter-item">

                                        <label class="lms-checkbox">

                                            <input type="checkbox"
                                                {{ !$selectedDifficulty ? 'checked' : '' }}>

                                            <span class="lms-checkbox-mark"></span>

                                            <span class="lms-filter-name">
                                                All Levels
                                            </span>

                                        </label>

                                        <span class="lms-filter-count">
                                            {{ $allInstructors->count() }}
                                        </span>

                                    </div>

                                    <div class="lms-filter-item">

                                        <label class="lms-checkbox">

                                            <input type="checkbox">

                                            <span class="lms-checkbox-mark"></span>

                                            <span class="lms-filter-name">
                                                Beginner
                                            </span>

                                        </label>

                                        <span class="lms-filter-count">
                                            {{ $difficulty_beginner->count() }}
                                        </span>

                                    </div>

                                    <div class="lms-filter-item">

                                        <label class="lms-checkbox">

                                            <input type="checkbox">

                                            <span class="lms-checkbox-mark"></span>

                                            <span class="lms-filter-name">
                                                Intermediate
                                            </span>

                                        </label>

                                        <span class="lms-filter-count">
                                            {{ $difficulty_intermediate->count() }}
                                        </span>

                                    </div>

                                    <div class="lms-filter-item">

                                        <label class="lms-checkbox">

                                            <input type="checkbox">

                                            <span class="lms-checkbox-mark"></span>

                                            <span class="lms-filter-name">
                                                Advanced
                                            </span>

                                        </label>

                                        <span class="lms-filter-count">
                                            {{ $difficulty_advanced->count() }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-8">

                <!-- Results Header -->
                <div class="lms-results-header">

                    <div class="lms-results-info">
                        <h4>Discover Instructors</h4>
                        <span>{{ $instructors->total() }} instructors found</span>
                    </div>

                    <div class="lms-results-actions">

                        <select class="lms-sort-select">
                            <option>Most Popular</option>
                            <option>Newest</option>
                            <option>Highest Rated</option>
                            <option>Most Courses</option>
                        </select>

                        <button class="lms-mobile-filter d-lg-none" id="filter">
                            <i class="fas fa-sliders-h"></i>
                            Filter
                        </button>

                    </div>

                </div>

                <!-- Instructor Grid -->
                <div class="row g-4">

                    @forelse($instructors as $instructor)

                    <div class="col-md-6">

                        <div class="lms-instructor-card">

                            <div class="lms-instructor-image">

                                <a href="{{ route('instructorProfile', encryptor('encrypt', $instructor->id)) }}">

                                    <img
                                        src="{{ asset('uploads/users/' . $instructor->image) }}"
                                        alt="{{ $instructor->name_en }}">

                                </a>

                            </div>

                            <div class="lms-instructor-content">

                                <div class="lms-instructor-top">

                                    <div>

                                        <h5 class="lms-instructor-name">

                                            <a href="{{ route('instructorProfile', encryptor('encrypt', $instructor->id)) }}">
                                                {{ $instructor->name_en }}
                                            </a>

                                        </h5>

                                        <span class="lms-instructor-badge">
                                            Instructor
                                        </span>

                                    </div>

                                    <div class="lms-instructor-rating">

                                        <i class="fas fa-star"></i>

                                        <span>4.5</span>

                                    </div>

                                </div>

                                @if(!empty($instructor->bio))
                                <div class="lms-instructor-bio">

                                    {{ \Illuminate\Support\Str::limit(strip_tags($instructor->bio), 90) }}

                                </div>
                                @endif

                                <div class="lms-instructor-stats">

                                    <div class="lms-stat-item">

                                        <i class="fas fa-book-open"></i>

                                        <span>
                                            {{ $instructor->total_courses ?? 0 }}
                                            Courses
                                        </span>

                                    </div>

                                    <div class="lms-stat-item">

                                        <i class="fas fa-user-graduate"></i>

                                        <span>Expert Mentor</span>

                                    </div>

                                </div>

                                <div class="lms-instructor-actions">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $instructor->id)) }}"
                                        class="lms-btn-primary">

                                        <i class="fas fa-user-circle me-2"></i>
                                        View Profile

                                    </a>

                                    <a href="{{ route('instructorCourse', encryptor('encrypt', $instructor->id)) }}"
                                        class="lms-btn-outline">

                                        <i class="fas fa-book-open me-2"></i>
                                        Courses

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    @empty

                    <div class="col-12">

                        <div class="lms-empty-state">

                            <i class="fas fa-search"></i>

                            <h4>No Instructor Found</h4>

                            <p>
                                No instructors match your current search criteria.
                            </p>

                        </div>

                    </div>

                    @endforelse

                </div>

                <!-- Pagination -->
                <div class="lms-pagination-wrap">

                    {{ $instructors->links() }}

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