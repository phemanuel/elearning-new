@extends('backend.layouts.app')
@section('title', 'Project Submission')

@push('styles')
<!-- Datatable -->
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Project Submission</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('project.index')}}">All Projects</a></li>
                    <li class="breadcrumb-item active"><a href="">Project Submission</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item">
                        <a href="javascript:void(0);" data-status="pending" class="nav-link btn-warning status-filter active">
                            <i class="fas fa-clock"></i> Pending
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" data-status="reviewed" class="nav-link btn-info status-filter">
                            <i class="fas fa-eye"></i> Reviewed
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" data-status="approved" class="nav-link btn-success status-filter">
                            <i class="fas fa-check-circle"></i> Approved
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Project Submission </h4>                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <!-- Project Submissions Table -->
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Picture</th>
                                            <th>Student Name</th>
                                            <th>Project Link</th>
                                            <th>Comment</th>
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="projectSubmissionsTable">
                                        @include('backend.project.submissions_list', ['projectSubmissions' => $projectSubmissions])
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
</div>

<!-- Review Project Modal -->
<div class="modal fade" id="reviewProjectModal" tabindex="-1" aria-labelledby="reviewProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewProjectModalLabel">Review Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Instruction Note -->
                <div class="alert alert-info text-center">
                    <strong>Note:</strong> If the project is <b>not passed</b>, leave the status as <b>Reviewed</b>.  
                    If the project <b>passed</b>, select <b>Approved</b>.
                </div>

                <form id="reviewProjectForm">
                    @csrf
                    <input type="hidden" id="projectSubmissionId">

                    <!-- Student Info -->
                    <div class="text-center mb-3">
                        <img id="studentImage" class="rounded-circle" width="80" height="80" alt="Student Image">
                        <h5 id="studentName"></h5>
                    </div>

                    <!-- Comment Section -->
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" rows="3"></textarea>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status">
                        <option selected>Select Status</option>
                            <option value="reviewed">Reviewed</option>
                            <option value="approved">Approved</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit Review</button>
                </form>
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
    $(document).ready(function () {
        var updateReviewUrl = "{{ route('admin.review.update') }}"; // Store the route

        // Open the modal and populate fields
        $('.review-btn').click(function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let image = $(this).data('image');
            let comment = $(this).data('comment') || '';
            let status = $(this).data('status') || 'reviewed'; // Default to 'reviewed' if empty

            $('#projectSubmissionId').val(id);
            $('#studentName').text(name);
            $('#studentImage').attr('src', image);
            $('#comment').val(comment);
            $('#status').val(status);

            $('#reviewProjectModal').modal('show');
        });

        // Handle form submission via AJAX
        $('#reviewProjectForm').submit(function (e) {
            e.preventDefault();

            let formData = {
                _token: "{{ csrf_token() }}",
                id: $('#projectSubmissionId').val(),
                comment: $('#comment').val(),
                status: $('#status').val()
            };

            console.log("Submitting Data:", formData); // Debugging

            $.ajax({
                url: updateReviewUrl,
                type: "POST",
                data: formData,
                success: function (response) {
                    console.log("Success:", response);
                    alert('Project updated successfully');
                    location.reload();
                },
                error: function (xhr) {
                    console.log("Error:", xhr.responseText); // Log exact error
                    alert('Something went wrong. Try again.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        let courseId = "{{ $courseId }}"; 

        // Handle status filter click
        $('.status-filter').click(function () {
            let status = $(this).data('status');

            console.log("Tab Clicked! Status:", status);

            $('.status-filter').removeClass('active');
            $(this).addClass('active');

            fetchProjects(status, courseId);
        });

        function fetchProjects(status, courseId) {
            console.log("Fetching projects for Status:", status, "and Course ID:", courseId);

            $.ajax({
                url: "{{ route('admin.review.filter') }}",
                type: "GET",
                data: { status: status, course_id: courseId },
                success: function (response) {
                    console.log("AJAX Request Sent...");
                    $('#projectSubmissionsTable').html(response.html);
                },
                error: function () {
                    alert('Error fetching projects.');
                }
            });
        }

        // Handle Review Button Click (Using Event Delegation)
        $(document).on('click', '.review-btn', function () {
            let submissionId = $(this).data('id');
            let studentName = $(this).data('name');
            let studentImage = $(this).data('image');
            let comment = $(this).data('comment');
            let status = $(this).data('status');

            console.log("Review Button Clicked! ID:", submissionId);

            // Populate modal fields
            $('#reviewProjectModal #submissionId').val(submissionId);
            $('#reviewProjectModal #studentName').text(studentName);
            $('#reviewProjectModal #studentImage').attr('src', studentImage);
            $('#reviewModal #comment').val(comment);
            $('#reviewProjectModal').modal('show');
        });
    });
</script>




@endpush