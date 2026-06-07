@extends('backend.layouts.app')
@section('title', 'Course Fees')

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
                    <h4>Payments </h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Course Fees</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <li class="nav-item"><a href="javascript:void(0);" data-toggle="tab"
                            class="nav-link btn-primary">Grid
                            View</a></li>
                </ul>
            </div> -->
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">

                        <div class="lms-card">

                            <!-- Header -->
                            <div class="lms-card-header">

                                <div>
                                    <div class="lms-card-title">Course Payments</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Track student payments and instructor earnings
                                    </div>
                                </div>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Course</th>

                                            @if(auth()->user()->role_id == 1)
                                                <th>Instructor</th>
                                            @endif

                                            <th>Amount</th>
                                            <th>Payout Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($payments as $index => $payment)

                                            <tr>

                                                <!-- Student -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $payment->student?->name_en ?? 'N/A' }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Student
                                                    </div>
                                                </td>

                                                <!-- Course -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $payment->course?->title_en }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Course Payment
                                                    </div>
                                                </td>

                                                <!-- Instructor (Admin only) -->
                                                @if(auth()->user()->role_id == 1)
                                                    <td>
                                                        <div style="font-weight:600;">
                                                            {{ $payment->course->instructor->name_en ?? 'N/A' }}
                                                        </div>
                                                        <div style="font-size:11px; color:#94a3b8;">
                                                            Instructor
                                                        </div>
                                                    </td>
                                                @endif

                                                <!-- Amount -->
                                                <td>
                                                    <div style="font-weight:700; color:#0f172a;">
                                                        ₦{{ number_format($payment->amount, 2) }}
                                                    </div>
                                                </td>

                                                <!-- Payout -->
                                                <td>
                                                    <span class="lms-badge lms-badge-success">
                                                        Paid
                                                    </span>
                                                </td>

                                                <!-- Date -->
                                                <td>
                                                    <div style="font-size:13px;">
                                                        {{ \Carbon\Carbon::parse($payment->created_at)->format('jS M, Y') }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Transaction Date
                                                    </div>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6"
                                                    style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Payments Found
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