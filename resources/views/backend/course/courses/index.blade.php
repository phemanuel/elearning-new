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
                    <h4>Course List</h4>                 
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">All Course</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">  
                     <div class="card-header">
                        @if(auth()->user()->role_id != 1)
                        <a class="btn text-white" style="background-color: #006400;"> <!-- Deep Green -->
                            <i class="material-icons">golf_course</i> <strong>Total Course Allocated: {{$noOfCourses}}</strong>
                        </a>
                        @endif
                    </div>                   
                    <div class="card-header">
                        @if(auth()->user()->role_id != 1)
                        <a class="btn text-white" style="background-color: #5C4033;"> <!-- Deep Brown -->
                            <i class="material-icons">upload</i> <strong>Course Upload: {{$noOfCoursesInstructor}}</strong>
                        </a>
                        @endif
                    </div>                     
                    <div class="card-header">
                        @if(auth()->user()->role_id != 1)
                        <a class="btn text-white" style="background-color: #FF8C00;"> <!-- Deep Orange -->
                            <i class="material-icons">assignment</i> <!-- Icon in White -->
                            <strong>Total Course Left: {{$noOfCourses - $noOfCoursesInstructor}}</strong>
                        </a>
                        @endif
                    </div>
                    <div class="card-header">
                        @if(auth()->user()->role_id != 1)
                        <a href="{{route('course.create')}}" class="btn btn-primary"><strong>+ Add new course</strong> <i class="baseline-golf_course"></i></a>
                        @else
                        @endif
                    </div>             
                    
                    <div class="col-lg-12 mt-2">
                        <div class="row">
                            @forelse ($course as $d)
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
                                                href="{{route('course.edit', encryptor('encrypt',$d->id))}}">Edit Course</a>
                                                @if(auth()->user()->role_id != 1)
                                                <a class="dropdown-item" 
                                                href="{{ $d->segment_count > 0 ? route('segment.show', encryptor('encrypt', $d->id)) : route('segment.createNew', ['id' => encryptor('encrypt', $d->id)]) }}">
                                                {{ $d->segment_count > 0 ? 'View Segment' : 'Create Segment' }}
                                            </a>
                                            @else
                                            @endif
                                                    
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        onclick="$('#form{{$d->id}}').submit()">Delete</a>
                                                    <form id="form{{$d->id}}"
                                                        action="{{route('course.destroy', encryptor('encrypt',$d->id))}}"
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
                                                <img src="{{asset('uploads/courses/'.$d->image)}}" class="w-100"
                                                    height="200" alt="">
                                            </div>
                                            <h3 class="mt-4 mb-1">{{$d->title_en}}</h3>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span>Difficulty</span>
                                                    <strong>{{ $d->difficulty == 'beginner' ? __('Beginner') :
                                                        ($d->difficulty == 'intermediate' ? __('Intermediate') :
                                                        __('Advanced')) }}</strong>
                                                </li>
                                                <!-- <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Instructor :</span>
                                                    <strong>{{$d->instructor?->name_en}}</strong>
                                                </li> -->
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Category :</span>
                                                    <strong>{{$d->courseCategory?->category_name}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Price :</span>
                                                    <strong>{{ $d->price && $d->price > 0 ? $d->currency_type . number_format($d->price, 2) : 'Free' }}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">No of Segments Uploaded :</span>
                                                    <strong>{{$d->segment_count}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                                    <span class="mb-0">Project:</span>
                                                    @if($d->project == 1)
                                                        <i class="fa fa-check-circle text-success fs-5"></i> 
                                                    @else
                                                        <i class="fa fa-times-circle text-danger fs-5"></i>
                                                    @endif
                                                </li>
                                                @if($d->date_enabled == 1)
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Start Date :</span>                                                    
                                                    <strong>{{ \Carbon\Carbon::parse($d->start_from)->format('F j, Y') }}</strong>
                                                    
                                                </li>
                                                @else
                                                @endif
                                                @if(!empty($d->course_url))
                                                <li class="list-group-item px-0 d-flex justify-content-between">                                                   
                                                <div class="d-flex align-items-center bg-light rounded p-3 gap-3" style="overflow: hidden; white-space: nowrap;">
    <i class="fa fa-link text-primary fs-5"></i> 
    
    <div class="text-truncate flex-grow-1" style="max-width: 70%;">
        <a href="https://kingsdigihub.org/courses/{{ $d->course_url }}" 
           target="_blank" 
           class="text-decoration-none text-dark fw-bold"
           title="https://kingsdigihub.org/courses/{{ $d->course_url }}">
           https://kingsdigihub.org/courses/{{ $d->course_url }}
        </a>
    </div>

    <button class="btn btn-sm btn-outline-primary copy-btn px-3" 
            data-url="https://kingsdigihub.org/courses/{{ $d->course_url }}">
        <i class="fa fa-copy"></i> Copy
    </button>
</div>               
</li>
@else  @endif
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
                                            @if(auth()->user()->role_id != 1)
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4" 
                                                href="{{ $d->segment_count > 0 ? route('segment.show', encryptor('encrypt', $d->id)) : route('segment.createNew', ['id' => encryptor('encrypt', $d->id)]) }}">
                                                {{ $d->segment_count > 0 ? 'View Segment' : 'Create Segment' }}
                                            </a>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <p class="mt-3 px-4">Course has not been uploaded.</p>
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
<script>
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            navigator.clipboard.writeText(url).then(() => {
                this.innerHTML = '<i class="fa fa-check text-success"></i> Copied!';
                setTimeout(() => {
                    this.innerHTML = '<i class="fa fa-copy"></i> Copy';
                }, 2000);
            });
        });
    });
</script>
@endpush