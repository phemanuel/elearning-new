@extends('backend.layouts.app')
@section('title', 'Edit Subscription')

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
                    <h4>Edit Subscription Plan -  {{$data->name}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('subscriptionPlan.index')}}">Subscription Plan</a></li>
                    <li class="breadcrumb-item active"><a href="#">Edit Subscription Plan</a>
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
                        <form action="{{ route('subscriptionPlan.update', encryptor('encrypt', $data->id)) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Name</label>
                                        <input type="text" class="form-control" name="subscriptionName"
                                            value="{{old('subscriptionName', $data->name)}}">
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
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}" {{ old('courseUpload', $data->course_upload) == $i ? 'selected' : '' }}>
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
                                            @for ($i = 50; $i <= 2000; $i += 50) <!-- Starting from 10 and incrementing by 10 -->
                                                <option value="{{ $i }}" {{ old('studentUpload', $data->student_upload) == $i ? 'selected' : '' }}>
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
                                                <option value="{{ $i }}" {{ old('allocatedSpace', $data->allocated_space) == $i ? 'selected' : '' }}>
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
                                        <label class="form-label">Certificate</label>
                                        <select name="certificate" id="certificate" class="form-control">
                                        <option value="1" {{ $data->certificate == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $data->certificate == 0 ? 'selected' : '' }}>No</option>                                             
                                        </select>        
                                   
                                    </div>
                                    @if($errors->has('certificate'))
                                    <span class="text-danger"> {{ $errors->first('certificate') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Transaction Fee</label>
                                        <select name="transactionFee" id="transactionFee" class="form-control">                                            
                                            @for ($i = 0; $i <= 20; $i++) 
                                                <option value="{{ $i }}" {{ old('transactionFee', $data->transaction_fee) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>                                 
                                    </div>
                                    @if($errors->has('transactionFee'))
                                    <span class="text-danger"> {{ $errors->first('transactionFee') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Extra Days</label>
                                        <select name="extraDay" id="extraDay" class="form-control">                                            
                                            @for ($i = 0; $i <= 20; $i++) 
                                                <option value="{{ $i }}" {{ old('extraDay', $data->extra_day) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>                                 
                                    </div>
                                    @if($errors->has('extraDay'))
                                    <span class="text-danger"> {{ $errors->first('extraDay') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Manual Enrollment</label>
                                        <select name="enrollment" id="enrollment" class="form-control">
                                        <option value="1" {{ $data->certificate == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $data->certificate == 0 ? 'selected' : '' }}>No</option>                                             
                                        </select>        
                                   
                                    </div>
                                    @if($errors->has('enrollment'))
                                    <span class="text-danger"> {{ $errors->first('enrollment') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Amount per Month</label>
                                        <input type="number" class="form-control" name="amount"
                                            value="{{old('amount', $data->amount)}}">
                                    </div>
                                    @if($errors->has('amount'))
                                    <span class="text-danger"> {{ $errors->first('amount') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" @if(old('status', $data->status)==1) selected @endif>Active
                                            </option>
                                            <option value="0" @if(old('status' , $data->status)==0) selected @endif>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-label">Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="" name="category_image">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
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