@extends('backend.layouts.app')
@section('title', 'Course List')

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
                    <h4>Course List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">All Course</a></li>
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
                                    <div class="lms-card-title">All Courses</div>
                                    <div style="font-size:12px; color:#64748b; margin-top:2px;">
                                        Manage course content, pricing and visibility
                                    </div>
                                </div>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Instructor</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Link</th>
                                            <th>Project</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($course as $d)

                                            <tr>

                                                <!-- Course -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:12px;">

                                                        <img src="{{ asset('uploads/courses/'.$d->image) }}"
                                                            style="width:48px; height:48px; border-radius:10px; object-fit:cover;"
                                                            alt="course">

                                                        <div>
                                                            <div style="font-weight:600;">
                                                                {{ $d->title_en }}
                                                            </div>
                                                            <div style="font-size:11px; color:#94a3b8;">
                                                                {{ $d->course_url }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>

                                                <!-- Instructor -->
                                                <td>
                                                    <span style="font-weight:500;">
                                                        {{ $d->instructor?->name_en }}
                                                    </span>
                                                </td>

                                                <!-- Category -->
                                                <td>
                                                    {{ $d->courseCategory?->category_name }}
                                                </td>

                                                <!-- Price -->
                                                <td>
                                                    @if($d->price)
                                                        <span style="font-weight:600;">
                                                            ₦{{ number_format($d->price) }}
                                                        </span>
                                                    @else
                                                        <span class="lms-badge lms-badge-success">
                                                            Free
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Link -->
                                                <td>
                                                    <div style="display:flex; align-items:center; gap:8px;">

                                                        <a href="https://kingsdigihub.org/courses/{{ $d->course_url }}"
                                                        target="_blank"
                                                        style="font-size:12px; color:#2563eb; text-decoration:none; max-width:140px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                                            Open Link
                                                        </a>

                                                        <button class="copy-btn"
                                                                data-url="https://kingsdigihub.org/courses/{{ $d->course_url }}"
                                                                style="background:#f1f5f9; border:1px solid #e5e7eb; padding:4px 8px; border-radius:6px; font-size:12px;">
                                                            Copy
                                                        </button>

                                                    </div>
                                                </td>

                                                <!-- Project -->
                                                <td>
                                                    @if($d->project == 1)
                                                        <span class="lms-badge lms-badge-success">Yes</span>
                                                    @else
                                                        <span class="lms-badge lms-badge-danger">No</span>
                                                    @endif
                                                </td>

                                                <!-- Status -->
                                                <td>
                                                    @if($d->status == 2)
                                                        <span class="lms-badge lms-badge-success">Active</span>
                                                    @elseif($d->status == 1)
                                                        <span class="lms-badge lms-badge-danger">Inactive</span>
                                                    @else
                                                        <span class="lms-badge lms-badge-warning">Pending</span>
                                                    @endif
                                                </td>

                                                <!-- Actions -->
                                                <td>
                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('course.edit', encryptor('encrypt',$d->id)) }}"
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
                                                        action="{{ route('course.destroy', encryptor('encrypt',$d->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="8" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Courses Found
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
<script>
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            navigator.clipboard.writeText(url).then(() => {
                this.innerHTML = '<i class="fa fa-check text-success"></i> Copied!';
                setTimeout(() => {
                    this.innerHTML = '<i class="fa fa-copy"></i> Copy';
                }, 2000);
            });
        });
    });
</script>
@endpush