@extends('backend.layouts.app')
@section('title', 'Category List')

@push('styles')
<!-- Datatable -->
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
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
                    <h4>Category List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('courseCategory.index')}}">Categories</a></li>
                    <li class="breadcrumb-item active"><a href="#">All Category</a></li>
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
                                    <div class="lms-card-title">All Categories</div>
                                    <div style="font-size:12px; color:#64748b; margin-top:2px;">
                                        Organize and manage course categories
                                    </div>
                                </div>

                                <a href="{{ route('courseCategory.create') }}"
                                style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:10px; font-size:13px; font-weight:600;">
                                    + Add Category
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Preview</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($data as $key => $d)

                                            <tr>

                                                <!-- Index -->
                                                <td style="width:50px;">
                                                    <span style="font-weight:600; color:#64748b;">
                                                        {{ $key + 1 }}
                                                    </span>
                                                </td>

                                                <!-- Category Name -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $d->category_name }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        ID: #{{ $d->id }}
                                                    </div>
                                                </td>

                                                <!-- Status -->
                                                <td>
                                                    @if($d->category_status == 1)
                                                        <span class="lms-badge lms-badge-success">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="lms-badge lms-badge-danger">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Image Preview -->
                                                <td>
                                                    <img
                                                        src="{{ asset('uploads/courseCategories/'.$d->category_image) }}"
                                                        style="width:70px; height:45px; object-fit:cover; border-radius:10px; border:1px solid #e5e7eb;"
                                                        alt="category"
                                                    >
                                                </td>

                                                <!-- Actions -->
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('courseCategory.edit', $d->id) }}"
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
                                                        action="{{ route('courseCategory.destroy', $d->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="5" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Categories Found
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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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
                                                <img src="{{asset('uploads/courseCategories/'.$d->category_image)}}"
                                                    class="w-100" alt="">
                                            </div>
                                            <h3 class="mt-4 mb-1">{{$d->category_name}}</h3>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span>#Sl.</span><strong>{{$d->id}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Status:</span>
                                                    <strong><span class="badge {{$d->category_status==1?"
                                                        badge-success":"badge-danger"}}">@if($d->category_status==1){{__('Active')}}
                                                    @else{{__('Inactive')}} @endif</span></strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span class="mb-0">Created At :</span>
                                                    <strong>{{$d->created_at}}</strong>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-primary btn-rounded mt-3 px-4"
                                                href="about-student.html">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <p class="mt-3 px-4">Category Not Found</p>
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
<!--**********************************
    Content body end
***********************************-->

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
@endpush