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
                    <h4>Course Lesson List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('lesson.index')}}">Course Lessons</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('lesson.index')}}">All Course Lesson</a>
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

                        <!-- Page Header -->
                        <div class="lms-page-header mb-4">
                            <div>
                                <h3 class="mb-1">All Course Lessons</h3>
                                <p class="text-muted mb-0">
                                    Manage and organize lessons for your courses
                                </p>
                            </div>

                            <a href="{{ route('lesson.create') }}" class="lms-btn">
                                + Add Lesson
                            </a>
                        </div>

                        <!-- Table Card -->
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
                                            <th>Course</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($lesson as $l)
                                            <tr>
                                                <td>{{ $l->id }}</td>

                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $l->title }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="text-muted">
                                                        {{ $l->course?->title_en ?? 'N/A' }}
                                                    </span>
                                                </td>

                                                <td class="text-end">

                                                    <div style="display:flex; gap:8px; justify-content:flex-end;">

                                                        <a href="{{ route('lesson.edit', encryptor('encrypt',$l->id)) }}"
                                                        class="lms-btn"
                                                        style="padding:6px 10px; font-size:12px;">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{$l->id}}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{$l->id}}"
                                                        action="{{ route('lesson.destroy', encryptor('encrypt',$l->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Course Lessons Found
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