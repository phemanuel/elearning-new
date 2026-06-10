@extends('backend.layouts.app')
@section('title', 'Admin Dashboard')

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
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <!-- All Students -->
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <a href="{{ route('enrollment.index') }}" class="text-decoration-none">
                    <div class="dashboard-card students-card">

                        <div class="card-bg-icon">
                            <i class="fa fa-user-graduate"></i>
                        </div>

                        <div class="dashboard-card-content">
                            <span class="card-title"> Students</span>

                            <h2 class="card-number">
                                {{ number_format($student->count()) }}
                            </h2>

                            <small>Total learners registered</small>
                        </div>

                    </div>
                </a>
            </div>

            <!-- Enrolled Students -->
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <a href="{{ route('enrollment.index') }}" class="text-decoration-none">
                    <div class="dashboard-card coupon-card">

                        <div class="card-bg-icon">
                            <i class="fa fa-user-graduate"></i>
                        </div>

                        <div class="dashboard-card-content">
                            <span class="card-title">Enrolled Students</span>

                            <h2 class="card-number">
                                {{ number_format($allEnrollments->count()) }}
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
                            <span class="card-title">Courses</span>

                            <h2 class="card-number">
                                {{ number_format($allCourse->count()) }}
                            </h2>

                            <small>All courses</small>
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
            <!-- <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <a href="{{ route('coupon.index') }}" class="text-decoration-none">
                    <div class="dashboard-card coupon-card">

                        <div class="card-bg-icon">
                            <i class="fa fa-ticket-alt"></i>
                        </div>

                        <div class="dashboard-card-content">
                            <span class="card-title">Coupons</span>

                            <h2 class="card-number">
                                {{ number_format($allCoupon->count()) }}
                            </h2>

                            <small>Available coupons</small>
                        </div>

                    </div>
                </a>
            </div> -->

            
                <div class="col-xl-8 col-xxl-8 col-lg-8 col-md-12 col-sm-12">

                <div class="lms-card">

                    <!-- Header -->
                    <div class="lms-card-header">
                        <div>
                            <div class="lms-card-title">Enrolled Students</div>
                            <div style="font-size:12px; color:#6b7280; margin-top:2px;">
                                Track student progress across all courses
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="lms-table-wrapper">

                        <table class="lms-table">

                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Course</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($allEnrollments as $enrollment)

                                    @php
                                        $total = $enrollment->course->segments_count ?? 1;
                                        $current = $enrollment->segment ?? 0;
                                        $percent = $total > 0 ? round(($current / $total) * 100) : 0;
                                    @endphp

                                    <tr>

                                        <!-- Student Block -->
                                        <td>
                                            <div style="display:flex; align-items:center; gap:12px;">

                                                <img
                                                    src="{{ asset('uploads/students/' . $enrollment->student->image) }}"
                                                    class="lms-avatar"
                                                    alt="student"
                                                    onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'"
                                                >

                                                <div>
                                                    <div style="font-weight:600;">
                                                        {{ $enrollment->student->name_en }}
                                                    </div>
                                                    <div style="font-size:12px; color:#6b7280;">
                                                        Student ID: #{{ $enrollment->student->id }}
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                        <!-- Course -->
                                        <td>
                                            <div style="font-weight:500;">
                                                {{ $enrollment->course->title_en }}
                                            </div>
                                            <div style="font-size:12px; color:#6b7280;">
                                                {{ $total }} segments
                                            </div>
                                        </td>

                                        <!-- Progress (IMPORTANT LMS UPGRADE) -->
                                        <td>
                                            <div style="width:140px;">

                                                <div style="display:flex; justify-content:space-between; font-size:12px; margin-bottom:4px;">
                                                    <span>{{ $current }}/{{ $total }}</span>
                                                    <span>{{ $percent }}%</span>
                                                </div>

                                                <div style="height:6px; background:#e5e7eb; border-radius:999px; overflow:hidden;">
                                                    <div style="width:{{ $percent }}%; height:100%; background:#2563eb;"></div>
                                                </div>

                                            </div>
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            @if($enrollment->completed == 1)
                                                <span class="lms-badge lms-badge-success">
                                                    Completed
                                                </span>
                                            @else
                                                <span class="lms-badge lms-badge-warning">
                                                    In Progress
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Date -->
                                        <td>
                                            <div style="font-size:13px;">
                                                {{ $enrollment->created_at->format('d M Y') }}
                                            </div>
                                            <div style="font-size:11px; color:#9ca3af;">
                                                {{ $enrollment->created_at->diffForHumans() }}
                                            </div>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-12 col-sm-12">

    <div class="lms-card">

        <!-- Header -->
        <div class="lms-card-header">
            <div>
                <div class="lms-card-title">Subscription Plans</div>
                <div style="font-size:12px; color:#64748b; margin-top:2px;">
                    Instructor billing overview
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="lms-table-wrapper lms-scroll">

            <table class="lms-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Instructor</th>
                        <th>Plan</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($instructorPlan as $key => $p)

                        <tr>

                            <!-- Index -->
                            <td style="width:50px;">
                                <span style="font-weight:600; color:#64748b;">
                                    {{ $key + 1 }}
                                </span>
                            </td>

                            <!-- Instructor -->
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">

                                    <div class="lms-avatar" style="display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; background:#eef2ff; color:#2563eb;">
                                        {{ strtoupper(substr($p->name_en, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div style="font-weight:600;">
                                            {{ $p->name_en }}
                                        </div>
                                        <div style="font-size:11px; color:#94a3b8;">
                                            Instructor
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <!-- Plan -->
                            <td>
                                @if($p->currentPlan)

                                    <span class="lms-badge lms-badge-success">
                                        {{ $p->currentPlan->name }}
                                    </span>

                                @else

                                    <span class="lms-badge lms-badge-warning">
                                        No Plan
                                    </span>

                                @endif
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
<hr>
            <div class="col-lg-12 mt-2">

                <div class="lms-card">

                    <!-- Header -->
                    <div class="lms-card-header">
                        <div>
                            <div class="lms-card-title">Courses</div>
                            <div style="font-size:12px; color:#64748b; margin-top:2px;">
                                Manage all published and draft courses
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="lms-table-wrapper">

                        <table class="lms-table" id="example3">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th>Segments</th>
                                    <th>Level</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($courseShow as $key => $d)

                                    <tr>

                                        <!-- Index -->
                                        <td style="width:40px;">
                                            <span style="font-weight:600; color:#64748b;">
                                                {{ $key + 1 }}
                                            </span>
                                        </td>

                                        <!-- Course Image -->
                                        <td style="width:70px;">
                                            <img
                                                src="{{ asset('uploads/courses/'.$d->image) }}"
                                                class="lms-avatar"
                                                style="border-radius:12px; width:46px; height:46px;"
                                                alt="course"
                                                onerror="this.src='{{ asset('uploads/courses/course_blank.jpg') }}'"
                                            >
                                        </td>

                                        <!-- Title -->
                                        <td>
                                            <div style="font-weight:600;">
                                                {{ $d->title_en }}
                                            </div>
                                            <div style="font-size:11px; color:#94a3b8;">
                                                Course ID: #{{ $d->id }}
                                            </div>
                                        </td>

                                        <!-- Segments -->
                                        <td>
                                            <span style="font-weight:600;">
                                                {{ $d->segment_count }}
                                            </span>
                                            <div style="font-size:11px; color:#94a3b8;">
                                                lessons
                                            </div>
                                        </td>

                                        <!-- Difficulty -->
                                        <td>
                                            @php
                                                $level = $d->difficulty;
                                            @endphp

                                            @if($level == 'beginner')
                                                <span class="lms-badge lms-badge-success">Beginner</span>
                                            @elseif($level == 'intermediate')
                                                <span class="lms-badge lms-badge-warning">Intermediate</span>
                                            @else
                                                <span class="lms-badge lms-badge-danger">Advanced</span>
                                            @endif
                                        </td>

                                        <!-- Category -->
                                        <td>
                                            <span style="font-size:13px;">
                                                {{ $d->courseCategory?->category_name }}
                                            </span>
                                        </td>

                                        <!-- Price -->
                                        <td>
                                            @if($d->price == 0)
                                                <span class="lms-badge lms-badge-success">Free</span>
                                            @else
                                                <span style="font-weight:600;">
                                                    ₦{{ number_format($d->price, 2) }}
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            @if($d->status == 2)
                                                <span class="lms-badge lms-badge-success">Active</span>
                                            @elseif($d->status == 1)
                                                <span class="lms-badge lms-badge-warning">Pending</span>
                                            @else
                                                <span class="lms-badge lms-badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

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
@endpush