@extends('backend.layouts.app')
@section('title', 'Course List')

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
                    <h4>Segment List - {{$course->title_en}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('course.index')}}">My Courses</a></li>
                    <li class="breadcrumb-item active"><a href="">All Segments</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">
                
                    <div class="card-header">
                        <a href="{{route('segment.createNew', encryptor('encrypt', $courseId ))}}" class="btn btn-primary">+ Add new segment <i class="baseline-golf_course"></i></a>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                        @forelse ($segment as $d)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="card card-profile">
                                    <div class="card-header justify-content-end pb-0">
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                <span class="dropdown-dots fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border py-0">
                                                <div class="py-2">
                                                <a class="dropdown-item" 
                                                href="{{ $d->lesson_count > 0 ? route('lesson.show', encryptor('encrypt', $d->id)) : route('lesson.create', ['segment_id' => encryptor('encrypt', $d->id)]) }}">
                                                {{ $d->lesson_count > 0 ? 'View Segment Lessons' : 'Create Segment Lessons' }}
                                            </a>
                                                    <a class="dropdown-item"
                                                        href="{{route('segment.edit', encryptor('encrypt',$d->id))}}">Edit</a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        onclick="$('#form{{$d->id}}').submit()">Delete</a>
                                                    <form id="form{{$d->id}}"
                                                        action="{{route('segment.destroy', encryptor('encrypt',$d->id))}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <div class="">
                                                <img src="{{ asset('public/uploads/courses/' . ($d->image && file_exists(public_path('uploads/courses/' . $d->image)) ? $d->image : 'course_blank.jpg')) }}"
     class="w-100"
                                                    height="200" alt="Course Image">
                                               
                                            </div>
                                            <h3 class="mt-4 mb-1">{{$d->title_en}}</h3>
                                            <ul class="list-group mb-3 list-group-flush">
                                                
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Instructor :</span>
                                                    <strong>{{$d->instructor?->name_en}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Category :</span>
                                                    <strong>{{$d->courseCategory?->category_name}}</strong>
                                                </li>                                                
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">No of Lessons Uploaded :</span>
                                                    <strong>{{$d->lesson_count}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Segment No :</span>
                                                    <strong>{{$d->segment_no}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Quiz:</span>
                                                    @if($d->quiz == 1)
                                                        <i class="fa fa-check-circle text-success fs-5"></i> 
                                                    @else
                                                        <i class="fa fa-times-circle text-danger fs-5"></i>
                                                    @endif
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Status :</span>
                                                    <span class="badge 
                                                    @if($d->status == 0) badge-warning 
                                                    @elseif($d->status == 1) badge-danger 
                                                    @elseif($d->status == 2) badge-success 
                                                    @endif">
                                                        @if($d->status == 0) {{__('Pending')}}
                                                        @elseif($d->status == 1) {{__('Inactive')}}
                                                        @elseif($d->status == 2) {{__('Active')}}
                                                        @endif
                                                    </span>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4" 
                                                href="{{ $d->lesson_count > 0 ? route('lesson.show', encryptor('encrypt', $d->id)) : route('lesson.create', ['segment_id' => encryptor('encrypt', $d->id)]) }}">
                                                {{ $d->lesson_count > 0 ? 'View Segment Lessons' : 'Create Segment Lessons' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <p class="mt-3 px-4">Segment has not been uploaded.</p>
                                        </div>
                                    </div>
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

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

@endpush