@extends('backend.layouts.app')
@section('title', 'Certificate List')

@push('styles')
<!-- Datatable -->
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Certificate List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('certificates.index')}}">All Certificates</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid
                            View</a></li>
                </ul>
            </div> -->
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">

    <div class="lms-card">

        <!-- Header -->
        <div class="lms-card-header">

            <div>
                <div class="lms-card-title">Certificates</div>
                <div style="font-size:12px; color:#64748b;">
                    Manage issued certificates for instructors and courses
                </div>
            </div>

            @if(auth()->user()->role_id == 3)
                <a href="{{ route('certificates.create') }}" class="lms-btn">
                    + Add Certificate
                </a>
            @endif

        </div>

        <!-- Certificate Templates (ADMIN ONLY) -->
        @if(auth()->user()->role_id == 1)

            <div style="padding:15px 20px;">

                <div style="font-weight:600; margin-bottom:12px; color:#1e293b;">
                    Certificate Templates
                </div>

                <div class="row g-3">

                    @foreach([
                        'cert1.png' => 'Default',
                        'cert2.png' => 'Nova',
                        'cert3.png' => 'Inspire',
                        'cert4.png' => 'Eclipse'
                    ] as $file => $name)

                        <div class="col-lg-3 col-md-6 col-sm-6">

                            <div style="
                                background:#fff;
                                border:1px solid #e2e8f0;
                                border-radius:12px;
                                padding:10px;
                                text-align:center;
                                transition:0.2s;
                            ">

                                <img src="{{ asset('uploads/certificates/' . $file) }}"
                                     style="width:100%; height:160px; object-fit:cover; border-radius:10px;">

                                <div style="margin-top:8px; font-size:13px; font-weight:600;">
                                    {{ $name }}
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

        <!-- Table -->
        <div class="lms-table-wrapper">

            <table class="lms-table" id="example3">

                <thead>
                    <tr>
                        <th>Instructor</th>
                        <th>Course</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($data as $d)

                        <tr>

                            <!-- Instructor -->
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">

                                    <img src="{{ asset('uploads/users/' . ($d->instructor?->image ?? 'blank.png')) }}"
                                         style="width:38px; height:38px; border-radius:50%; object-fit:cover;"
                                         alt="instructor">

                                    <div>
                                        <div style="font-weight:600;">
                                            {{ $d->instructor->name_en ?? 'N/A' }}
                                        </div>
                                        <div style="font-size:11px; color:#94a3b8;">
                                            Instructor
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <!-- Course -->
                            <td>
                                <div style="font-weight:600;">
                                    {{ $d->course->title_en ?? 'N/A' }}
                                </div>
                                <div style="font-size:11px; color:#94a3b8;">
                                    Certified Course
                                </div>
                            </td>

                            <!-- Type -->
                            <td>
                                @if($d->certificate_type == 'completion')
                                    <span class="lms-badge lms-badge-success">Completion</span>
                                @elseif($d->certificate_type == 'achievement')
                                    <span class="lms-badge lms-badge-warning">Achievement</span>
                                @else
                                    <span class="lms-badge lms-badge-danger">
                                        {{ ucfirst($d->certificate_type) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td>
                                <div style="display:flex; gap:8px;">

                                    <a href="{{ route('certificates.edit', encryptor('encrypt', $d->id)) }}"
                                       class="lms-btn">
                                        Edit
                                    </a>

                                    <a href="javascript:void(0);"
                                       onclick="$('#form{{ $d->id }}').submit()"
                                       class="lms-btn-danger"
                                       style="padding:6px 10px; border-radius:8px; font-size:12px;">
                                        Delete
                                    </a>

                                </div>

                                <form id="form{{ $d->id }}"
                                      action="{{ route('certificates.destroy', encryptor('encrypt', $d->id)) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">
                                No Certificates Found
                            </td>
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

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

@endpush