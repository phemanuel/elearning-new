@extends('backend.layouts.app')
@section('title', 'Subscription')

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
                    <h4>Add Subscription</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('subscription.index')}}">Subscriptions</a></li>
                    <li class="breadcrumb-item active"><a href="#">Add Subscription</a></li>
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
                                <h4 class="card-title">All Instructors</h4>                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form action="{{ route('subscription.store') }}" method="POST">
                                    @csrf
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{ __('#') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Designation') }}</th>
                                                <th>{{ __('Current Plan') }}</th>
                                                <th>{{ __('Subscription Plan') }}</th>
                                                <th>{{ __('Subscription Plan (Duration)') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($instructor as $key => $d)
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle" width="35" height="35" src="{{ asset('uploads/users/' . $d->image) }}" alt="">
                                                </td>
                                                <td><strong>{{ $d->name_en }}</strong></td>
                                                <td>{{ $d->designation }}</td>
                                                <td>
                                                    @if($d->subscriptionPlan)
                                                        {{ $d->subscriptionPlan->name }}
                                                    @else
                                                        No Plan
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- If the instructor already has a plan, disable the dropdown -->
                                                    <select name="subscriptionPlan[{{ $d->id }}]" class="form-control" >
                                                        @foreach($subscriptionPlan as $s)
                                                            <option value="{{ $s->id }}" {{ old("subscriptionPlan[{$d->id}]") == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                                        @endforeach
                                                        <option value="4">Unlimited</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <!-- Subscription Duration -->
                                                    <input type="number" name="subscriptionDuration[{{ $d->id }}]" class="form-control" value="1" min="1" max="12">
                                                </td>
                                                <td>
                                                    <!-- Action Button: Subscribe or Upgrade -->
                                                    @if($d->subscriptionPlan)
                                                        <!-- Upgrade Button -->
                                                        <button type="submit" name="instructor_id" value="{{ $d->id }}" class="btn btn-sm btn-warning text-white">
                                                            <i class="la la-arrow-up"></i>&nbsp;Upgrade
                                                        </button>
                                                    @else
                                                        <!-- Subscribe Button -->
                                                        <button type="submit" name="instructor_id" value="{{ $d->id }}" class="btn btn-sm btn-primary text-white">
                                                            <i class="la la-check-circle"></i>&nbsp;Subscribe
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan="7" class="text-center">No instructors found</th>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </form>
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