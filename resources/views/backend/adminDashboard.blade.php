@extends('backend.layouts.app')
@section('title', 'Admin Dashboard')

@push('styles')
<link rel="stylesheet" href="{{asset('vendor/jqvmap/css/jqvmap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/chartist/css/chartist.min.css')}}">
<link rel="stylesheet" href="{{asset('css/skin-2.css')}}">
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-primary overflow-hidden">
                    <div class="card-header">
                        <h3 class="card-title text-white">Total Students</h3>
                        <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{$student->count()}}</h5>
                    </div>
                    <div class="card-body text-center mt-3">
                        <div class="ico-sparkline">
                            <div id="sparkline12"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-success overflow-hidden">
                    <div class="card-header">
                        <h3 class="card-title text-white">Enrolled Students</h3>
                        <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{$allEnrollment->count()}}</h5>
                    </div>
                    <div class="card-body text-center mt-4 p-0">
                        <div class="ico-sparkline">
                            <div id="spark-bar-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-secondary overflow-hidden">
                    <div class="card-header pb-3">
                        <h3 class="card-title text-white">Total Course</h3>
                        <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $allCourse->count() }}</h5>
                    </div>
                    <div class="card-body p-0 mt-2">
                        <div class="px-4"><span class="bar1"
                                data-peity='{ "fill": ["rgb(0, 0, 128)", "rgb(7, 135, 234)"]}'>6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-danger overflow-hidden">
                    <div class="card-header pb-3">
                        <h3 class="card-title text-white">Fees Collection</h3>
                        <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i>{{ number_format($totalCourseFee, 2) }}</h5>
                    </div>
                    <div class="card-body p-0 mt-1">
                        <span class="peity-line-2" data-width="100%">7,6,8,7,3,8,3,3,6,5,9,2,8</span>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xl-6 col-xxl-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Income/Expense Report</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart_2"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Income/Expense Report</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="areaChart_1"></canvas>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-8 col-xxl-8 col-lg-8 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><strong>Enrolled Students</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-sm mb-0 table-striped">
                            <!-- <table class="table table-sm mb-0 table-striped"> -->
                            <thead>
                                <tr>
                                    <th class="px-5 py-3">#</th>
                                    <th class="px-5 py-3">Student Name</th>
                                    <th class="py-3">Course</th>
                                    <th class="py-3">Total Segments</th>
                                    <th class="py-3">Current Segment</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3">Date Of Enrollment</th>                                        
                                </tr>
                            </thead>
                            <tbody id="customers">
                                @foreach($allEnrollments as $enrollment)
                                <tr class="btn-reveal-trigger">
                                    <td class="p-3">
                                        <a href="javascript:void(0);">
                                            <div class="media d-flex align-items-center">
                                                <div class="avatar avatar-xl mr-2">
                                                    <img class="rounded-circle img-fluid" src="{{asset('uploads/students/' . $enrollment->student->image)}}" width="30" alt="">
                                                </div>                                               
                                            </div>
                                        </a>
                                    </td>
                                    <td class="py-2">{{ $enrollment->student->name_en }}</td>
                                    <td class="py-2">{{ $enrollment->course->title_en }}</td>
                                    <!-- Display Total Segments -->
                                    <td class="py-2">{{ $enrollment->course->segments_count ?? 0 }}</td>
                                    <!-- Display Current Segment -->
                                    <td class="py-2">{{ $enrollment->segment }}</td>
                                    <!-- Status Check -->
                                    <td>
                                        @if($enrollment->completed == 1)
                                            <span class="badge badge-rounded badge-success">Completed</span>
                                        @else
                                            <span class="badge badge-rounded badge-warning">Not Completed</span>
                                        @endif
                                    </td>
                                    <td class="py-2">{{ $enrollment->created_at->format('d/m/Y') }}</td>                                        
                                </tr>
                                @endforeach
                            </tbody>                       
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title"><strong>Subscription Plans</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="widget-todo dz-scroll" style="height: 370px;" id="DZ_W_Notifications">                        
                            <table class="table table-sm mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3">#</th>
                                    <th class="px-5 py-3">Instructor</th>
                                    <th class="py-3">Plan</th>
                                                                            
                                </tr>
                            </thead>
                            <tbody id="customers">
                                @foreach($instructorPlan as $key => $p)
                                <tr class="btn-reveal-trigger">                                    
                                    <td class="py-2">{{ $key + 1 }}</td>
                                    <td class="py-2">{{ $p->name_en }}</td>                                    
                                    <td class="py-2">{{ $p->currentPlan->name ?? 'No Plan' }}</td>                                       
                                </tr>
                                @endforeach
                            </tbody>                       
                            </table>   
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><strong>Courses</strong> </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example3" class="table table-sm mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3">#</th>
                                    <th class="px-5 py-3"></th>
                                    <th class="py-3">Course Name</th>
                                    <th class="py-3">Total Segments</th>
                                    <th class="py-3">Difficulty</th>
                                    <th class="py-3">Category</th>
                                    <th class="py-3">Price</th>
                                    <th class="py-3">Status</th>                                       
                                </tr>
                            </thead>
                            <tbody id="customers">
                                @foreach($courseShow as $key => $d)
                                <tr class="btn-reveal-trigger">
                                <td class="py-2">{{$key + 1}}</td>
                                    <td class="p-3">
                                        <a href="javascript:void(0);">
                                            <div class="media d-flex align-items-center">
                                                <div class="avatar avatar-xl mr-2">
                                                    <img class="img fluid" width="100" src="{{asset('uploads/courses/'.$d->image)}}" width="30" alt="">
                                                </div>                                                
                                            </div>
                                        </a>
                                    </td>
                                    <td class="py-2">{{$d->title_en}}</td>
                                    <!-- Display Total Segments -->
                                    <td class="py-2">{{$d->segment_count}}</td>
                                    <td class="py-2"><strong>{{ $d->difficulty == 'beginner' ? __('Beginner') :
                                                        ($d->difficulty == 'intermediate' ? __('Intermediate') :
                                                        __('Advanced')) }}</strong></td>
                                    <!-- Status Check -->                                    
                                    <td class="py-2">{{$d->courseCategory?->category_name}}</td>
                                    <td class="py-2">{{ $d->price == 0 ? 'Free' : number_format($d->price, 2) }}</td>
                                    <td>
                                        @if($d->status == 2)
                                            <span class="badge badge-rounded badge-success">Active</span>
                                        @elseif($d->status == 1)
                                            <span class="badge badge-rounded badge-warning">Pending</span>
                                        @endif
                                    </td>                                       
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