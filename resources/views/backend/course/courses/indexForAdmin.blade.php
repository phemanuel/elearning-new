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
                    <li class="breadcrumb-item active"><a href="#">All Course</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Course List </h4>
                                <!-- <a href="{{route('enrollment.create')}}" class="btn btn-primary">+ Add new course</a> -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Course Name')}}</th>
                                                <th>{{__('Instructor')}}</th>
                                                <th>{{__('Category')}}</th>
                                                <th>{{__('Price')}}</th>
                                                <th>{{__('Link')}}</th>
                                                <th>{{__('Project')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($course as $d)
                                            <tr>
                                                <td><img class="img fluid" width="100" src="{{asset('uploads/courses/'.$d->image)}}" alt="">
                                            </td>
                                                <td><strong>{{$d->title_en}}</strong></td>
                                                <td><strong>{{$d->instructor?->name_en}}</strong></td>
                                                <td><strong>{{$d->courseCategory?->category_name}}</strong>
                                                </td>
                                                <td><strong>{{$d->price?'=N='.$d->price:'Free'}}</strong></td>
                                                <td><div class="d-flex align-items-center bg-light rounded p-3 gap-3" style="overflow: hidden; white-space: nowrap;">
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
</div>               </td>
<td>
@if($d->project == 1)
 <i class="fa fa-check-circle text-success fs-5"></i> 
@else
  <i class="fa fa-times-circle text-danger fs-5"></i>
@endif
</td>
                                                <td>
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
                                                </td>
                                                <td>
                                                    <a href="{{route('course.edit', encryptor('encrypt',$d->id))}}"
                                                        class="btn btn-sm btn-primary" title="Edit"><i
                                                            class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        title="Delete" onclick="$('#form{{$d->id}}').submit()"><i
                                                            class="la la-trash-o"></i></a>
                                                    <form id="form{{$d->id}}"
                                                        action="{{route('course.destroy', encryptor('encrypt',$d->id))}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan="6" class="text-center">No Enrollment Found</th>
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