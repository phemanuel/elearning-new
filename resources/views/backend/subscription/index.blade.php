@extends('backend.layouts.app')
@section('title', 'Subscription List')

@push('styles')
<!-- Datatable -->
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Subscription Plan</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Subscription Plan</a></li>
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
                                <h4 class="card-title">All Subscription Plans </h4>
                                <a href="{{route('subscriptionPlan.create')}}" class="btn btn-primary">+ Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 900px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Subscription Name')}}</th>
                                                <th>{{__('Course Upload')}}</th>
                                                <th>{{__('Student Upload')}}</th>
                                                <th>{{__('Allocated Space')}}</th>
                                                <th>{{__('Certificate Status')}}</th>
                                                <th>{{__('Transaction Fee')}}</th>
                                                <th>{{__('Extra Days')}}</th>
                                                <th>{{__('Manual Enrollment')}}</th>
                                                <th>{{__('Amount/Month')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($subscriptionPlan as $key => $d)
                                            <tr>
                                                <td><strong>{{$key + 1}}</strong></td>
                                                <td><strong>{{$d->name}}</strong></td> 
                                                <td><strong>{{ $d->course_upload >= 50 ? 'Unlimited' : $d->course_upload }}</strong></td>
                                                <td><strong>{{ $d->student_upload >= 2000 ? 'Unlimited' : $d->student_upload }}</strong></td>
                                                <td><strong>{{ $d->allocated_space >= 50 ? 'Unlimited' : $d->allocated_space . 'Gb' }}</strong></td>
                                                <td>
                                                    @if($d->certificate == 1)
                                                        <span class="badge badge-rounded badge-success text-white">Yes</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-warning text-white">No</span>
                                                    @endif
                                                </td>
                                                <td><strong>{{$d->transaction_fee}}%</strong></td>
                                                <td><strong>{{ $d->extra_day >= 20 ? '-' : $d->extra_day }}</strong></td>
                                                <td>
                                                    @if($d->enrollment == 1)
                                                        <span class="badge badge-rounded badge-success text-white">Yes</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-warning text-white">No</span>
                                                    @endif
                                                </td>
                                                <td><strong>{{ $d->amount >= 50000 ? '-' : '₦' . number_format($d->amount,2) }}</strong></td>
                                                <td>
                                                    <a href="{{route('subscriptionPlan.edit', encryptor('encrypt', $d->id))}}"
                                                        class="btn btn-sm btn-primary" title="Edit"><i
                                                            class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        title="Delete" onclick="$('#form{{$d->id}}').submit()"><i
                                                            class="la la-trash-o"></i></a>
                                                    <form id="form{{$d->id}}"
                                                        action="{{route('subscriptionPlan.destroy', $d->id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan="7" class="text-center">No subscription plan Found</th>
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
<!--**********************************
    Content body end
***********************************-->

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
@endpush