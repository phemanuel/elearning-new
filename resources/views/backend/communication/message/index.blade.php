@extends('backend.layouts.app')
@section('title', 'Message List')

@push('styles')
<!-- Datatable -->
<link href="{{asset('public/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Message List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('message.index')}}">Messages</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('message.index')}}">All Message</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <li class="nav-item"><a href="javascript:void(0);" data-toggle="tab"
                            class="nav-link btn-primary">Grid
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
                                    <div class="lms-card-title">Messages</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Internal communication between users
                                    </div>
                                </div>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Receiver</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($message as $m)

                                            <tr>

                                                <!-- Sender -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:10px;">

                                                        <div style="
                                                            width:36px;
                                                            height:36px;
                                                            border-radius:50%;
                                                            background:#e2e8f0;
                                                            display:flex;
                                                            align-items:center;
                                                            justify-content:center;
                                                            font-weight:600;
                                                        ">
                                                            {{ strtoupper(substr($m->sender?->name_en ?? 'S', 0, 1)) }}
                                                        </div>

                                                        <div style="font-weight:600;">
                                                            {{ $m->sender?->name_en ?? 'N/A' }}
                                                        </div>

                                                    </div>
                                                </td>

                                                <!-- Receiver -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:10px;">

                                                        <div style="
                                                            width:36px;
                                                            height:36px;
                                                            border-radius:50%;
                                                            background:#f1f5f9;
                                                            display:flex;
                                                            align-items:center;
                                                            justify-content:center;
                                                            font-weight:600;
                                                        ">
                                                            {{ strtoupper(substr($m->receiver?->name_en ?? 'R', 0, 1)) }}
                                                        </div>

                                                        <div style="font-weight:600;">
                                                            {{ $m->receiver?->name_en ?? 'N/A' }}
                                                        </div>

                                                    </div>
                                                </td>

                                                <!-- Message -->
                                                <td>
                                                    <div style="
                                                        max-width:300px;
                                                        white-space:nowrap;
                                                        overflow:hidden;
                                                        text-overflow:ellipsis;
                                                        color:#475569;
                                                    ">
                                                        {{ $m->content }}
                                                    </div>
                                                </td>

                                                <!-- Action -->
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('message.edit', encryptor('encrypt',$m->id)) }}"
                                                        class="lms-btn">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{ $m->id }}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{ $m->id }}"
                                                        action="{{ route('message.destroy', encryptor('encrypt',$m->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Messages Found
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
<script src="{{asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/plugins-init/datatables.init.js')}}"></script>

@endpush