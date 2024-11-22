@extends('backend.layouts.app')
@section('title', 'Subscribe')

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
                    <h4>Subscribe : {{$currentPlan->subscriptionPlan->name}} <i class="la la-arrow-right mx-2"></i> {{$subscriptionPlans->name}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('subscription.view')}}">Subscription</a></li>
                    <li class="breadcrumb-item active"><a href="#">Subscribe</a>
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
                        <form action="{{route('subscribe.store', encryptor('encrypt', $subscriptionPlans->id))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Name</label>
                                        <select name="subscriptionId" id="subscriptionId" class="form-control">                                            
                                                <option value="{{$subscriptionPlans->id}}">{{$subscriptionPlans->name}}</option>  
                                        </select>                                        
                                    </div>
                                    @if($errors->has('subscriptionId'))
                                    <span class="text-danger"> {{$errors->first('subscriptionId')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">No of Courses to Upload</label>
                                        <p>{{$subscriptionPlans->course_upload}}</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">No of Students to Upload</label>
                                        <p>{{$subscriptionPlans->student_upload}}</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Allocated Space for Materials</label>
                                        <p>{{$subscriptionPlans->allocated_space}}Gb</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Amount per Month/Year</label>
                                        <p>{{ number_format($subscriptionPlans->amount, 0) }}/month 
                                        or {{ number_format($subscriptionPlans->amount * 12 * 0.9, 0) }}/year</p>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">No of Months</label>
                                        <select name="noOfMonth" id="noOfMonth" class="form-control">
                                        <option value="">Select No of Months</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('noOfMonth') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                        </select>
                                    </div> 
                                    @if($errors->has('noOfMonth'))
                                    <span class="text-danger"> {{$errors->first('noOfMonth')}}</span>
                                    @endif                                   
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">                                    
                                    <button type="submit" class="btn btn-primary">Subscribe</button>
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