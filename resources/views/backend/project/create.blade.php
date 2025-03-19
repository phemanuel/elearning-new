@extends('backend.layouts.app')
@section('title', 'Add Project')

@push('styles')
<!-- Pick date -->
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.date.css')}}">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Quiz</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('project.index')}}">All Project</a></li>
                    <li class="breadcrumb-item active"><a href="#">Add Project</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('project.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">                                
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course</label>
                                        <select class="form-control" name="courseId" id="courseId">
                                            <option value="">Select a Course</option>
                                            @forelse ($course as $c)
                                            <option value="{{$c->id}}" {{old('courseId')==$c->id?'selected':''}}>{{$c->title_en}}</option>
                                            @empty
                                            <option value="">No Course Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    @if($errors->has('courseId'))
                                    <span class="text-danger"> {{ $errors->first('courseId') }}</span>
                                    @endif
                                </div>  

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Additional Information(If needed)</label>
                                        <textarea class="form-control"
                                            name="additionalInfo">{{old('additionalInfo')}}</textarea>
                                    </div>
                                    @if($errors->has('additionalInfo'))
                                    <span class="text-danger"> {{ $errors->first('additionalInfo') }}</span>
                                    @endif
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Project Content</label>
                                        <textarea class="form-control"
                                            name="projectContent" id="myEditor">{{old('projectContent')}}</textarea>
                                    </div>
                                    @if($errors->has('projectContent'))
                                    <span class="text-danger"> {{ $errors->first('projectContent') }}</span>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<!-- pickdate -->
<script src="{{asset('vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.date.js')}}"></script>

<!-- Pickdate -->
<script src="{{asset('js/plugins-init/pickadate-init.js')}}"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $('#courseId').change(function() {
        var courseId = $(this).val();
        
        if (courseId) {
            $.ajax({
                url: '/admin/get-segments/' + courseId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Segments received:', data); // Check the data received
                    
                    // Clear the segment dropdown
                    $('#segmentId').empty();
                    $('#segmentId').append('<option value="">Select a Segment</option>'); // Default option
                    
                    if (Array.isArray(data) && data.length > 0) {
                        // Loop through the segments and add them to the dropdown
                        $.each(data, function(key, segment) {
                            console.log('Appending segment:', segment.title_en); // Log each segment
                            $('#segmentId').append('<option value="' + segment.id + '">' + segment.title_en + '</option>');
                        });
                    } else {
                        console.log('No segments found for the selected course.');
                        $('#segmentId').append('<option value="">No Segment Available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error:', error); // Log any error that occurs during the AJAX call
                }
            });
        } else {
            // If no course is selected, clear the segment dropdown
            $('#segmentId').empty();
            $('#segmentId').append('<option value="">Select a Segment</option>');
        }
    });
});

</script>
@endpush