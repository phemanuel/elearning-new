@extends('backend.layouts.app')
@section('title', 'Course Setup')

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
                    <h4>Course Setup</h4>                 
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Course Setup</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">  
                    @if(auth()->user()->role_id == 1) 
                        <!-- Add Course -->
                        <div class="col-xl-3 col-md-6">
                            <a href="{{route('course.create')}}"
                            class="text-decoration-none">

                                <div class="dashboard-card card-action">

                                    <div class="card-icon">
                                        <i class="material-icons">add</i>
                                    </div>

                                    <div class="card-content">
                                        <span class="card-label">
                                            Course Management
                                        </span>

                                        <h5 class="mb-0 fw-bold">
                                            Add New Course
                                        </h5>
                                    </div>

                                </div>

                            </a>
                        </div>
                    @endif
                    @if(auth()->user()->role_id != 1)

                    <div class="row g-4 mb-4">

                        <!-- Total Courses -->
                        <div class="col-xl-3 col-md-6">
                            <div class="dashboard-card card-primary">
                                <div class="card-icon">
                                    <i class="material-icons">menu_book</i>
                                </div>

                                <div class="card-content">
                                    <span class="card-label">
                                        Total Courses Allocated
                                    </span>

                                    <h2 class="card-value">
                                        {{$noOfCourses}}
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <!-- Uploaded -->
                        <div class="col-xl-3 col-md-6">
                            <div class="dashboard-card card-success">
                                <div class="card-icon">
                                    <i class="material-icons">cloud_upload</i>
                                </div>

                                <div class="card-content">
                                    <span class="card-label">
                                        Courses Uploaded
                                    </span>

                                    <h2 class="card-value">
                                        {{$noOfCoursesInstructor}}
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <!-- Remaining -->
                        <div class="col-xl-3 col-md-6">
                            <div class="dashboard-card card-warning">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>

                                <div class="card-content">
                                    <span class="card-label">
                                        Courses Remaining
                                    </span>

                                    <h2 class="card-value">
                                        {{$noOfCourses - $noOfCoursesInstructor}}
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <!-- Add Course -->
                        <div class="col-xl-3 col-md-6">
                            <a href="{{route('course.create')}}"
                            class="text-decoration-none">

                                <div class="dashboard-card card-action">

                                    <div class="card-icon">
                                        <i class="material-icons">add</i>
                                    </div>

                                    <div class="card-content">
                                        <span class="card-label">
                                            Course Management
                                        </span>

                                        <h5 class="mb-0 fw-bold">
                                            Add New Course
                                        </h5>
                                    </div>

                                </div>

                            </a>
                        </div>

                    </div>

                    @endif
                    
                    <div class="col-lg-12 mt-2">
                        <div class="row">
                            @forelse ($course as $d)

                            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">

                                <div class="lms-course-card">

                                    <!-- Course Image -->
                                    <div class="lms-course-cover">

                                        <img src="{{ asset('uploads/courses/'.$d->image) }}" alt="">

                                        <!-- Status Badge -->
                                        <span class="lms-status-badge
                                            @if($d->status == 2)
                                                active
                                            @elseif($d->status == 1)
                                                inactive
                                            @else
                                                pending
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

                                    <!-- Content -->
                                    <div class="lms-course-content">

                                        <!-- Category + Difficulty -->
                                        <div class="lms-course-tags">

                                            <span class="lms-tag-category">
                                                {{ $d->courseCategory?->category_name }}
                                            </span>

                                            <span class="lms-tag-level">
                                                {{ ucfirst($d->difficulty) }}
                                            </span>

                                        </div>

                                        <!-- Title -->
                                        <h4 class="lms-course-title">
                                            {{ $d->title_en }}
                                        </h4>

                                        <!-- Metrics -->
                                        <div class="lms-course-metrics">

                                            <div class="metric-box">
                                                <span class="metric-label">Price</span>
                                                <strong>
                                                    {{ $d->price > 0
                                                        ? $d->currency_type . number_format($d->price,2)
                                                        : 'Free' }}
                                                </strong>
                                            </div>

                                            <div class="metric-box">
                                                <span class="metric-label">Segments</span>
                                                <strong>{{ $d->segment_count }}</strong>
                                            </div>

                                        </div>

                                        <!-- Secondary Metrics -->
                                        <div class="lms-course-details">

                                            <div class="detail-item">

                                                <span>Project</span>

                                                @if($d->project == 1)
                                                    <span class="text-success">
                                                        <i class="fa fa-check-circle"></i>
                                                        Available
                                                    </span>
                                                @else
                                                    <span class="text-danger">
                                                        <i class="fa fa-times-circle"></i>
                                                        None
                                                    </span>
                                                @endif

                                            </div>

                                            @if($d->date_enabled == 1)

                                            <div class="detail-item">

                                                <span>Start Date</span>

                                                <strong>
                                                    {{ \Carbon\Carbon::parse($d->start_from)->format('M d, Y') }}
                                                </strong>

                                            </div>

                                            @endif

                                        </div>

                                    </div>

                                    <!-- Footer -->
                                    <div class="lms-course-footer">

                                        <a href="{{ route('course.edit', encryptor('encrypt',$d->id)) }}"
                                        class="lms-btn-outline">
                                            Edit
                                        </a>

                                        <a href="{{ $d->segment_count > 0
                                                ? route('segment.show', encryptor('encrypt',$d->id))
                                                : route('segment.createNew',['id'=>encryptor('encrypt',$d->id)]) }}"
                                        class="lms-btn">
                                            Manage Course
                                        </a>

                                    </div>

                                </div>

                            </div>

                            @empty

                            <div class="col-12">
                                <div class="empty-course-card">

                                    <div class="empty-icon">
                                        <i class="material-icons">menu_book</i>
                                    </div>

                                    <h4>No Courses Yet</h4>

                                    <p>
                                        You haven't uploaded any courses yet.
                                        Start creating engaging learning content for your students.
                                    </p>

                                    @if(auth()->user()->role_id != 1)
                                    <a href="{{route('course.create')}}" class="btn btn-primary px-4">
                                        <i class="material-icons align-middle me-1">add</i>
                                        Create First Course
                                    </a>
                                    @endif

                                </div>
                            </div>

                            @endforelse
                        </div>
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
<script>
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            navigator.clipboard.writeText(url).then(() => {
                this.innerHTML = '<i class="fa fa-check text-success"></i> Copied!';
                setTimeout(() => {
                    this.innerHTML = '<i class="fa fa-copy"></i> Copy';
                }, 2000);
            });
        });
    });
</script>
@endpush