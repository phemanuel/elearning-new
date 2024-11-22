@extends('backend.layouts.app')
@section('title', 'Course Fees')

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
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Student Name')}}</th>
                                                <th>{{__('Course')}}</th>
                                                @if(auth()->user()->role_id == 1)
                                                <th>{{__('Instructor')}}</th>
                                                @endif
                                                <th>{{__('Amount')}}</th>
                                                <th>{{__('Payout')}}</th>
                                                <th>{{__('Payment Date')}}</th>
                                                <!-- <th>{{__('Action')}}</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                        @foreach($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <!-- Check if student exists before displaying the name -->
                                            <td>{{ $payment->student ? $payment->student->name_en : 'N/A' }}</td>
                                            <td>{{ $payment->course->title_en }}</td>
                                            @if(auth()->user()->role_id == 1)
                                            <td>{{ $payment->course->instructor->name_en ?? 'N/A' }}</td>
                                            @endif
                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('jS F, Y') }}</td>
                                        </tr>
                                        @endforeach
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