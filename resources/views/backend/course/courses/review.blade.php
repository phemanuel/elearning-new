@extends('backend.layouts.app')
@section('title', 'Course Review')

@section('content')

<div class="content-body">
<div class="crv-page">

    <!-- HEADER -->
    <div class="crv-header">

        <div>
            <h2 class="crv-title">Course Review</h2>

            <div class="crv-breadcrumb">
                <a href="#">Dashboard</a>
                <span>/</span>
                <a href="#">Courses</a>
                <span>/</span>
                <span>Review</span>
            </div>
        </div>

    </div>


    <!-- COURSE INFO CARD -->
    <div class="crv-course-card">

        <img src="{{ asset('uploads/courses/'.$course->image) }}" class="crv-course-img">

        <div class="crv-course-info">

            <h3 class="crv-course-title">{{ $course->title_en }}</h3>

            <div class="crv-meta">
                <span>👨‍🏫 {{ $course->instructor?->name_en }}</span>
                <span>📚 {{ $course->courseCategory?->category_name }}</span>
                <span>💰 {{ $course->price ? '₦'.number_format($course->price) : 'Free' }}</span>
            </div>

        </div>

    </div>


    <!-- MAIN LAYOUT -->
    <div class="crv-layout">

        <!-- LEFT CONTENT -->
        <div class="crv-main">

            @foreach($course->segments as $segment)

            <div class="crv-module">

                <div class="crv-module-head">
                    <span class="crv-tag">Segment</span>
                    <h4>{{ $segment->title_en }}</h4>
                </div>

                <div class="crv-module-body">

                    @foreach($segment->lessons as $lesson)

                    <div class="crv-lesson">

                        <div class="crv-lesson-title">
                            🎬 {{ $lesson->title }}
                        </div>

                        <div class="crv-materials">

                            @foreach($lesson->materials as $material)

                                <div class="crv-material-item">

                                    <div class="crv-material-left">

                                        {{-- ICON BASED ON TYPE --}}
                                        <div class="crv-material-icon">
                                            @if($material->type == 'video')
                                                🎬
                                            @elseif($material->type == 'pdf')
                                                📄
                                            @elseif($material->type == 'audio')
                                                🎧
                                            @elseif($material->type == 'image')
                                                🖼️
                                            @elseif($material->type == 'link')
                                                🔗
                                            @else
                                                📘
                                            @endif
                                        </div>

                                        <div class="crv-material-info">

                                            <div class="crv-material-title">
                                                {{ $material->title }}
                                            </div>

                                            <div class="crv-material-type">
                                                {{ strtoupper($material->type) }}
                                            </div>

                                        </div>

                                    </div>


                                    {{-- RIGHT ACTION / PREVIEW --}}
                                    <div class="crv-material-actions">

                                        @if($material->type == 'video')
                                            <button 
                                                class="crv-preview-btn crv-open-material"
                                                data-id="{{ $material->id }}"
                                                data-type="{{ $material->type }}"
                                            >
                                                👁 Preview
                                            </button>

                                        @elseif($material->type == 'pdf')
                                            <button class="crv-preview-btn">📄 View PDF</button>

                                        @elseif($material->type == 'image')
                                            <button class="crv-preview-btn">👁 View</button>

                                        @elseif($material->type == 'link')
                                            <a href="{{ $material->content }}" target="_blank" class="crv-preview-btn">
                                                Open Link
                                            </a>

                                        @else
                                            <button class="crv-preview-btn">View</button>
                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

            @endforeach

        </div>


        <!-- RIGHT SIDEBAR -->
        <div class="crv-side">

            <div class="crv-panel">

                <h4 class="crv-panel-title">Review Panel</h4>

                <div class="crv-status">
                    Status:
                    <span class="crv-status-badge">
                        @if($course->status == 2)
                            Active
                        @elseif($course->status == 1)
                            Rejected
                        @else
                            Pending
                        @endif
                    </span>
                </div>

                <div class="crv-meta">
                    <p>Instructor: {{ $course->instructor?->name_en }}</p>
                    <p>Category: {{ $course->courseCategory?->category_name }}</p>
                    <p>Price: {{ $course->price ? '₦'.number_format($course->price) : 'Free' }}</p>
                </div>

                <hr>
                <div class="crv-action-group">

                    <div class="crv-action-group">

                    <button
                        id="approveBtn"
                        class="crv-btn crv-approve crv-activate"
                        data-id="{{ $course->id }}">
                        ✔ Approve Course
                    </button>     
                    
                    <button
                        id="rejectBtn"
                        class="crv-btn crv-reject crv-reject-btn"
                        data-id="{{ $course->id }}">
                        ✖ Reject Course
                    </button>                  

                </div>

                </div>            

            </div>

        </div>

    </div>

</div>
</div>


<div class="crv-modal" id="materialModal">

    <div class="crv-modal-content">

        <div class="crv-modal-header">
            <h3 id="modalTitle">Material Preview</h3>
           <span class="crv-close">&times;</span>
        </div>

        <div class="crv-modal-body" id="modalBody">
            Loading...
        </div>

    </div>

</div>

<!-- Reject modal----- -->
<div id="rejectModal" class="crv-modal">

    <div class="crv-modal-content">

        <div class="crv-modal-header">
            <h3>Reject Course</h3>
            <button type="button" class="crv-close-modal">×</button>
        </div>

        <div class="crv-modal-body">

            <input type="hidden" id="rejectCourseId">

            <label>Reason for rejection</label>

            <textarea id="rejectReason"
                      rows="5"
                      placeholder="Write why this course is being rejected..."></textarea>

            <button class="crv-btn crv-reject-confirm">
                Submit Rejection
            </button>

        </div>

    </div>

</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
 $(document).on('click', '.crv-open-material', function () {

    let id = $(this).data('id');
    let type = $(this).data('type');

    $('#materialModal').css('display', 'flex');
    $('#modalBody').html('Loading...');

    $.ajax({
        url: '/admin/material/preview/' + id,
        type: 'GET',

        success: function (res) {

            let html = '';

            // 🎬 VIDEO
            if (type === 'video') {
                html = `
                    <video controls style="width:100%; border-radius:10px;">
                        <source src="${res.file_url}" type="video/mp4">
                        Your browser does not support video.
                    </video>
                `;
            }

            // 🎧 AUDIO
            else if (type === 'audio') {
                html = `
                    <audio controls style="width:100%;">
                        <source src="${res.file_url}" type="audio/mpeg">
                        Your browser does not support audio.
                    </audio>
                `;
            }

            // 📄 TEXT (RTF / HTML CONTENT)
            else if (type === 'text') {
                html = `
                    <div class="crv-text-content">
                        ${res.html ?? '<p>No content available</p>'}
                    </div>
                `;
            }

            // fallback
            else {
                html = `<p>Unsupported material type</p>`;
            }

            $('#modalBody').html(html);
        }
    });

    $(document).on('click', '.crv-close', function (e) {
    e.preventDefault();
    e.stopPropagation();

    $('#materialModal').fadeOut(150);
});

});
</script>

<script>

// =========================
// INIT STATUS ON LOAD
// =========================
$(document).ready(function () {
    let status = {{ $course->status }};
    updateStatusUI(status);
});


// =========================
// STATUS UI HANDLER
// =========================
function updateStatusUI(status)
{
    let badge = $('.crv-status-badge');

    // reset buttons
    $('#approveBtn').show().prop('disabled', false).html('✔ Approve Course');
    $('#rejectBtn').show().prop('disabled', false).html('✖ Reject Course');

    if(status == 2)
    {
        // APPROVED
        badge.text('Active')
        .css({
            background:'#dcfce7',
            color:'#166534',
            padding:'5px 12px',
            borderRadius:'20px',
            fontWeight:'600'
        });

        $('#approveBtn').hide();
    }

    else if(status == 1)
    {
        // REJECTED
        badge.text('Rejected')
        .css({
            background:'#fee2e2',
            color:'#dc2626',
            padding:'5px 12px',
            borderRadius:'20px',
            fontWeight:'600'
        });

        $('#rejectBtn').hide();
    }

    else
    {
        // PENDING
        badge.text('Pending')
        .css({
            background:'#fef3c7',
            color:'#92400e',
            padding:'5px 12px',
            borderRadius:'20px',
            fontWeight:'600'
        });
    }
}


// =========================
// APPROVE COURSE (status = 2)
// =========================
$(document).on('click', '.crv-activate', function () {

    let btn = $(this);

    $.ajax({
        url: "{{ route('admin.course.activate') }}",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            course_id: btn.data('id')
        },

        beforeSend:function(){
            btn.prop('disabled', true).html('Processing...');
        },

        success:function(res){

            btn.prop('disabled', false).html('✔ Approve Course');

            if(res.success){
                updateStatusUI(2);
                alert('Course approved successfully');
            }

        },

        error:function(){
            btn.prop('disabled', false).html('✔ Approve Course');
        }

    });

});


// =========================
// OPEN REJECT MODAL
// =========================
$(document).on('click', '.crv-reject-btn', function () {

    let id = $(this).data('id');

    $('#rejectCourseId').val(id);
    $('#rejectReason').val('');

    $('#rejectModal').fadeIn();

});


// =========================
// CLOSE MODAL
// =========================
$(document).on('click', '.crv-close-modal', function () {
    $('#rejectModal').fadeOut();
});


// =========================
// SUBMIT REJECTION
// =========================
$(document).on('click', '.crv-reject-confirm', function () {

    let btn = $(this);

    $.ajax({
        url: "{{ route('admin.course.reject') }}",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            course_id: $('#rejectCourseId').val(),
            reason: $('#rejectReason').val()
        },

        beforeSend:function(){
            btn.prop('disabled', true).html('Submitting...');
        },

        success:function(res){

            btn.prop('disabled', false).html('Submit Rejection');

            if(res.success){
                $('#rejectModal').fadeOut();
                updateStatusUI(1);
                alert('Course rejected successfully');
            }

        },

        error:function(){
            btn.prop('disabled', false).html('Submit Rejection');
        }

    });

});

</script>