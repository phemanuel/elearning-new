@extends('backend.layouts.app')
@section('title', 'Enrollment List')

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
                    <h4>Enrollments</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">All Enrollment</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">

                        <div class="lms-card">

                            <!-- Header -->
                            <div class="lms-card-header">

                                <div>
                                    <div class="lms-card-title">All Enrollments</div>
                                    <div style="font-size:12px; color:#64748b; margin-top:2px;">
                                        Track student course registrations and progress
                                    </div>
                                </div>

                                <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">

                                    @if(auth()->user()->role_id != 1)

                                        <!-- Stats -->
                                        <span class="lms-badge" style="background:#065f46; color:#fff;">
                                            Total: {{ $noOfStudent }}
                                        </span>

                                        <span class="lms-badge" style="background:#7c2d12; color:#fff;">
                                            Enrolled: {{ $noOfStudentEnrolled }}
                                        </span>

                                        <span class="lms-badge" style="background:#ea580c; color:#fff;">
                                            Remaining: {{ $noOfStudent - $noOfStudentEnrolled }}
                                        </span>

                                        <!-- Action -->
                                        <a href="{{ route('enrollment.create') }}"
                                        style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:10px; font-size:13px; font-weight:600;">
                                            + Enroll Student
                                        </a>

                                    @endif

                                </div>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Segment</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($enrollment as $e)

                                            <tr>

                                                <!-- Student -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:12px;">

                                                        <img src="{{ asset('uploads/students/'.$e->student?->image) }}"
                                                            style="width:40px; height:40px; border-radius:50%; object-fit:cover;"
                                                            alt="student">

                                                        <span style="font-weight:600;">
                                                            {{ $e->student?->name_en }}
                                                        </span>

                                                    </div>
                                                </td>

                                                <!-- Course -->
                                                <td>
                                                    <span style="font-weight:500;">
                                                        {{ $e->course?->title_en }}
                                                    </span>
                                                </td>

                                                <!-- Segment -->
                                                <td>
                                                    <span style="font-weight:600;">
                                                        {{ $e->segment }}
                                                    </span>
                                                </td>

                                                <!-- Status -->
                                                <td>
                                                    @if($e->completed == 1)
                                                        <span class="lms-badge lms-badge-success">
                                                            Completed
                                                        </span>
                                                    @else
                                                        <span class="lms-badge lms-badge-warning">
                                                            In Progress
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Price -->
                                                <td>
                                                    @if($e->course?->price == null)
                                                        <span class="lms-badge lms-badge-success">Free</span>
                                                    @else
                                                        <span style="font-weight:600;">
                                                            {{ $e->course?->currency_type }}{{ number_format($e->course?->price, 2) }}
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Date -->
                                                <td>
                                                    <span style="font-size:13px; color:#64748b;">
                                                        {{ $e->enrollment_date }}
                                                    </span>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Enrollments Found
                                                </td>
                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

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


@endpush