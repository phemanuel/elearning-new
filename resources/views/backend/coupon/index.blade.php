@extends('backend.layouts.app')
@section('title', 'Coupon List')

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
                    <h4>Coupon List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('coupon.index')}}">Coupons</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('coupon.index')}}">All Coupon</a></li>
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
                                    <div class="lms-card-title">Coupon Management</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Manage discount campaigns and promotional offers
                                    </div>
                                </div>

                                <a href="{{ route('coupon.create') }}" class="lms-btn">
                                    + Create Coupon
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Coupon</th>
                                            <th>Course</th>
                                            <th>Discount</th>
                                            <th>Valid Period</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($coupon as $key => $c)

                                        @php
                                            $expired = \Carbon\Carbon::parse($c->valid_until)->isPast();
                                        @endphp

                                        <tr>

                                            <!-- Coupon -->
                                            <td>
                                                <div>
                                                    <div style="font-weight:700; font-size:14px;">
                                                        {{ $c->code }}
                                                    </div>

                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Coupon #{{ $key + 1 }}
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Course -->
                                            <td>
                                                <div style="font-weight:600;">
                                                    {{ $c->course ? $c->course->title_en : 'No Course Assigned' }}
                                                </div>

                                                <div style="font-size:11px; color:#94a3b8;">
                                                    Learning Program
                                                </div>
                                            </td>

                                            <!-- Discount -->
                                            <td>
                                                <span class="lms-badge lms-badge-success">
                                                    {{ $c->discount }}% OFF
                                                </span>
                                            </td>

                                            <!-- Validity -->
                                            <td>

                                                <div style="font-weight:600;">
                                                    {{ \Carbon\Carbon::parse($c->valid_from)->format('d M Y') }}
                                                </div>

                                                <div style="font-size:11px; color:#94a3b8;">
                                                    Until {{ \Carbon\Carbon::parse($c->valid_until)->format('d M Y') }}
                                                </div>

                                            </td>

                                            <!-- Status -->
                                            <td>

                                                @if($expired)
                                                    <span class="lms-badge lms-badge-danger">
                                                        Expired
                                                    </span>
                                                @else
                                                    <span class="lms-badge lms-badge-success">
                                                        Active
                                                    </span>
                                                @endif

                                            </td>

                                            <!-- Actions -->
                                            <td>

                                                <div style="display:flex; gap:8px;">

                                                    <a href="{{ route('coupon.edit', encryptor('encrypt', $c->id)) }}"
                                                    class="lms-btn">
                                                        Edit
                                                    </a>

                                                    <a href="javascript:void(0);"
                                                    onclick="$('#form{{$c->id}}').submit()"
                                                    class="lms-btn-danger">
                                                        Delete
                                                    </a>

                                                </div>

                                                <form id="form{{$c->id}}"
                                                    action="{{ route('coupon.destroy', $c->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </td>

                                        </tr>

                                        @empty

                                        <tr>
                                            <td colspan="6"
                                                style="text-align:center; padding:30px; color:#94a3b8;">
                                                No Coupons Found
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