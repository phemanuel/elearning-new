@extends('backend.layouts.app')
@section('title', 'Event List')

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
                    <h4>Event List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('event.index')}}">Events</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('event.index')}}">All Event</a></li>
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
                                    <div class="lms-card-title">Events</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Manage upcoming and past events
                                    </div>
                                </div>

                                <a href="{{ route('event.create') }}" class="lms-btn">
                                    + Add Event
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Topic</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($event as $e)

                                            <tr>

                                                <!-- Event -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:10px;">

                                                        <img src="{{ asset('uploads/events/' . ($e->image ?? 'default.png')) }}"
                                                            style="width:42px; height:42px; border-radius:10px; object-fit:cover;"
                                                            alt="event">

                                                        <div>
                                                            <div style="font-weight:600;">
                                                                {{ $e->title }}
                                                            </div>
                                                            <div style="font-size:11px; color:#94a3b8;">
                                                                Event
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>

                                                <!-- Topic -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $e->topic }}
                                                    </div>
                                                </td>

                                                <!-- Location -->
                                                <td>
                                                    @if($e->location == 'online')
                                                        <span class="lms-badge lms-badge-success">Online</span>
                                                    @else
                                                        <span class="lms-badge lms-badge-warning">
                                                            {{ ucfirst($e->location) }}
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Date -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ \Carbon\Carbon::parse($e->date)->format('j F Y') }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        {{ \Carbon\Carbon::parse($e->date)->format('l') }}
                                                    </div>
                                                </td>

                                                <!-- Action -->
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('event.edit', $e->id) }}"
                                                        class="lms-btn">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{ $e->id }}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{ $e->id }}"
                                                        action="{{ route('event.destroy', $e->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="5" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Events Found
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