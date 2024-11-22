@extends('backend.layouts.app')
@section('title', 'Subscription Plans') 

@push('styles')
<link rel="stylesheet" href="{{asset('vendor/jqvmap/css/jqvmap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/chartist/css/chartist.min.css')}}">
<link rel="stylesheet" href="{{asset('css/skin-2.css')}}">
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<div class="content-body">
<div class="row page-titles mx-0">           
    <!-- row -->
    <div class="container-fluid">
        
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                
        </div>        
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Subscription Plan</a></li>
                </ol>
            </div>
        </div>
        <div class="row"> 
            @foreach($subscriptionPlans as $d)
            <!-- start -->
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="widget-todo dz-scroll" style="height: 370px;" id="DZ_W_Notifications">
                            
                            <!-- Image representing the plan -->
                            <div class="text-center mb-4">
                                <img src="{{asset('uploads/subscriptions/' . $d->image)}}" alt="Starter Plan" class="img-fluid" style="max-height: 150px; width: auto;">
                            </div>

                            <!-- Plan details -->
                            <div class="plan-details text-center">
                                <!-- Features -->
                                <ul class="list-group text-left mt-3">
                                    <li class="list-group-item"><i class="la la-upload mr-2"></i> {{$d->course_upload}} Courses Upload</li>
                                    <li class="list-group-item"><i class="la la-user mr-2"></i> {{$d->student_upload}} Students On-board </li>
                                    <li class="list-group-item"><i class="la la-hdd mr-2"></i> {{$d->allocated_space}} GB storage for materials</li>
                                    <!-- <li class="list-group-item"><i class="la la-chart-bar mr-2"></i> Basic analytics</li> -->
                                    <li class="list-group-item"><i class="la la-envelope mr-2"></i> Email support</li>                                    
                                </ul>      
                                <!-- Pricing -->
                                <div class="mt-3">
                                <h5 class="text-primary"><strong><img src="{{asset('images/naira_sign.png')}}" alt="">&nbsp;{{ number_format($d->amount, 0) }}/month 
                                    or {{ number_format($d->amount * 12 * 0.9, 0) }}/year</strong>                                    
                                </h5>                                  
                                </div>                          
                                <!-- Buy Button -->
                                 @if(empty($subscriptions))
                                <div class="mt-3">
                                    <a href="{{route('subscribe.view' , encryptor('encrypt' , $d->id))}}" class="btn btn-success btn-lg text-white">
                                        <i class="la la-shopping-cart"></i> Buy Now
                                    </a>
                                </div>
                                @else
                                <div class="mt-3">
                                    @if($d->id == $subscriptions->plan_id)                                    
                                        <img src="{{asset('images/check.jpg')}}" alt=""> 
                                    @elseif($d->id < $subscriptions->plan_id)                                    
                                        <img src="{{asset('images/uncheck.jpg')}}" alt="">                                   
                                    @else
                                    <a href="{{route('subscribe.view' , encryptor('encrypt' , $d->id))}}" class="btn btn-success btn-lg text-white">
                                        <i class="la la-shopping-cart"></i> Upgrade Now
                                    </a>
                                    @endif
                                </div>
                                @endif
                            </div>                            
                        </div>
                    </div>

                </div>
            </div>
            <!-- end -->
            @endforeach

            <!-- Unlimited Plan Start -->
            <!-- start -->
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="widget-todo dz-scroll" style="height: 370px;" id="DZ_W_Notifications">
                            
                            <!-- Image representing the plan -->
                            <div class="text-center mb-4">
                                <img src="{{asset('images/enterprise.png')}}" alt="Starter Plan" class="img-fluid" style="max-height: 150px; width: auto;">
                            </div>

                            <!-- Plan details -->
                            <div class="plan-details text-center">
                                <!-- Features -->
                                <ul class="list-group text-left mt-3">
                                    <li class="list-group-item"><i class="la la-upload mr-2"></i> Unlimited Courses Upload</li>
                                    <li class="list-group-item"><i class="la la-user mr-2"></i> Unlimited Students On-board </li>
                                    <li class="list-group-item"><i class="la la-hdd mr-2"></i> Unlimited GB storage for materials</li>
                                    <!-- <li class="list-group-item"><i class="la la-chart-bar mr-2"></i> Basic analytics</li> -->
                                    <li class="list-group-item"><i class="la la-envelope mr-2"></i> Email support</li>                                    
                                </ul>   
                                <!-- Pricing -->
                                <div class="mt-3">
                                <h5 class="text-primary"><strong>To upgrade to this plan, contact sales.</strong>                                    
                                </h5>                                  
                                </div>       
                                <!-- Upgrade Button -->
                                <div class="mt-3">
                                    <a href="#" class="btn btn-success btn-lg text-white">
                                        <i class="la la-shopping-cart"></i> Contact Sales
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    </div>

                </div>
            </div>
            <!-- end -->
            <!-- End -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Chart ChartJS plugin files -->
<script src="{{asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>

<!-- Chart piety plugin files -->
<script src="{{asset('vendor/peity/jquery.peity.min.js')}}"></script>

<!-- Chart sparkline plugin files -->
<script src="{{asset('vendor/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Demo scripts -->
<script src="{{asset('js/dashboard/dashboard-3.js')}}"></script>
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
@endpush