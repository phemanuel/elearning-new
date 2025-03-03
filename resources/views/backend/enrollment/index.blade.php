@extends('backend.layouts.app')
@section('title', 'Enrollment List')

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
                    <h4>Enrollments</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">All Enrollment</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">                            
                            <div class="card-header">
                                <h4 class="card-title">All Enrollments List</h4>

                                @if(auth()->user()->role_id != 1)
                                <a class="btn text-white" style="background-color: #006400;"> <!-- Deep Green -->
                                    <i class="material-icons">people</i> <!-- Icon for "students" -->
                                    <strong>Total Students to Enroll: {{$noOfStudent}}</strong>
                                </a>
                                @endif

                                @if(auth()->user()->role_id != 1)
                                <a class="btn text-white" style="background-color: #5C4033;"> <!-- Deep Brown -->
                                    <i class="material-icons">check_circle</i> <!-- Icon for "completed/enrolled" -->
                                    <strong>Students Enrolled: {{$noOfStudentEnrolled}}</strong>
                                </a>
                                @endif

                                @if(auth()->user()->role_id != 1)
                                <a class="btn text-white" style="background-color: #FF8C00;"> <!-- Deep Orange -->
                                    <i class="material-icons">book</i> <!-- Icon for "courses" -->
                                    <strong>Total Students Left: {{$noOfStudent - $noOfStudentEnrolled}}</strong>
                                </a>
                                @endif 
                                @if(auth()->user()->role_id != 1)
                                <a href="{{route('enrollment.create')}}" class="btn btn-primary">
                                    <strong>+ Enroll New Student</strong>
                                </a>
                                @endif 
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Student Name')}}</th>
                                                <th>{{__('Course Name')}}</th>
                                                <th>{{__('Segment')}}</th>
                                                <th>{{__('Completion Status')}}</th>
                                                <th>{{__('Amount')}}</th>
                                                <th>{{__('Enrollment Date')}}</th>
                                                <!-- <th>{{__('Action')}}</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($enrollment as $e)
                                            <tr>
                                                <td><img class="rounded-circle" width="35" height="35"
                                                        src="{{asset('uploads/students/'.$e->student?->image)}}"
                                                        alt="">
                                                </td>
                                                <td><strong>{{$e->student?->name_en}}</strong></td>
                                                <td><strong>{{$e->course?->title_en}}</strong></td>
                                                <td><strong>{{$e->segment}}</strong></td>
                                                <td>
                                                    @if($e->completed == 1)
                                                        <span class="badge badge-rounded badge-success text-white">Completed</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-warning text-white">Not Completed</span>
                                                    @endif
                                                </td>
                                                <td><strong>
        {{ $e->course?->price == null ? 'Free': $e->course?->currency_type . number_format($e->course?->price, 2) }}
    </strong></td>
                                                <td><strong>{{$e->enrollment_date}}</strong></td>
                                                <!-- <td>
                                                    <a href="{{route('enrollment.edit', encryptor('encrypt',$e->id))}}"
                                                        class="btn btn-sm btn-primary" title="Edit"><i
                                                            class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        title="Delete" onclick="$('#form{{$e->id}}').submit()"><i
                                                            class="la la-trash-o"></i></a>
                                                    <form id="form{{$e->id}}"
                                                        action="{{route('enrollment.destroy', encryptor('encrypt',$e->id))}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td> -->
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


@endpush