@extends('backend.layouts.app')
@section('title', 'Add Course Lesson')

@push('styles')
<!-- Pick date -->
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.date.css')}}">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Segment Lesson for  - {{$segment->title_en}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('course.index')}}">My Courses</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('segment.show', encryptor('encrypt', $segment->course_id))}}">Segments</a></li>
                    <li class="breadcrumb-item active"><a href="#">Segment Lessons</a></li>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('lesson.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Segment</label>
                                        <select class="form-control" name="segmentId">
                                            <option value="{{ $segment->id }}" {{ old('segmentId') == $segment->id ? 'selected' : '' }}>
                                                {{ $segment->title_en }}
                                            </option>
                                        </select>

                                    </div>
                                    @if($errors->has('courseId'))
                                    <span class="text-danger"> {{ $errors->first('courseId') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Lesson Title</label>
                                        <input type="text" class="form-control" name="lessonTitle"
                                            value="{{old('lessonTitle')}}">
                                    </div>
                                    @if($errors->has('lessonTitle'))
                                    <span class="text-danger"> {{ $errors->first('lessonTitle') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Serial No</label>
                                        <input type="number" class="form-control" name="serialNo"
                                            value="{{old('serialNo')}}">
                                    </div>
                                    @if($errors->has('serialNo'))
                                    <span class="text-danger"> {{ $errors->first('serialNo') }}</span>
                                    @endif
                                </div>                                
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Lesson Description</label>
                                        <textarea class="form-control" name="lessonDescription"
                                            value="{{old('lessonDescription')}}"></textarea>
                                    </div>
                                    @if($errors->has('lessonDescription'))
                                    <span class="text-danger"> {{ $errors->first('lessonDescription') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Lesson Notes</label>
                                        <textarea class="form-control" name="lessonNotes"
                                            value="{{old('lessonNotes')}}"></textarea>
                                    </div>
                                    @if($errors->has('lessonNotes'))
                                    <span class="text-danger"> {{ $errors->first('lessonNotes') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" name="courseId" value="{{$segment->course_id}}">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<!-- pickdate -->
<script src="{{asset('vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.date.js')}}"></script>

<!-- Pickdate -->
<script src="{{asset('js/plugins-init/pickadate-init.js')}}"></script>
@endpush