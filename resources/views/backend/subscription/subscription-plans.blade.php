@extends('backend.layouts.app')
@section('title', 'Subscription') 

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
                <div class="welcome-text">                  
                    
            </div>
        </div>       
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Subscriptions</a></li>
                </ol>
            </div>
        </div>
        <div class="row">            
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title"><strong>Subscription Plan</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="widget-todo dz-scroll" style="height: 370px;" id="DZ_W_Notifications">                            
                            <!-- Image representing the plan -->
                            <div class="text-center mb-4">
                                <img src="{{asset('images/basic.png')}}" alt="Starter Plan" class="img-fluid" style="max-height: 150px; width: auto;">
                            </div>

                            <!-- Plan details -->
                            <div class="plan-details text-center">
                                <!-- Features -->
                                <ul class="list-group text-left mt-3">
                                    <li class="list-group-item"><i class="la la-upload mr-2"></i> 2 Courses Upload</li>
                                    <li class="list-group-item"><i class="la la-user mr-2"></i> 100 Students On-board </li>
                                    <li class="list-group-item"><i class="la la-hdd mr-2"></i> 2 GB storage for materials</li>
                                    <!-- <li class="list-group-item"><i class="la la-chart-bar mr-2"></i> Basic analytics</li> -->
                                    <li class="list-group-item"><i class="la la-envelope mr-2"></i> Email support</li>                                    
                                </ul>

                                <!-- Pricing -->
                                
                                <!-- Upgrade Button -->
                                <div class="mt-3">
                                    <a href="#" class="btn btn-success btn-lg text-white">
                                        <i class="la la-arrow-up mr-2"></i> Buy Now
                                    </a>
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