@extends('backend.layouts.app')
@section('title', 'Subscriptions')

@push('styles')
<!-- Datatable -->
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Subscriptions</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Subscriptions</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid
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
                                    <div class="lms-card-title">Subscriptions</div>
                                    <div style="font-size:12px;color:#64748b;">
                                        Manage instructor subscriptions and plan allocations
                                    </div>
                                </div>

                                <a href="{{ route('subscription.create') }}"
                                class="lms-btn">
                                    + Add Subscription
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Instructor</th>
                                            <th>Plan</th>
                                            <th>Billing</th>
                                            <th>Resources</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($subscriptions as $subscription)

                                            <tr>

                                                <!-- Instructor -->
                                                <td>

                                                    <div style="font-weight:600;">
                                                        {{ $subscription->instructor?->name_en ?? 'No Instructor' }}
                                                    </div>

                                                    <div style="font-size:11px;color:#94a3b8;">
                                                        Instructor Account
                                                    </div>

                                                </td>

                                                <!-- Plan -->
                                                <td>

                                                    <div style="font-weight:700;">
                                                        {{ $subscription->subscriptionPlan?->name ?? 'No Plan Assigned' }}
                                                    </div>

                                                    <div style="font-size:11px;color:#94a3b8;">
                                                        {{ $subscription->no_of_months }} Month(s)
                                                    </div>

                                                </td>

                                                <!-- Billing -->
                                                <td>

                                                    <div style="font-weight:700;font-size:15px;">
                                                        ₦{{ number_format($subscription->total_amount, 2) }}
                                                    </div>

                                                    <div style="font-size:12px;color:#64748b;">
                                                        Monthly:
                                                        ₦{{ number_format($subscription->subscriptionPlan?->amount ?? 0, 2) }}
                                                    </div>

                                                </td>

                                                <!-- Resources -->
                                                <td>

                                                    <div style="display:flex;flex-direction:column;gap:4px;font-size:13px;">

                                                        <span>
                                                            📚
                                                            {{ $subscription->subscriptionPlan?->course_upload ?? 'N/A' }}
                                                            Courses
                                                        </span>

                                                        <span>
                                                            👥
                                                            {{ $subscription->subscriptionPlan?->student_upload ?? 'N/A' }}
                                                            Students
                                                        </span>

                                                        <span>
                                                            💾
                                                            {{ $subscription->subscriptionPlan?->allocated_space ?? 'N/A' }}GB
                                                        </span>

                                                    </div>

                                                </td>

                                                <!-- Date -->
                                                <td>

                                                    <div>
                                                        {{ \Carbon\Carbon::parse($subscription->created_at)->format('M d, Y') }}
                                                    </div>

                                                    <div style="font-size:11px;color:#94a3b8;">
                                                        Subscription Date
                                                    </div>

                                                </td>

                                                <!-- Actions -->
                                                <td>

                                                    <div style="display:flex;gap:8px;">

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{$subscription->id}}').submit()"
                                                        class="lms-btn lms-btn-delete">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{$subscription->id}}"
                                                        action="{{ route('subscription.destroy', $subscription->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6"
                                                    style="text-align:center;padding:30px;color:#94a3b8;">
                                                    No Subscriptions Found
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
<!--**********************************
    Content body end
***********************************-->

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
@endpush