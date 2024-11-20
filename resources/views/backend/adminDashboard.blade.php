@extends('backend.layouts.app')
@section('title', 'Admin Dashboard')

@push('styles')
<link rel="stylesheet" href="{{asset('vendor/jqvmap/css/jqvmap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/chartist/css/chartist.min.css')}}">
<link rel="stylesheet" href="{{asset('css/skin-2.css')}}">
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
                        <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 0</h5>
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
            <!-- <div class="col-xl-8 col-xxl-8 col-lg-8 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Assign Task</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table header-border table-hover verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Assigned Professors</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Working Design report</td>
                                        <td>Herman Beck</td>
                                        <td><span class="badge badge-rounded badge-primary">DONE</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%;" role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>Fees Collection report</td>
                                        <td>Emma Watson</td>
                                        <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 70%;"
                                                    role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>Management report</td>
                                        <td>Mary Adams</td>
                                        <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 70%;"
                                                    role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>Library book status</td>
                                        <td>Caleb Richards</td>
                                        <td><span class="badge badge-rounded badge-danger">Suspended</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" style="width: 70%;"
                                                    role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <td>Placement status</td>
                                        <td>June Lane</td>
                                        <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 70%;"
                                                    role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <td>Working Design report</td>
                                        <td>Herman Beck</td>
                                        <td><span class="badge badge-rounded badge-primary">DONE</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%;" role="progressbar">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Notifications</h4>
                    </div>
                    <div class="card-body">
                        <div class="widget-todo dz-scroll" style="height:370px;" id="DZ_W_Notifications">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge primary"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic1.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Dr sultads Send you Photo</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge warning"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic2.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Resport created successfully</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic3.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Reminder : Treatment Time!</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge success"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic4.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Dr sultads Send you Photo</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge warning"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic5.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Resport created successfully</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge dark"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic6.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Reminder : Treatment Time!</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge info"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic7.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Dr sultads Send you Photo</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic8.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Resport created successfully</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge success"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic9.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Reminder : Treatment Time!</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="timeline-badge warning"></div>
                                    <a class="timeline-panel text-muted d-flex align-items-center"
                                        href="javascript:void(0);">
                                        <img class="rounded-circle" alt="image" width="50"
                                            src="{{asset('images/profile/education/pic10.jpg')}}">
                                        <div class="col">
                                            <h5 class="mb-1">Dr sultads Send you Photo</h5>
                                            <small class="d-block">29 July 2020 - 02:26 PM</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Enrolled Student List </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped">
                            <thead>
                                <tr>
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
                                                <div class="media-body">
                                                    <h5 class="mb-0 fs--1">{{ $enrollment->student->name_en }}</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
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
@endpush