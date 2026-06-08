@extends('backend.layouts.app')
@section('title', 'Course Material List')

@push('styles')
<!-- Datatable -->
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">

<style>
    .modal-body {
        max-height: 70vh; /* Set a max height for the modal body */
        overflow-y: auto; /* Enable vertical scrolling if content exceeds max height */
    }
</style>
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Course Material - {{$lesson->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('course.index')}}">My Courses</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('lesson.show', encryptor('encrypt',$lesson->segments_id))}}">Course-Segment Lessons</a></li>
                    <li class="breadcrumb-item active"><a href="">All Course Material</a>
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
                            <div class="lms-card-header d-flex justify-content-between align-items-center">

                                <div>
                                    <div class="lms-card-title">Course Materials</div>
                                    <div class="text-muted" style="font-size:12px;">
                                        Manage videos, text content and quizzes for lessons
                                    </div>
                                </div>

                                <a href="{{ route('material.createNew', encryptor('encrypt', $material->first()?->lesson?->id)) }}"
                                class="lms-btn">
                                    + Add Material
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table id="example3" class="lms-table">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Lesson</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Preview</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($material as $key => $m)

                                            <tr>

                                                <!-- Index -->
                                                <td>
                                                    <span class="text-muted">
                                                        {{ $key + 1 }}
                                                    </span>
                                                </td>

                                                <!-- Lesson -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $m->lesson?->title ?? 'N/A' }}
                                                    </div>
                                                </td>

                                                <!-- Title -->
                                                <td>
                                                    {{ $m->title }}
                                                </td>

                                                <!-- Type -->
                                                <td>
                                                    @if($m->type == 'video')
                                                        <span class="lms-badge lms-badge-success">Video</span>
                                                    @elseif($m->type == 'text')
                                                        <span class="lms-badge lms-badge-info">Text</span>
                                                    @else
                                                        <span class="lms-badge lms-badge-warning">Quiz</span>
                                                    @endif
                                                </td>

                                                <!-- Preview -->
                                                <td>
                                                    <a href="javascript:void(0);"
                                                    class="lms-btn view-material"
                                                    style="padding:6px 10px; font-size:12px;"
                                                    data-id="{{ $m->id }}"
                                                    data-title="{{ $m->title }}"
                                                    data-type="{{ $m->type }}"
                                                    data-content="{{ $m->content_data }}"
                                                    data-video="{{ asset('uploads/courses/contents/' . $m->content) }}">
                                                        👁 View
                                                    </a>
                                                </td>

                                                <!-- Actions -->
                                                <td class="text-end">

                                                    <div style="display:flex; gap:8px; justify-content:flex-end;">

                                                        <a href="{{ route('material.edit', encryptor('encrypt',$m->id)) }}"
                                                        class="lms-btn"
                                                        style="padding:6px 10px; font-size:12px;">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{$m->id}}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{$m->id}}"
                                                        action="{{ route('material.destroy', encryptor('encrypt',$m->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Course Materials Found
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

<!-- Material View Modal -->
<div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="materialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="materialModalLabel">Material Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body" id="material-content">
        <!-- Dynamic content loads here -->
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.view-material').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const title = this.getAttribute('data-title');
            const type = this.getAttribute('data-type');
            const textContent = this.getAttribute('data-content');
            const videoSource = this.getAttribute('data-video');

            let modalContent = '';

            if (type === 'text') {
                modalContent = `
                    <h5>${title}</h5>
                    <div class="border p-3" style="min-height: 200px;">
                        ${textContent}
                    </div>`;
            } else if (type === 'video') {
                modalContent = `
                    <h5>${title}</h5>
                    <video controls class="w-100 mt-2" style="max-height: 500px;">
                        <source src="${videoSource}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>`;
            }

            document.getElementById('material-content').innerHTML = modalContent;
            new bootstrap.Modal(document.getElementById('materialModal')).show();
        });
    });
});
</script>


@endpush