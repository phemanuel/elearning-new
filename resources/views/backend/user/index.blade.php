@extends('backend.layouts.app')
@section('title', 'User List')

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
                    <h4>User List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('user.index')}}">Users</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('user.index')}}">All User</a></li>
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
                                    <div class="lms-card-title">All Users</div>
                                    <div style="font-size:12px; color:#64748b; margin-top:2px;">
                                        Manage system users and permissions
                                    </div>
                                </div>

                                <a href="{{ route('user.create') }}"
                                style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:10px; font-size:13px; font-weight:600;">
                                    + Add User
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Role</th>
                                            <th>Access</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($data as $d)

                                            <tr>

                                                <!-- User -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:12px;">

                                                        <img src="{{ asset('uploads/users/'.$d->image) }}"
                                                            class="lms-avatar"
                                                            alt="user">

                                                        <div>
                                                            <div style="font-weight:600;">
                                                                {{ $d->name_en }}
                                                            </div>
                                                            <div style="font-size:11px; color:#94a3b8;">
                                                                ID: #{{ $d->id }}
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

                                                <!-- Role -->
                                                <td>
                                                    <span style="font-size:13px; font-weight:500;">
                                                        {{ $d->role?->name }}
                                                    </span>
                                                </td>

                                                <!-- Access -->
                                                <td>
                                                    @if($d->full_access == 1)
                                                        <span class="lms-badge lms-badge-success">
                                                            Full Access
                                                        </span>
                                                    @else
                                                        <span class="lms-badge lms-badge-warning">
                                                            Limited
                                                        </span>
                                                    @endif
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
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('user.edit', encryptor('encrypt',$d->id)) }}"
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
                                                        action="{{ route('user.destroy', encryptor('encrypt',$d->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="7" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Users Found
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
                                                        href="{{route('user.edit', encryptor('encrypt',$d->id))}}">Edit</a>
                                                    <a class="dropdown-item text-danger"
                                                        href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <div class="profile-photo">
                                                <img src="{{asset('uploads/users/'.$d->image)}}" width="100"
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
                                                    <span class="mb-0">Status :</span>
                                                    <span class="badge {{$d->status==1?"
                                                        badge-success":"badge-danger"}}">@if($d->status==1){{__('Active')}}
                                                        @else{{__('Inactive')}} @endif</span>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Full Access :</span>
                                                    <span class="badge {{$d->full_access==1?"
                                                        badge-info":"badge-warning"}}">@if($d->full_access==1){{__('Yes')}}
                                                        @else{{__('No')}} @endif</span>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4"
                                                href="about-student.html">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <p class="mt-3 px-4">User Not Found</p>
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