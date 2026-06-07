@extends('backend.layouts.app')
@section('title', 'Subscription List')

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
                    <h4>Subscription Plan</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Subscription Plan</a></li>
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
                                    <div class="lms-card-title">Subscription Plans</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Manage pricing tiers and feature limits
                                    </div>
                                </div>

                                <a href="{{route('subscriptionPlan.create')}}" class="lms-btn">
                                    + Add Plan
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Plan</th>
                                            <th>Limits</th>
                                            <th>Features</th>
                                            <th>Pricing</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($subscriptionPlan as $key => $d)

                                            <tr>

                                                <!-- PLAN NAME -->
                                                <td>
                                                    <div style="font-weight:700;">
                                                        {{ $d->name }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Tier {{ $key + 1 }}
                                                    </div>
                                                </td>

                                                <!-- LIMITS (GROUPED) -->
                                                <td>
                                                    <div style="font-size:13px; line-height:1.7;">

                                                        <div>
                                                            📚 Courses:
                                                            <strong>
                                                                {{ $d->course_upload >= 50 ? 'Unlimited' : $d->course_upload }}
                                                            </strong>
                                                        </div>

                                                        <div>
                                                            👥 Students:
                                                            <strong>
                                                                {{ $d->student_upload >= 2000 ? 'Unlimited' : $d->student_upload }}
                                                            </strong>
                                                        </div>

                                                        <div>
                                                            💾 Storage:
                                                            <strong>
                                                                {{ $d->allocated_space >= 50 ? 'Unlimited' : $d->allocated_space . 'GB' }}
                                                            </strong>
                                                        </div>

                                                    </div>
                                                </td>

                                                <!-- FEATURES -->
                                                <td>
                                                    <div style="display:flex; flex-direction:column; gap:6px;">

                                                        <span class="lms-badge {{ $d->certificate ? 'lms-badge-success' : 'lms-badge-danger' }}">
                                                            Certificate: {{ $d->certificate ? 'Enabled' : 'Disabled' }}
                                                        </span>

                                                        <span class="lms-badge {{ $d->enrollment ? 'lms-badge-success' : 'lms-badge-danger' }}">
                                                            Manual Enrollment: {{ $d->enrollment ? 'Yes' : 'No' }}
                                                        </span>

                                                    </div>
                                                </td>

                                                <!-- PRICING -->
                                                <td>
                                                    <div style="font-weight:700; font-size:16px;">
                                                        {{ $d->amount >= 50000 ? 'Custom' : '₦' . number_format($d->amount,2) }}
                                                    </div>

                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        / month
                                                    </div>

                                                    <div style="margin-top:6px; font-size:12px;">
                                                        Fee: {{ $d->transaction_fee }}%
                                                    </div>

                                                    <div style="font-size:12px;">
                                                        Extra Days: {{ $d->extra_day }}
                                                    </div>
                                                </td>

                                                <!-- ACTION -->
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{route('subscriptionPlan.edit', encryptor('encrypt', $d->id))}}"
                                                        class="lms-btn">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{$d->id}}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{$d->id}}"
                                                        action="{{route('subscriptionPlan.destroy', $d->id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="5"
                                                    style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Subscription Plans Found
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