@extends('backend.layouts.app')
@section('title', 'Add Subscription')

@push('styles')
<!-- Pick date -->
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.date.css')}}">
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
                    <h4>Add Subscription Plan</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('subscription.index')}}">Subscription Plan</a></li>
                    <li class="breadcrumb-item active"><a href="#">Add Subscription Plan</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Subscription Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('subscriptionPlan.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Name</label>
                                        <input type="text" class="form-control" name="subscriptionName"
                                            value="{{old('subscriptionName')}}">
                                    </div>
                                    @if($errors->has('subscriptionName'))
                                    <span class="text-danger"> {{ $errors->first('subscriptionName') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">No of Course Upload</label>
                                        <select name="courseUpload" id="" class="form-control">
                                        <option value="">Select No of Course Upload</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}" {{ old('courseUpload') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                        </select>
                                        
                                    </div>
                                    @if($errors->has('courseUpload'))
                                    <span class="text-danger"> {{ $errors->first('courseUpload') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">No of Student Upload</label>
                                        <select name="studentUpload" id="" class="form-control">
                                            <option value="">Select No of Student Upload</option>
                                            @for ($i = 10; $i <= 500; $i += 10) <!-- Starting from 10 and incrementing by 10 -->
                                                <option value="{{ $i }}" {{ old('studentUpload') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>                                        
                                    </div>
                                    @if($errors->has('studentUpload'))
                                    <span class="text-danger"> {{ $errors->first('studentUpload') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Allocated Space</label>
                                        <select name="allocatedSpace" id="" class="form-control">
                                            <option value="">Select Allocated Space</option>
                                            @for ($i = 1; $i <= 50; $i++) <!-- Starting from 10 and incrementing by 10 -->
                                                <option value="{{ $i }}" {{ old('allocatedSpace') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>                                        
                                    </div>
                                    @if($errors->has('allocatedSpace'))
                                    <span class="text-danger"> {{ $errors->first('allocatedSpace') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Amount per Month</label>
                                        <input type="number" class="form-control" name="amount"
                                            value="{{old('amount')}}">
                                    </div>
                                    @if($errors->has('amount'))
                                    <span class="text-danger"> {{ $errors->first('amount') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" @if(old('status')==1) selected @endif>Active
                                            </option>
                                            <option value="0" @if(old('status')==0) selected @endif>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-label">Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="" name="image">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
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
<!--**********************************
            Content body end
        ***********************************-->

@endsection

@push('scripts')
<!-- pickdate -->
<script src="{{asset('vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.date.js')}}"></script>

<!-- Pickdate -->
<script src="{{asset('js/plugins-init/pickadate-init.js')}}"></script>
@endpush