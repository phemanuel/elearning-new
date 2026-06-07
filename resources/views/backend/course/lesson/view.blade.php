@extends('backend.layouts.app')
@section('title', 'Course Lesson List')

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
                    <h4>Segment Lesson List - {{$segment->title_en}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('course.index')}}">My Courses</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('segment.show', encryptor('encrypt', $segment->course_id))}}">Segments</a></li>
                    <li class="breadcrumb-item active"><a href="#">Segment Lessons</a></li>                    
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

                        <!-- Page Header -->
                        <div class="lms-card mb-4">

                            <div class="lms-card-header d-flex justify-content-between align-items-center">

                                <!-- Left Content -->
                                <div>
                                    <h3 class="mb-1">Segment Lessons</h3>
                                    <p class="text-muted mb-0">
                                        Manage lessons and attach learning materials
                                    </p>
                                </div>

                                <!-- Right Button -->
                                <div>
                                    <a href="{{ route('lesson.create', ['segment_id' => encryptor('encrypt', $segment->id)]) }}"
                                    class="lms-btn">
                                        + Add Lesson
                                    </a>
                                </div>

                            </div>

                        </div>

                        <!-- Card -->
                        <div class="lms-card">

                            <div class="lms-card-header">
                                <div class="lms-card-title">Lessons List</div>
                            </div>

                            <div class="lms-table-wrapper">

                                <table id="example3" class="lms-table">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Notes</th>
                                            <th>Materials</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($lesson as $l)

                                            <tr>

                                                <!-- Serial -->
                                                <td>
                                                    <span class="text-muted">
                                                        {{ $l->serial_no }}
                                                    </span>
                                                </td>

                                                <!-- Title -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $l->title }}
                                                    </div>
                                                </td>

                                                <!-- Notes -->
                                                <td>
                                                    <span class="text-muted">
                                                        {{ $l->notes ?? '—' }}
                                                    </span>
                                                </td>

                                                <!-- Materials -->
                                                <td>
                                                    <span class="lms-badge">
                                                        {{ $l->material_count }} files
                                                    </span>
                                                </td>

                                                <!-- Material Action -->
                                                <td>
                                                    <div style="display:flex; gap:8px; align-items:center;">

                                                        @if($l->material_count > 0)

                                                            <a href="{{ route('material.show', encryptor('encrypt', $l->id)) }}"
                                                            class="lms-btn"
                                                            style="padding:6px 10px; font-size:12px;">
                                                                View Materials
                                                            </a>

                                                        @else

                                                            <a href="{{ route('material.createNew', ['id' => encryptor('encrypt', $l->id)]) }}"
                                                            class="lms-btn-secondary"
                                                            style="padding:6px 10px; font-size:12px;">
                                                                + Add Materials
                                                            </a>

                                                        @endif

                                                        <!-- Actions -->
                                                        <a href="{{ route('lesson.edit', encryptor('encrypt', $l->id)) }}"
                                                        class="lms-btn"
                                                        style="padding:6px 10px; font-size:12px;">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{ $l->id }}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{ $l->id }}"
                                                        action="{{ route('lesson.destroy', encryptor('encrypt', $l->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="5" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Lessons Found for this Segment
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