@extends('backend.layouts.app')
@section('title', 'Review List')

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
                    <h4>Review List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('review.index')}}">Reviews</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('review.index')}}">All Review</a>
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
                                    <div class="lms-card-title">Reviews</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Student feedback on courses
                                    </div>
                                </div>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th>Course</th>
                                            <th>Student</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($review as $r)

                                            <tr>

                                                <!-- Rating -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:6px;">

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $r->rating)
                                                                <span style="color:#fbbf24; font-size:14px;">★</span>
                                                            @else
                                                                <span style="color:#e5e7eb; font-size:14px;">★</span>
                                                            @endif
                                                        @endfor

                                                        <span style="font-size:12px; color:#64748b; margin-left:5px;">
                                                            ({{ $r->rating }}/5)
                                                        </span>

                                                    </div>
                                                </td>

                                                <!-- Comment -->
                                                <td>
                                                    <div style="
                                                        max-width:300px;
                                                        white-space:nowrap;
                                                        overflow:hidden;
                                                        text-overflow:ellipsis;
                                                        color:#475569;
                                                    ">
                                                        {{ $r->comment }}
                                                    </div>
                                                </td>

                                                <!-- Course -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $r->course?->title_en }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Course Review
                                                    </div>
                                                </td>

                                                <!-- Student -->
                                                <td>
                                                    <div style="font-weight:600;">
                                                        {{ $r->student?->name_en }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Student
                                                    </div>
                                                </td>

                                                <!-- Action -->
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('review.edit', encryptor('encrypt',$r->id)) }}"
                                                        class="lms-btn">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{ $r->id }}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{ $r->id }}"
                                                        action="{{ route('review.destroy', encryptor('encrypt',$r->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="5" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Reviews Found
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