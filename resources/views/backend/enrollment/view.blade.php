@extends('backend.layouts.app')
@section('title', 'Enrollment')

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
                    <li class="breadcrumb-item active"><a href="{{route('enrollment.index')}}">Enrollments</a></li>
                    <li class="breadcrumb-item active"><a href="#">All Enrollments</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <!-- <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid
                            View</a></li> -->
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">

                    <div class="lms-card">

                        <div class="lms-card-header">
                            <div>
                                <div class="lms-card-title">Students</div>
                                <div style="font-size:12px; color:#64748b;">
                                    Manage learners and enrollments
                                </div>
                            </div>
                        </div>

                        <div class="lms-table-wrapper">

                            <table class="lms-table" id="example3">

                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Courses</th>
                                        <th>Enroll</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse ($data as $d)

                                        <tr>

                                            <!-- Student -->
                                            <td>
                                                <div style="display:flex; align-items:center; gap:10px;">

                                                    <img src="{{ asset('uploads/students/' . $d->image) }}"
                                                        style="width:40px; height:40px; border-radius:50%; object-fit:cover;"
                                                        alt="student">

                                                    <span style="font-weight:600;">
                                                        {{ $d->name_en }}
                                                    </span>

                                                </div>
                                            </td>

                                            <!-- Email -->
                                            <td>{{ $d->email }}</td>

                                            <!-- Contact -->
                                            <td>{{ $d->contact_en }}</td>

                                            <!-- Courses -->
                                            <td>
                                                @if ($d->enrollments->isNotEmpty())
                                                    <div style="max-height:60px; overflow:auto; font-size:12px; color:#475569;">
                                                        @foreach ($d->enrollments as $enrollment)
                                                            @if ($enrollment->course)
                                                                • {{ $enrollment->course->title_en }}<br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="lms-badge lms-badge-warning">No Courses</span>
                                                @endif
                                            </td>

                                            <!-- Enroll -->
                                            <td>
                                                <select class="lms-select courseId" data-student-id="{{ $d->id }}">
                                                    @foreach ($course as $c)
                                                        <option value="{{ $c->id }}">{{ $c->title_en }}</option>
                                                    @endforeach
                                                </select>

                                                <button class="lms-btn enroll-btn"
                                                        data-student-id="{{ $d->id }}"
                                                        style="margin-top:6px;">
                                                    Enroll
                                                </button>
                                            </td>

                                            <!-- Action -->
                                            <td>
                                                <a href="{{ route('student.edit', encryptor('encrypt',$d->id)) }}"
                                                class="lms-btn">
                                                    Edit
                                                </a>
                                            </td>

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
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.enroll-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                // Retrieve required data
                const studentId = this.dataset.studentId;
                const courseId = this.closest('tr').querySelector('#courseId').value;

                // Ensure all required data is available
                if (!studentId || !courseId ) {
                    alert('Missing required data. Please check and try again.');
                    return;
                }

                // Send POST request to enroll route
                fetch("{{ route('enrollment.enroll') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ student_id: studentId, course_id: courseId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Enrollment successful!');
                        // Optional: Refresh the table or update UI
                    } else {
                        alert(data.message || 'An error occurred. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again later.');
                });
            });
        });
    });
</script>
@endpush