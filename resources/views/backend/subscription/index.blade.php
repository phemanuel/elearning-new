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
                            <div class="row">

    @forelse($subscriptionPlan as $d)

        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">

            <div class="lms-pricing-card">

                <!-- Plan Header -->
                <div class="lms-plan-header">

                    <h4>{{ $d->name }}</h4>

                    <div class="lms-plan-price">

                        @if($d->amount >= 50000)
                            <span>Custom Plan</span>
                        @else
                            <span class="amount">
                                ₦{{ number_format($d->amount,0) }}
                            </span>

                            <small>/month</small>
                        @endif

                    </div>

                </div>

                <!-- Features -->
                <div class="lms-plan-features">

                    <div class="feature-item">
                        📚 Courses:
                        <strong>
                            {{ $d->course_upload >= 50 ? 'Unlimited' : $d->course_upload }}
                        </strong>
                    </div>

                    <div class="feature-item">
                        👥 Students:
                        <strong>
                            {{ $d->student_upload >= 2000 ? 'Unlimited' : $d->student_upload }}
                        </strong>
                    </div>

                    <div class="feature-item">
                        💾 Storage:
                        <strong>
                            {{ $d->allocated_space >= 50 ? 'Unlimited' : $d->allocated_space.' GB' }}
                        </strong>
                    </div>

                    <div class="feature-item">
                        💳 Transaction Fee:
                        <strong>{{ $d->transaction_fee }}%</strong>
                    </div>

                    <div class="feature-item">
                        📅 Extra Days:
                        <strong>{{ $d->extra_day }}</strong>
                    </div>

                </div>

                <!-- Status -->
                <div class="lms-plan-badges">

                    @if($d->certificate)
                        <span class="lms-badge lms-badge-success">
                            Certificate Enabled
                        </span>
                    @else
                        <span class="lms-badge lms-badge-danger">
                            No Certificate
                        </span>
                    @endif

                    @if($d->enrollment)
                        <span class="lms-badge lms-badge-success">
                            Manual Enrollment
                        </span>
                    @else
                        <span class="lms-badge lms-badge-danger">
                            No Enrollment
                        </span>
                    @endif

                </div>

                <!-- Actions -->
                <div class="lms-plan-actions">

                    <a href="{{route('subscriptionPlan.edit', encryptor('encrypt', $d->id))}}"
                       class="lms-btn">
                        Edit Plan
                    </a>

                    <a href="javascript:void(0);"
                       onclick="$('#form{{$d->id}}').submit()"
                       class="lms-btn-danger">
                        Delete
                    </a>

                    <form id="form{{$d->id}}"
                          action="{{route('subscriptionPlan.destroy', $d->id)}}"
                          method="post">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="lms-empty-state">

                <h5>No Subscription Plans Found</h5>

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