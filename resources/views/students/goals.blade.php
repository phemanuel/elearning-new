@extends('frontend.layouts.student-app')
@section('title', "My Goals")
@section('body-attr') style="background-color: #f6f6f9;" @endsection

@section('content')

<div class="goalx-page">

    <!-- ======================================
        PAGE HEADER
    ======================================= -->

    <div class="goalx-header-card">

        <div class="goalx-header-content">

            <span class="goalx-badge">
                🎯 Learning Planner
            </span>

            <h1>
                My Learning Goals
            </h1>

            <p>
                Create personal learning objectives, track your achievements,
                and stay focused on your educational journey.
            </p>

        </div>

        <div class="goalx-header-action">

            <button
                class="goalx-create-btn"
                data-bs-toggle="modal"
                data-bs-target="#createGoalModal">

                <i class="fas fa-plus-circle me-2"></i>

                Create Goal

            </button>

        </div>

    </div>

    <!-- ======================================
        OVERVIEW CARDS
    ======================================= -->

    <div class="goalx-overview-grid">

        <div class="goalx-stat-card goalx-stat-primary">

            <div class="goalx-stat-icon">
                <i class="fas fa-book-open"></i>
            </div>

            <div>
                <h3>{{ $totalCourses }}</h3>
                <span>Courses Enrolled</span>
            </div>

        </div>

        <div class="goalx-stat-card goalx-stat-success">

            <div class="goalx-stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <div>
                <h3>{{ $completedCourses }}</h3>
                <span>Courses Completed</span>
            </div>

        </div>

        <div class="goalx-stat-card goalx-stat-warning">

            <div class="goalx-stat-icon">
                <i class="fas fa-spinner"></i>
            </div>

            <div>
                <h3>{{ $activeCourses }}</h3>
                <span>In Progress</span>
            </div>

        </div>

        <div class="goalx-stat-card goalx-stat-purple">

            <div class="goalx-stat-icon">
                <i class="fas fa-bullseye"></i>
            </div>

            <div>
                <h3>{{ $totalGoals }}</h3>
                <span>Total Goals</span>
            </div>

        </div>

        <div class="goalx-stat-card goalx-stat-success">

            <div class="goalx-stat-icon">
                <i class="fas fa-trophy"></i>
            </div>

            <div>
                <h3>{{ $completedGoals }}</h3>
                <span>Goals Achieved</span>
            </div>

        </div>

        <div class="goalx-stat-card goalx-stat-danger">

            <div class="goalx-stat-icon">
                <i class="fas fa-clock"></i>
            </div>

            <div>
                <h3>{{ $pendingGoals }}</h3>
                <span>Pending Goals</span>
            </div>

        </div>

    </div>

    <!-- ======================================
        GOALS GRID
    ======================================= -->

    <div class="row g-4">

        @forelse($goals as $goal)

            @php

                $progress = $goal->target_value > 0
                    ? min(
                        100,
                        round(
                            ($goal->current_value / $goal->target_value) * 100
                        )
                    )
                    : 0;

            @endphp

            <div class="col-lg-6">

                <div class="goalx-card">

                    <div class="goalx-card-header">

                        <div>

                            <h4>
                                {{ $goal->title }}
                            </h4>

                            <span class="goalx-type">

                                {{ ucfirst(str_replace('_',' ',$goal->goal_type)) }}

                            </span>

                        </div>

                        <span class="goalx-status">

                            {{ ucfirst(str_replace('_',' ',$goal->status)) }}

                        </span>

                    </div>

                    @if($goal->description)

                        <p class="goalx-description">

                            {{ $goal->description }}

                        </p>

                    @endif

                    <div class="goalx-progress-wrapper">

                        <div class="goalx-progress">

                            <div
                                class="goalx-progress-fill"
                                style="width:{{ $progress }}%">
                            </div>

                        </div>

                        <div class="goalx-progress-text">

                            <span>
                                {{ $goal->current_value }}
                                /
                                {{ $goal->target_value }}
                            </span>

                            <strong>
                                {{ $progress }}%
                            </strong>

                        </div>

                    </div>

                    <div class="goalx-card-footer">

                        <div class="goalx-date">

                            <i class="far fa-calendar-alt"></i>

                            @if($goal->target_date)
                                {{ \Carbon\Carbon::parse($goal->target_date)->format('d M Y') }}
                            @else
                                No Deadline
                            @endif

                        </div>

                        <div class="goalx-actions">

                            <button
                                class="goalx-edit-btn editGoalBtn"
                                data-id="{{ $goal->id }}">

                                Edit

                            </button>

                            <button
                                class="goalx-delete-btn deleteGoalBtn"
                                data-id="{{ $goal->id }}">

                                Delete

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="goalx-empty-state">

                    <div class="goalx-empty-icon">

                        <i class="fas fa-bullseye"></i>

                    </div>

                    <h3>
                        No Goals Yet
                    </h3>

                    <p>
                        Start your learning journey by creating your first goal.
                    </p>

                    <button
                class="goalx-create-btn"
                data-bs-toggle="modal"
                data-bs-target="#createGoalModal">              

                Create First Goal

            </button>

                </div>

            </div>

        @endforelse

    </div>

</div>


<!-- ==========================================
     CREATE GOAL MODAL
========================================== -->

<div class="modal fade" id="createGoalModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content goalx-modal">

            <form id="createGoalForm">

                @csrf

                <div class="modal-header">

                    <div>

                        <h5 class="modal-title mb-1">
                            🎯 Create Learning Goal
                        </h5>

                        <small class="text-muted">
                            Set a target and track your learning journey.
                        </small>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <!-- Goal Title -->

                    <div class="mb-4">

                        <label class="form-label goalx-label">

                            Goal Title

                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control goalx-input"
                            placeholder="Example: Complete 10 Laravel Courses">

                        <small class="goalx-help">

                            Give your goal a clear and motivating title.

                        </small>

                    </div>

                    <!-- Goal Type -->

                    <div class="mb-4">

                        <label class="form-label goalx-label">

                            Goal Type

                        </label>

                        <select
                            name="goal_type"
                            class="form-select goalx-input">

                            <option value="course">
                                📚 Course Completion
                            </option>

                            <option value="certificate">
                                🏆 Certificate Goal
                            </option>

                            <option value="study_hours">
                                ⏰ Study Hours
                            </option>

                            <option value="custom">
                                🎯 Custom Goal
                            </option>

                        </select>

                        <small class="goalx-help">

                            Choose the type of learning achievement you want to track.

                        </small>

                    </div>

                    <!-- Goal Target -->

                    <div class="mb-4">

                        <label class="form-label goalx-label">

                            Goal Target

                        </label>

                        <input
                            type="number"
                            min="1"
                            name="target_value"
                            class="form-control goalx-input"
                            placeholder="10">

                        <small id="goalTargetHelp" class="goalx-help">

                            Example: Complete 10 courses, earn 5 certificates,
                            or study for 50 hours.

                        </small>

                    </div>

                    <!-- Deadline -->

                    <div class="mb-4">

                        <label class="form-label goalx-label">

                            Target Date

                        </label>

                        <input
                            type="date"
                            name="target_date"
                            class="form-control goalx-input">

                        <small class="goalx-help">

                            When would you like to achieve this goal?

                        </small>

                    </div>

                    <!-- Description -->

                    <div class="mb-0">

                        <label class="form-label goalx-label">

                            Description (Optional)

                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control goalx-input"
                            placeholder="Add more details about your goal..."></textarea>

                        <small class="goalx-help">

                            Describe why this goal matters to you.

                        </small>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn goalx-primary-btn">

                        Create Goal

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- Edit Modal -->
<!-- ==========================================
     EDIT GOAL MODAL (MATCHES CREATE DESIGN)
========================================== -->

<div class="modal fade" id="editGoalModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content goalx-modal">

            <form id="updateGoalForm">

                @csrf
                @method('PUT')

                <input type="hidden" id="edit_goal_id" name="goal_id">

                <div class="modal-header">

                    <div>

                        <h5 class="modal-title mb-1">
                            ✏️ Edit Learning Goal
                        </h5>

                        <small class="text-muted">
                            Update your learning goal details.
                        </small>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <!-- Goal Title -->
                    <div class="mb-4">

                        <label class="form-label goalx-label">
                            Goal Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="edit_title"
                            class="form-control goalx-input"
                            placeholder="Example: Complete 10 Laravel Courses">

                        <small class="goalx-help">
                            Give your goal a clear and motivating title.
                        </small>

                    </div>

                    <!-- Goal Type -->
                    <div class="mb-4">

                        <label class="form-label goalx-label">
                            Goal Type
                        </label>

                        <select
                            name="goal_type"
                            id="edit_goal_type"
                            class="form-select goalx-input">

                            <option value="course">📚 Course Completion</option>
                            <option value="certificate">🏆 Certificate Goal</option>
                            <option value="study_hours">⏰ Study Hours</option>
                            <option value="custom">🎯 Custom Goal</option>

                        </select>

                        <small class="goalx-help">
                            Choose the type of learning achievement you want to track.
                        </small>

                    </div>

                    <!-- Goal Target -->
                    <div class="mb-4">

                        <label class="form-label goalx-label">
                            Goal Target
                        </label>

                        <input
                            type="number"
                            min="1"
                            name="target_value"
                            id="edit_target_value"
                            class="form-control goalx-input"
                            placeholder="10">

                        <small class="goalx-help">
                            Example: Complete 10 courses, earn 5 certificates, or study for 50 hours.
                        </small>

                    </div>

                    <!-- Target Date -->
                    <div class="mb-4">

                        <label class="form-label goalx-label">
                            Target Date
                        </label>

                        <input
                            type="date"
                            name="target_date"
                            id="edit_target_date"
                            class="form-control goalx-input">

                            <!-- 🔥 CURRENT DATE DISPLAY -->
                            <!-- <small class="text-muted d-block mt-1">
                                
                            </small> -->

                       <small class="goalx-help d-block">
                            <span>
                                Current Date: <strong id="current_goal_date"></strong>
                            </span>

                            <span class="mx-1">•</span>

                            <span>
                                When would you like to achieve this goal?
                            </span>
                        </small>

                    </div>

                    <!-- Description -->
                    <div class="mb-0">

                        <label class="form-label goalx-label">
                            Description (Optional)
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            id="edit_description"
                            class="form-control goalx-input"
                            placeholder="Add more details about your goal..."></textarea>

                        <small class="goalx-help">
                            Describe why this goal matters to you.
                        </small>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn goalx-primary-btn">
                        Update Goal
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<div class="modal fade" id="deleteGoalModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content goalx-modal">

            <div class="modal-header">
                <h5 class="modal-title">🗑️ Delete Goal</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="mb-0">
                    Are you sure you want to delete this goal?
                    This action cannot be undone.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-danger" id="confirmDeleteGoalBtn">
                    Yes, Delete
                </button>
            </div>

        </div>

    </div>
</div>




<!-- Create Goal -->
<script>
  $(document).ready(function () {

    console.log('✅ Goal script loaded');

    // IMPORTANT: delegated event binding (fixes modal timing issues)
    $(document).on('submit', '#createGoalForm', function (e) {

        e.preventDefault(); // 🚨 STOPS PAGE RELOAD

        console.log('🔥 Goal form submit intercepted');

        let form = $(this);

        $.ajax({
            url: "{{ route('student.goals.store') }}",
            method: "POST",
            data: form.serialize(),

            beforeSend: function () {
                console.log('🚀 Sending request...');
            },

            success: function (res) {

                console.log('✅ SUCCESS:', res);

                if (res.status === 'success') {

                    $('#createGoalModal').modal('hide');
                    form[0].reset();

                    toastr.success(res.message || 'Goal created successfully');

                    // 🔥 reload page after short delay
                    setTimeout(() => {
                        location.reload();
                    }, 600);
                }
            },

            error: function (xhr) {

                console.log('❌ ERROR STATUS:', xhr.status);
                console.log('❌ ERROR RESPONSE:', xhr.responseText);

                if (xhr.status === 422) {
                    toastr.error('Validation error');
                }

                if (xhr.status === 419) {
                    toastr.error('Session expired (CSRF issue)');
                }

                if (xhr.status === 500) {
                    toastr.error('Server error');
                }
            },

            complete: function () {
                console.log('🏁 Request finished');
            }
        });

    });

});
</script>

<!-- Edit Goal -->
<script>
function formatDate(dateString) {

    if (!dateString) return 'No date set';

    let date = new Date(dateString);

    if (isNaN(date)) return dateString;

    return date.toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    });
}

$(document).on('click', '.editGoalBtn', function () {

    let goalId = $(this).data('id');

    let url = "{{ route('student.goals.edit', ':id') }}";
    url = url.replace(':id', goalId);

    $.ajax({
        url: url,
        method: 'GET',

        success: function (res) {

            window.editGoalData = res.goal;

            $('#edit_goal_id').val(res.goal.id);
            $('#edit_title').val(res.goal.title);
            $('#edit_goal_type').val(res.goal.goal_type);
            $('#edit_target_value').val(res.goal.target_value);
            $('#edit_description').val(res.goal.description);

            // 🔥 formatted display
            $('#current_goal_date').text(formatDate(res.goal.target_date));

            $('#editGoalModal').modal('show');
        }
    });

});
</script>

<!-- Update Goal -->
<script>
    $(document).on('submit', '#updateGoalForm', function (e) {

    e.preventDefault();

    let id = $('#edit_goal_id').val();

    let url = "{{ route('student.goals.update', ':id') }}";
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: "POST",
        data: $(this).serialize() + "&_method=PUT",

        success: function (res) {

            toastr.success(res.message);
            $('#editGoalModal').modal('hide');

            setTimeout(() => location.reload(), 500);
        },

        error: function (xhr) {
            console.log(xhr.responseText);
            toastr.error('Update failed');
        }
    });

});
</script>
<script>
   let deleteGoalId = null;

$(document).on('click', '.deleteGoalBtn', function () {

    deleteGoalId = $(this).data('id');

    $('#deleteGoalModal').modal('show');
});

$('#confirmDeleteGoalBtn').on('click', function () {

    if (!deleteGoalId) return;

    let url = "{{ route('student.goals.destroy', ':id') }}";
    url = url.replace(':id', deleteGoalId);

    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            _method: "DELETE"
        },

        beforeSend: function () {
            $('#confirmDeleteGoalBtn').text('Deleting...');
        },

        success: function (res) {

            $('#deleteGoalModal').modal('hide');

            toastr.success(res.message || 'Goal deleted');

            setTimeout(() => {
                location.reload();
            }, 500);
        },

        error: function (xhr) {
            console.log(xhr.responseText);
            toastr.error('Delete failed');
        },

        complete: function () {
            $('#confirmDeleteGoalBtn').text('Yes, Delete');
        }
    });

});
</script>
@endsection