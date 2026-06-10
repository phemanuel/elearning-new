@extends('frontend.layouts.student-app')
@section('title', 'My Courses')
@section('body-attr') style="background-color: #ebebf2;" @endsection

@push('styles')
<link rel="stylesheet" href="{{asset('frontend/src/scss/vendors/plugin/css/jquery-ui.css')}}" />
@endpush

@section('content')
<div class="mc-container">

    {{-- ================= HEADER ================= --}}
    <section class="mc-header">

        <div class="mc-header-left">
            <h2 class="mc-title">My Courses</h2>
            <p class="mc-subtitle">Continue your enrolled courses and track progress</p>
        </div>

        <a href="{{ route('searchCourse') }}" class="mc-action-btn">
            <i class="fas fa-plus-circle"></i>
            Explore Courses
        </a>

    </section>


    {{-- ================= STATS ================= --}}
    <section class="mc-stats">

        <div class="mc-stat-card active">
            <div class="mc-stat-icon">
                <i class="fas fa-play-circle"></i>
            </div>
            <div class="mc-stat-info">
                <h3>{{ $activeCourses }}</h3>
                <span>Active Courses</span>
            </div>
        </div>

        <div class="mc-stat-card completed">
            <div class="mc-stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="mc-stat-info">
                <h3>{{ $completedCourses }}</h3>
                <span>Completed Courses</span>
            </div>
        </div>

    </section>


    {{-- ================= COURSE GRID ================= --}}
    <section class="mc-grid">

        @forelse ($enrollments as $enrollment)

            @php
                $course = $enrollment->course;
                $progress = $courseProgress[$enrollment->course_id] ?? 0;

                $segments = $course?->segments->count() ?? 0;
                $lessons = $course?->lessons->count() ?? 0;
                $instructor = $course?->instructor;

                $isCompleted = $enrollment->completed == 2;
            @endphp

            <div class="mc-col">

                <article class="mc-card">

                    {{-- IMAGE --}}
                    <div class="mc-card-image">

                        <a href="{{ route('courseSegment', encryptor('encrypt', $course?->id)) }}">
                            <img src="{{ asset('uploads/courses/' . $course?->image) }}"
                                 onerror="this.src='{{ asset('uploads/courses/course_blank.jpg') }}'">
                        </a>

                        <span class="mc-badge
                            @if($isCompleted) done
                            @elseif($progress > 0) progress
                            @else new @endif">

                            @if($isCompleted)
                                Completed
                            @elseif($progress > 0)
                                In Progress
                            @else
                                Not Started
                            @endif

                        </span>

                    </div>


                    {{-- CONTENT --}}
                    <div class="mc-card-body">

                        <h4 class="mc-course-title">
                            {{ $course?->title_en ?? 'Untitled Course' }}
                        </h4>

                        <div class="mc-meta">
                            <span>📦 {{ $segments }} Segments</span>
                            <span>📚 {{ $lessons }} Lessons</span>
                        </div>


                        {{-- INSTRUCTOR --}}
                        <a href="{{ route('instructorProfile', encryptor('encrypt', $instructor?->id)) }}"
                           class="mc-instructor">

                            <img src="{{ asset('uploads/users/' . $instructor?->image) }}"
                                 onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                            <span>{{ $instructor?->name_en }}</span>

                        </a>


                        {{-- PROGRESS --}}
                        <div class="mc-progress">

                            <div class="mc-progress-bar">
                                <span style="width: {{ $progress }}%"></span>
                            </div>

                            <small>{{ $progress }}% complete</small>

                        </div>


                        {{-- ACTION --}}
                        <div class="mc-actions">

                            <a href="{{ route('courseSegment', encryptor('encrypt', $course?->id)) }}"
                               class="mc-btn primary">

                                @if($isCompleted)
                                    🎓 View Course
                                @elseif($progress > 0)
                                    ▶ Continue
                                @else
                                    🚀 Start
                                @endif

                            </a>

                            @if($isCompleted)
                                <a href="{{ route('certificate.show', encryptor('encrypt', $course?->id)) }}"
                                   target="_blank"
                                   class="mc-btn secondary">
                                    ⬇ Certificate
                                </a>
                            @endif

                        </div>

                    </div>

                </article>

            </div>

        @empty

            <div class="mc-empty">
                <h3>No Courses Yet</h3>
                <p>Your learning journey starts here</p>

                <a href="{{ route('searchCourse') }}" class="mc-action-btn">
                    Enroll Now
                </a>
            </div>

        @endforelse

    </section>


    {{-- ================= PAGINATION ================= --}}
    <div class="mc-pagination">
        {{ $enrollments->links() }}
    </div>

</div>
@endsection