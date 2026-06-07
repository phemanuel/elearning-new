@extends('backend.layouts.app')
@section('title', 'Instructor Dashboard') 

@push('styles')
<link rel="stylesheet" href="{{asset('vendor/jqvmap/css/jqvmap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/chartist/css/chartist.min.css')}}">
<link rel="stylesheet" href="{{asset('css/skin-2.css')}}">
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<style>
    .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-effect:hover {
        transform: scale(1.05); /* Slightly increase size */
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2); /* Add a glow */
    }
</style>
@endpush

@section('content')

<div class="content-body">
<div class="row page-titles mx-0">           
    <!-- row -->
    <div class="container-fluid">
        @if(!empty($instructor->instructor_url))
        <div class="row mb-4">

            <div class="col-lg-8">

                <div class="profile-link-card">

                    <div class="profile-link-icon">
                        <i class="fa fa-globe"></i>
                    </div>

                    <div class="profile-link-content">

                        <h6 class="mb-1">
                            Public Instructor Profile
                        </h6>

                        <a href="https://kingsdigihub.org/instructor-profile/{{ $instructor->instructor_url }}"
                        target="_blank"
                        class="profile-link">

                            kingsdigihub.org/instructor-profile/{{ $instructor->instructor_url }}

                        </a>

                    </div>

                    <button class="btn btn-primary btn-sm copy-profile-btn"
                            onclick="copyToClipboard()">

                        <i class="fa fa-copy me-1"></i>
                        Copy

                    </button>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="d-flex justify-content-lg-end mt-3 mt-lg-0">

                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Home</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>

                </div>

            </div>

        </div>
        @endif
        <div class="row">

            <!-- Enrolled Students -->
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <a href="{{ route('enrollment.index') }}" class="text-decoration-none">
                    <div class="dashboard-card students-card">

                        <div class="card-bg-icon">
                            <i class="fa fa-user-graduate"></i>
                        </div>

                        <div class="dashboard-card-content">
                            <span class="card-title">Enrolled Students</span>

                            <h2 class="card-number">
                                {{ number_format($enrollments->count()) }}
                            </h2>

                            <small>Total learners enrolled</small>
                        </div>

                    </div>
                </a>
            </div>

            <!-- Courses -->
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <a href="{{ route('course.index') }}" class="text-decoration-none">
                    <div class="dashboard-card courses-card">

                        <div class="card-bg-icon">
                            <i class="fa fa-book-open"></i>
                        </div>

                        <div class="dashboard-card-content">
                            <span class="card-title">My Courses</span>

                            <h2 class="card-number">
                                {{ number_format($course->count()) }}
                            </h2>

                            <small>Published courses</small>
                        </div>

                    </div>
                </a>
            </div>

            <!-- Revenue -->
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <a href="{{ route('courseFee') }}" class="text-decoration-none">
                    <div class="dashboard-card revenue-card">

                        <div class="card-bg-icon">
                            <i class="fa fa-wallet"></i>
                        </div>

                        <div class="dashboard-card-content">
                            <span class="card-title">Fees Collection</span>

                            <h2 class="card-number">
                                ₦{{ number_format($totalCourseFee,0) }}
                            </h2>

                            <small>Total earnings</small>
                        </div>

                    </div>
                </a>
            </div>

            <!-- Coupons -->
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <a href="{{ route('coupon.index') }}" class="text-decoration-none">
                    <div class="dashboard-card coupon-card">

                        <div class="card-bg-icon">
                            <i class="fa fa-ticket-alt"></i>
                        </div>

                        <div class="dashboard-card-content">
                            <span class="card-title">Coupons</span>

                            <h2 class="card-number">
                                {{ number_format($coupons->count()) }}
                            </h2>

                            <small>Available coupons</small>
                        </div>

                    </div>
                </a>
            </div>

            <div class="col-xl-8 col-xxl-8 col-lg-8 col-md-12 col-sm-12">

                <div class="card enrolled-card border-0">

                    <div class="card-header bg-white border-0 py-4">

                        <div class="d-flex justify-content-between align-items-center flex-wrap w-100">

                            <div>
                                <h4 class="fw-bold mb-1">
                                    Enrolled Students
                                </h4>

                                <p class="text-muted mb-0">
                                    Monitor student progress and engagement
                                </p>
                            </div>

                            <div class="student-counter mt-2 mt-md-0">
                                <i class="fa fa-user-graduate me-2"></i>
                                {{ $enrollments->total() }} Students
                            </div>

                        </div>

                    </div>

                    <div class="card-body pt-0">

                        <div class="table-responsive">

                            <table id="example3" class="table modern-table align-middle">

                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Total Segments</th>
                                        <th>Current Segment</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Enrolled</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($enrollments as $enrollment)

                                    @php
                                        $totalSegments = $enrollment->course->segments_count ?? 0;

                                        $progress = $totalSegments > 0
                                            ? min(100, round(($enrollment->segment / $totalSegments) * 100))
                                            : 0;
                                    @endphp

                                    <tr>

                                        <!-- Student -->
                                        <td>

                                            <div class="d-flex align-items-center">

                                                <img
                                                    src="{{ asset('uploads/students/' . $enrollment->student->image) }}"
                                                    class="student-avatar me-3"
                                                    alt="">

                                                <div>

                                                    <div class="fw-semibold">
                                                        {{ $enrollment->student->name_en }}
                                                    </div>

                                                    <small class="text-muted">
                                                        Student
                                                    </small>

                                                </div>

                                            </div>

                                        </td>

                                        <!-- Course -->
                                        <td>

                                            <div class="course-pill">
                                                {{ $enrollment->course->title_en }}
                                            </div>

                                        </td>

                                        <!-- Total Segments -->
                                        <td>

                                            <span class="metric-badge">
                                                {{ $totalSegments }}
                                            </span>

                                        </td>

                                        <!-- Current Segment -->
                                        <td>

                                            <span class="metric-badge active-segment">
                                                {{ $enrollment->segment }}
                                            </span>

                                        </td>

                                        <!-- Progress -->
                                        <td width="180">

                                            <div class="progress modern-progress">

                                                <div class="progress-bar"
                                                    role="progressbar"
                                                    style="width: {{ $progress }}%">
                                                </div>

                                            </div>

                                            <small class="fw-bold text-primary">
                                                {{ $progress }}%
                                            </small>

                                        </td>

                                        <!-- Status -->
                                        <td>

                                            @if($enrollment->completed == 1)

                                                <span class="status-completed">
                                                    Completed
                                                </span>

                                            @else

                                                <span class="status-progress">
                                                    In Progress
                                                </span>

                                            @endif

                                        </td>

                                        <!-- Date -->
                                        <td>

                                            <div class="text-muted">
                                                {{ $enrollment->created_at->format('d M Y') }}
                                            </div>

                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="mt-4">
                            {{ $enrollments->links() }}
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-12 col-sm-12">

                <div class="card subscription-widget border-0">

                    <div class="card-header bg-white border-0">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h4 class="fw-bold mb-1">
                                    Subscription Plan
                                </h4>

                                <small class="text-muted">
                                    Manage your LMS subscription
                                </small>
                            </div>

                            <i class="fas fa-crown text-warning fs-3"></i>

                        </div>

                    </div>

                    <div class="card-body">

                        @if(empty($subscriptions))

                            <div class="empty-plan">

                                <div class="plan-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>

                                <h4>No Active Plan</h4>

                                <p>
                                    Subscribe to start uploading courses and onboarding students.
                                </p>

                                <a href="{{route('subscription.view')}}"
                                class="btn btn-primary btn-lg rounded-pill">
                                    Subscribe Now
                                </a>

                            </div>

                        @elseif($subscriptions->amount > 0 && $subscriptions->end_date < $currentDate)

                            <div class="expired-plan">

                                <div class="plan-icon bg-danger-soft">
                                    <i class="fas fa-exclamation-circle text-danger"></i>
                                </div>

                                <h4>Plan Expired</h4>

                                <p>
                                    Your subscription has expired.
                                </p>

                                <a href="{{route('subscription.view')}}"
                                class="btn btn-danger rounded-pill">
                                    Renew Now
                                </a>

                            </div>

                        @else

                            @php
                            $daysLeft = now()->diffInDays(
                                \Carbon\Carbon::parse($subscriptions->end_date),
                                false
                            );
                            @endphp

                            <div class="compact-subscription">

                                <!-- Top Row -->
                                <div class="subscription-top">

                                    <div class="d-flex align-items-center">

                                        <div class="subscription-icon">
                                            <i class="{{$subscriptions->subscriptionPlan->icon}}"></i>
                                        </div>

                                        <div class="ms-3">

                                            <h5 class="mb-1">
                                                {{$subscriptions->subscriptionPlan->name}}
                                            </h5>

                                            <span class="subscription-status">
                                                Active
                                            </span>

                                        </div>

                                    </div>

                                    <a href="{{route('subscription.view')}}"
                                    class="btn btn-sm btn-primary">
                                        Upgrade
                                    </a>

                                </div>

                                <!-- Quick Stats -->

                                <div class="subscription-stats">

                                    <div class="mini-stat">
                                        <i class="fas fa-upload"></i>
                                        <strong>{{$subscriptions->subscriptionPlan->course_upload}}</strong>
                                        <small>Courses</small>
                                    </div>

                                    <div class="mini-stat">
                                        <i class="fas fa-users"></i>
                                        <strong>{{$subscriptions->subscriptionPlan->student_upload}}</strong>
                                        <small>Students</small>
                                    </div>

                                    <div class="mini-stat">
                                        <i class="fas fa-hdd"></i>
                                        <strong>{{$subscriptions->subscriptionPlan->allocated_space}}GB</strong>
                                        <small>Storage</small>
                                    </div>

                                </div>

                                <!-- Dates -->

                                <div class="subscription-footer">

                                    <div>
                                        <small>Expires</small>
                                        <div>
                                            {{ \Carbon\Carbon::parse($subscriptions->end_date)->format('d M Y') }}
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <small>Remaining</small>
                                        <div class="text-success fw-bold">
                                            {{ $daysLeft }} Days
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="mt-4">

                                <a href="{{route('subscription.view')}}"
                                class="btn btn-success w-100 rounded-pill">

                                    <i class="fas fa-arrow-up me-2"></i>

                                    Upgrade Plan

                                </a>

                            </div>

                        @endif

                    </div>

                </div>

            </div>
            <div class="col-lg-12">

                <div class="card courses-dashboard-card border-0">

                    <div class="card-header bg-white border-0 py-4">

                        <div class="d-flex justify-content-between align-items-center w-100">

                            <div>
                                <h4 class="fw-bold mb-1">
                                    My Courses
                                </h4>

                                <p class="text-muted mb-0">
                                    Manage and monitor your learning content
                                </p>
                            </div>

                            <div class="student-counter ms-auto">
                                <i class="fa fa-book-open me-2"></i>
                                {{ $courseShow->total() }} Courses
                            </div>

                        </div>

                    </div>

                    <div class="card-body pt-0">

                        <div class="table-responsive">

                            <table id="example3" class="table course-table align-middle">

                                <thead>

                                    <tr>
                                        <th>Course</th>
                                        <th>Segments</th>
                                        <th>Difficulty</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($courseShow as $d)

                                    <tr>

                                        <!-- Course -->

                                        <td>

                                            <div class="d-flex align-items-center">

                                                <img
                                                    src="{{asset('uploads/courses/'.$d->image)}}"
                                                    class="course-thumb me-3"
                                                    alt="">

                                                <div>

                                                    <h6 class="mb-1 fw-bold">
                                                        {{$d->title_en}}
                                                    </h6>

                                                    <small class="text-muted">
                                                        Course Content
                                                    </small>

                                                </div>

                                            </div>

                                        </td>

                                        <!-- Segments -->

                                        <td>

                                            <span class="segments-pill">

                                                {{$d->segment_count}}

                                            </span>

                                        </td>

                                        <!-- Difficulty -->

                                        <td>

                                            @if($d->difficulty == 'beginner')

                                                <span class="difficulty beginner">

                                                    Beginner

                                                </span>

                                            @elseif($d->difficulty == 'intermediate')

                                                <span class="difficulty intermediate">

                                                    Intermediate

                                                </span>

                                            @else

                                                <span class="difficulty advanced">

                                                    Advanced

                                                </span>

                                            @endif

                                        </td>

                                        <!-- Category -->

                                        <td>

                                            <span class="category-pill">

                                                {{$d->courseCategory?->category_name}}

                                            </span>

                                        </td>

                                        <!-- Price -->

                                        <td>

                                            @if($d->price > 0)

                                                <span class="price-tag">

                                                    ₦{{ number_format($d->price,2) }}

                                                </span>

                                            @else

                                                <span class="free-course">

                                                    Free

                                                </span>

                                            @endif

                                        </td>

                                        <!-- Status -->

                                        <td>

                                            @if($d->status == 2)

                                                <span class="status-active">

                                                    Active

                                                </span>

                                            @elseif($d->status == 1)

                                                <span class="status-pending">

                                                    Pending

                                                </span>

                                            @else

                                                <span class="status-inactive">

                                                    Inactive

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="mt-4">
                            {{$courseShow->links()}}
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Chart ChartJS plugin files -->
<script src="{{asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>

<!-- Chart piety plugin files -->
<script src="{{asset('vendor/peity/jquery.peity.min.js')}}"></script>

<!-- Chart sparkline plugin files -->
<script src="{{asset('vendor/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Demo scripts -->
<script src="{{asset('js/dashboard/dashboard-3.js')}}"></script>
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

<script>
    function copyToClipboard() {
        var tempInput = document.createElement("input");
        tempInput.value = "https://kingsdigihub.org/instructor-profile/{{ $instructor->instructor_url }}";
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);

        // Change button text and icon
        var copyButton = document.getElementById("copyButton");
        copyButton.innerHTML = '<i class="fa fa-check"></i> Copied';
        copyButton.classList.remove("btn-primary");
        copyButton.classList.add("btn-success");

        // Revert back to "Copy" after 3 seconds
        setTimeout(function() {
            copyButton.innerHTML = '<i class="fa fa-copy"></i> Copy';
            copyButton.classList.remove("btn-success");
            copyButton.classList.add("btn-primary");
        }, 2000);
    }
</script>
@endpush