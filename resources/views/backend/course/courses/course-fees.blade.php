@extends('backend.layouts.app')
@section('title', 'Course Material List')

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
                    <h4>Payments </h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Payment</a>
                    <li class="breadcrumb-item active"><a href="">Course Fees</a>
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
                                <h4 class="card-title">All Course Payment List </h4>                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if(auth()->user()->role_id == 1)
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Student Name')}}</th>
                                                <th>{{__('Course')}}</th>
                                                <th>{{__('Amount')}}</th>
                                                <th>{{__('Payout')}}</th>
                                                <th>{{__('Payment Date')}}</th>
                                                <!-- <th>{{__('Action')}}</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <tr>
                                                <td>1</td>
                                                <td>Maxwell Akinyooye</td>
                                                <td>Freelance Bootcamp</td>  
                                                <td>{{number_format(27600,2)}}</td>
                                                <td>{{number_format(25600,2)}}</td>
                                                <td>20th November, 2024</td>
                                        </tbody>
                                    </table>
                                    @else
                                    <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Student Name')}}</th>
                                                <th>{{__('Course')}}</th>
                                                <th>{{__('Amount')}}</th>
                                                <th>{{__('Payout')}}</th>
                                                <th>{{__('Payment Date')}}</th>
                                                <!-- <th>{{__('Action')}}</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <tr>
                                                <td>1</td>
                                                <td>Maxwell Akinyooye</td>
                                                <td>Freelance Bootcamp</td>  
                                                <td>{{number_format(27600,2)}}</td>
                                                <td>{{number_format(25600,2)}}</td>
                                                <td>20th November, 2024</td>
                                        </tbody>
                                    </table>
                                    @endif
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