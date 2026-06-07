@extends('backend.layouts.app')
@section('title', trans('Role List'))

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
                    <h4>Role List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('role.index')}}">Roles</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('role.index')}}">All Role</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">

    <div class="lms-card">

        <!-- Header -->
        <div class="lms-card-header">

            <div>
                <div class="lms-card-title">All Roles</div>
                <div style="font-size:12px; color:#64748b; margin-top:2px;">
                    Manage system roles and access levels
                </div>
            </div>

            <a href="{{ route('role.create') }}"
               style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:10px; font-size:13px; font-weight:600;">
                + Add Role
            </a>

        </div>

        <!-- Table -->
        <div class="lms-table-wrapper">

            <table class="lms-table" id="example3">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Identity</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($data as $d)

                        <tr>

                            <!-- Index -->
                            <td style="width:50px;">
                                <span style="font-weight:600; color:#64748b;">
                                    {{ ++$loop->index }}
                                </span>
                            </td>

                            <!-- Role -->
                            <td>
                                <div style="font-weight:600;">
                                    {{ $d->name }}
                                </div>
                                <div style="font-size:11px; color:#94a3b8;">
                                    Role ID: #{{ $d->id }}
                                </div>
                            </td>

                            <!-- Identity -->
                            <td>
                                <span style="font-size:13px;">
                                    {{ $d->identity }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div style="display:flex; gap:8px; flex-wrap:wrap;">

                                    <!-- Edit -->
                                    <a href="{{ route('role.edit', encryptor('encrypt',$d->id)) }}"
                                       style="background:#2563eb; color:#fff; padding:6px 10px; border-radius:8px; font-size:12px;">
                                        Edit
                                    </a>

                                    <!-- Permissions -->
                                    <a href="{{ route('permission.list', encryptor('encrypt',$d->id)) }}"
                                       style="background:#111827; color:#fff; padding:6px 10px; border-radius:8px; font-size:12px;">
                                        Permissions
                                    </a>

                                    <!-- Delete -->
                                    <a href="javascript:void(0);"
                                       onclick="$('#form{{$d->id}}').submit()"
                                       style="background:#ef4444; color:#fff; padding:6px 10px; border-radius:8px; font-size:12px;">
                                        Delete
                                    </a>

                                </div>

                                <form id="form{{$d->id}}"
                                      action="{{ route('role.destroy', encryptor('encrypt',$d->id)) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">
                                No Roles Found
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