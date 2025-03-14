@extends('backend.layouts.app')
@section('title', 'Category List')

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
                    <h4>Subscriptions</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Subscriptions</a></li>
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
                                <h4 class="card-title">All Subscriptions</h4>
                                <a href="{{route('subscription.create')}}" class="btn btn-primary">+ Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Instructor Name') }}</th>
                                        <th>{{ __('Subscription Name') }}</th>
                                        <th>{{ __('Amount/Month') }}</th>
                                        <th>{{ __('No of Months') }}</th>
                                        <th>{{ __('Total Amount') }}</th>
                                        <th>{{ __('Course Upload') }}</th>
                                        <th>{{ __('Student Upload') }}</th>
                                        <th>{{ __('Allocated Space') }}</th>
                                        <th>{{ __('Payment Date') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subscriptions as $key => $subscription)
                                    <tr>
                                        <td><strong>{{ $key + 1 }}</strong></td>
                                        <td><strong>{{ $subscription->instructor?->name_en ?? 'No Instructor' }}</strong></td>
                                        <td><strong>{{ $subscription->subscriptionPlan?->name ?? 'No Plan Assigned' }}</strong></td>
                                        <td><strong>₦{{ number_format($subscription->subscriptionPlan?->amount ?? 0, 2) }}</strong></td>
                                        <td><strong>{{ $subscription->no_of_months }}</strong></td>
                                        <td><strong>₦{{ $subscription->total_amount }}</strong></td>
                                        <td><strong>{{ $subscription->subscriptionPlan?->course_upload ?? 'N/A' }}</strong></td>
                                        <td><strong>{{ $subscription->subscriptionPlan?->student_upload ?? 'N/A' }}</strong></td>
                                        <td><strong>{{ $subscription->subscriptionPlan?->allocated_space ?? 'N/A' }}Gb</strong></td>
                                        <td><strong>{{ \Carbon\Carbon::parse($subscription->created_at)->format('F d, Y') }}</strong></td>
                                        <td>
                                                    <!-- <a href="{{route('subscription.edit', encryptor('encrypt', $subscription->id))}}"
                                                        class="btn btn-sm btn-primary" title="Edit"><i
                                                            class="la la-pencil"></i></a> -->
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        title="Delete" onclick="$('#form{{$subscription->id}}').submit()"><i
                                                            class="la la-trash-o"></i></a>
                                                    <form id="form{{$subscription->id}}"
                                                        action="{{route('subscription.destroy', $subscription->id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                        
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="7" class="text-center">No subscriptions found</th>
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