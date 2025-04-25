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
                    <li class="breadcrumb-item active"><a href="{{route('lesson.show', encryptor('encrypt',$lesson->segments_id))}}">Course Lessons</a></li>
                    <li class="breadcrumb-item active"><a href="">All Course Material</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <!-- <li class="nav-item"><a href="javascript:void(0);" data-toggle="tab"
                            class="nav-link btn-primary">Grid
                            View</a></li> -->
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Course Materials List </h4>
                                <a href="{{ route('material.createNew', encryptor('encrypt', $material->first()?->lesson?->id)) }}" 
                                class="btn btn-primary">+ Add new material</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Lesson')}}</th>
                                                <th>{{__('Title')}}</th>
                                                <th>{{__('Material Type')}}</th>
                                                <th>{{__('Content')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($material as $key => $m)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$m->lesson?->title}}</td>  
                                                <td>{{$m->title}}</td>                                                
                                                <td>
                                                    {{ $m->type == 'video' ? __('Video') : ($m->type == 'text' ?
                                                    __('Text') : __('Quiz')) }}
                                                </td>  
                                                <td>
    <a href="javascript:void(0);"
       class="btn btn-sm btn-info text-white view-material"
       data-id="{{ $m->id }}"
       data-title="{{ $m->title }}"
       data-type="{{ $m->type }}"
       data-content="{{ $m->content_data }}"
       data-video="{{ asset('uploads/courses/contents/' . $m->content) }}">
        <i class="la la-eye"></i> View
    </a>
</td>
</td>
                                                <td>
                                                    <a href="{{route('material.edit', encryptor('encrypt',$m->id))}}"
                                                        class="btn btn-sm btn-primary" title="Edit"><i
                                                            class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        title="Delete" onclick="$('#form{{$m->id}}').submit()"><i
                                                            class="la la-trash-o"></i></a>
                                                    <form id="form{{$m->id}}"
                                                        action="{{route('material.destroy', encryptor('encrypt',$m->id))}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan="6" class="text-center">No Course Material Found</th>
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