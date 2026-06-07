@extends('backend.layouts.app')
@section('title', 'Student List')

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
                    <h4>Student List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('student.index')}}">Students</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('student.index')}}">All Student</a></li>
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
                                    <div class="lms-card-title">All Students</div>
                                    <div style="font-size:12px; color:#64748b; margin-top:2px;">
                                        Manage registered learners and their accounts
                                    </div>
                                </div>

                                <a href="{{ route('student.create') }}"
                                style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:10px; font-size:13px; font-weight:600;">
                                    + Add Student
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            @if(auth()->user()->role_id == 1)
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($data as $d)

                                            <tr>

                                                <!-- Student -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:12px;">

                                                        <img
                                                            src="{{ asset('uploads/students/'.$d->image) }}"
                                                            class="lms-avatar"
                                                            alt="student"
                                                        >

                                                        <div>
                                                            <div style="font-weight:600;">
                                                                {{ $d->name_en }}
                                                            </div>
                                                            <div style="font-size:11px; color:#94a3b8;">
                                                                Student ID: #{{ $d->id }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>

                                                <!-- Email -->
                                                <td>
                                                    {{ $d->email }}
                                                </td>

                                                <!-- Contact -->
                                                <td>
                                                    {{ $d->contact_en }}
                                                </td>

                                                <!-- Gender -->
                                                <td>
                                                    <span style="font-size:13px;">
                                                        {{ $d->gender == 'male' ? 'Male' : ($d->gender == 'female' ? 'Female' : 'Other') }}
                                                    </span>
                                                </td>

                                                <!-- Status -->
                                                <td>
                                                    @if($d->status == 1)
                                                        <span class="lms-badge lms-badge-success">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="lms-badge lms-badge-danger">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Actions -->
                                                @if(auth()->user()->role_id == 1)
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('student.edit', encryptor('encrypt',$d->id)) }}"
                                                        style="background:#2563eb; color:#fff; padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{$d->id}}').submit()"
                                                        style="background:#ef4444; color:#fff; padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{$d->id}}"
                                                        action="{{ route('student.destroy', encryptor('encrypt',$d->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                                @endif

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Students Found
                                                </td>
                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                    <div id="grid-view" class="tab-pane fade col-lg-12">
                        <div class="row">
                            @forelse ($data as $d)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-header justify-content-end pb-0">
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                <span class="dropdown-dots fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border py-0">
                                                <div class="py-2">
                                                    <a class="dropdown-item"
                                                        href="{{route('student.edit', encryptor('encrypt',$d->id))}}">Edit</a>
                                                    <a class="dropdown-item text-danger"
                                                        href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <div class="profile-photo">
                                                <img src="{{asset('uploads/students/'.$d->image)}}" width="100"
                                                    height="100" class="rounded-circle" alt="">
                                            </div>
                                            <h3 class="mt-4 mb-1">{{$d->name_en}}</h3>
                                            <p class="text-muted">{{$d->role?->name}}</p>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span>Phone No. :</span>
                                                    <strong>{{$d->contact_en}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Email :</span>
                                                    <strong>{{$d->email}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Gender :</span>
                                                    <strong>{{$d->gender}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Status :</span>
                                                    <span class="badge {{$d->status==1?"
                                                        badge-success":"badge-danger"}}">@if($d->status==1){{__('Active')}}
                                                        @else{{__('Inactive')}} @endif</span>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4"
                                                href="#">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <p class="mt-3 px-4">Student Not Found</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse
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