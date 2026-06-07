@extends('backend.layouts.app')
@section('title', 'Course List')

@push('styles')
<!-- Datatable -->
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Segment List - {{$course->title_en}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('course.index')}}">My Courses</a></li>
                    <li class="breadcrumb-item active"><a href="">All Segments</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="lms-section-card">
                    <div class="row g-4">

                    <div class="col-12 mb-4">

                        <div class="lms-header-card">

                            <div class="lms-header-left">
                                <h3 class="mb-1">Course Segments</h3>
                                <p class="text-muted mb-0">
                                    Organize lessons and quizzes into learning modules.
                                </p>
                            </div>

                            <div class="lms-header-right">
                                <a href="{{route('segment.createNew', encryptor('encrypt', $courseId ))}}"
                                class="lms-btn">
                                    + Add Segment
                                </a>
                            </div>

                        </div>

                    </div>

                    @forelse($segment as $d)

                    <div class="col-xl-4 col-lg-6">

                        <div class="segment-card">

                            <!-- Cover -->
                            <div class="segment-cover">

                                <img src="{{ asset('uploads/courses/' . ($d->image ?? 'course_blank.jpg')) }}"
                                    alt="">

                                <div class="segment-overlay">

                                    <span class="segment-number">
                                        Segment {{ $d->segment_no }}
                                    </span>

                                    <span class="segment-status
                                    @if($d->status == 2)
                                        success
                                    @elseif($d->status == 1)
                                        danger
                                    @else
                                        warning
                                    @endif">
                                        @if($d->status == 2)
                                            Active
                                        @elseif($d->status == 1)
                                            Inactive
                                        @else
                                            Pending
                                        @endif
                                    </span>

                                </div>

                            </div>

                            <!-- Body -->
                            <div class="segment-body">

                                <h4 class="segment-title">
                                    {{ $d->title_en }}
                                </h4>

                                <div class="segment-meta">

                                    <div>
                                        <small>Instructor</small>
                                        <strong>{{ $d->instructor?->name_en }}</strong>
                                    </div>

                                    <div>
                                        <small>Category</small>
                                        <strong>{{ $d->courseCategory?->category_name }}</strong>
                                    </div>

                                </div>

                                <!-- Stats -->
                                <div class="segment-stats">

                                    <div class="stat-box">
                                        <h5>{{ $d->lesson_count }}</h5>
                                        <span>Lessons</span>
                                    </div>

                                    <div class="stat-box">
                                        <h5>
                                            @if($d->quiz)
                                                ✓
                                            @else
                                                ✕
                                            @endif
                                        </h5>
                                        <span>Quiz</span>
                                    </div>

                                </div>

                                <!-- Actions -->
                                <div class="segment-actions">

                                    <a href="{{route('segment.edit', encryptor('encrypt',$d->id))}}"
                                    class="btn-edit">
                                        Edit
                                    </a>

                                    <a href="{{ $d->lesson_count > 0
                                        ? route('lesson.show', encryptor('encrypt',$d->id))
                                        : route('lesson.create',['segment_id'=>encryptor('encrypt',$d->id)]) }}"
                                    class="btn-manage">

                                        {{ $d->lesson_count > 0
                                            ? 'View Lessons'
                                            : 'Add Lessons' }}

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    @empty

                    <div class="col-12">

                        <div class="lms-empty-state">

                            <div class="empty-icon">
                                📚
                            </div>

                            <h4>No Segments Yet</h4>

                            <p>
                                Create your first segment to start building this course.
                            </p>

                        </div>

                    </div>

                    @endforelse

                </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

@endpush