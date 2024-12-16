@extends('backend.layouts.app')
@section('title', 'Custom Plan Request')

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
                    <h4>Custom Plan Request</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Custom Plan Request</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <!-- <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid
                            View</a></li> -->
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Custom Plan Request </h4>
                                <!-- <a href="{{route('user.create')}}" class="btn btn-primary">+ Add new</a> -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <!-- <th>{{__('#')}}</th> -->
                                                <th>{{__('Name')}}</th>
                                                <th>{{__('Email')}}</th>
                                                <th>{{__('Courses')}}</th>
                                                <th>{{__('Student')}}</th>
                                                <th>{{__('Storage')}}</th>
                                                <th>{{__('Info')}}</th>
                                                <!-- <th>{{__('Status')}}</th>
                                                <th>{{__('Action')}}</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($customPlan as $d)
                                            <tr>                                               
                                                <td><strong>{{$d->name}}</strong></td>
                                                <td>{{$d->email}}</td>
                                                <td>{{$d->no_of_course}}</td>
                                                <td>{{$d->no_of_student}}</td>
                                                <td>{{$d->storage_space}}</td>
                                                <td>{{$d->additional_information}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan="7" class="text-center">No request Found</th>
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