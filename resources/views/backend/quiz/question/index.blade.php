@extends('backend.layouts.app')
@section('title', 'Question List')

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
                    <h4>Question List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('question.index')}}">Questions</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('question.index')}}">All Question</a>
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
                                    <div class="lms-card-title">Question Bank</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Manage quiz questions and answers
                                    </div>
                                </div>

                                <a href="{{ route('question.create') }}"
                                class="lms-btn">
                                    + Add Question
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Quiz</th>
                                            <th>Type</th>
                                            <th>Question</th>
                                            <th>Options</th>
                                            <th>Correct Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($question as $q)

                                            <tr>

                                                <!-- Quiz -->
                                                <td>
                                                    <span style="font-weight:600;">
                                                        {{ $q->quiz?->title }}
                                                    </span>
                                                </td>

                                                <!-- Type -->
                                                <td>
                                                    @if($q->type == 'multiple_choice')
                                                        <span class="lms-badge lms-badge-success">MCQ</span>
                                                    @elseif($q->type == 'true_false')
                                                        <span class="lms-badge lms-badge-warning">True/False</span>
                                                    @else
                                                        <span class="lms-badge lms-badge-danger">Short</span>
                                                    @endif
                                                </td>

                                                <!-- Question -->
                                                <td>
                                                    <div style="max-width:260px; font-weight:600;">
                                                        {{ $q->content }}
                                                    </div>
                                                </td>

                                                <!-- Options (clean grouped view) -->
                                                <td>
                                                    <div style="font-size:12px; color:#475569; line-height:1.4;">

                                                        @if($q->option_a) A: {{ $q->option_a }} <br> @endif
                                                        @if($q->option_b) B: {{ $q->option_b }} <br> @endif
                                                        @if($q->option_c) C: {{ $q->option_c }} <br> @endif
                                                        @if($q->option_d) D: {{ $q->option_d }} @endif

                                                    </div>
                                                </td>

                                                <!-- Correct Answer -->
                                                <td>
                                                    <span class="lms-badge lms-badge-success">
                                                        {{
                                                            $q->correct_answer == 'a' ? 'Option A' :
                                                            ($q->correct_answer == 'b' ? 'Option B' :
                                                            ($q->correct_answer == 'c' ? 'Option C' : 'Option D'))
                                                        }}
                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td>

                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('question.edit', encryptor('encrypt',$q->id)) }}"
                                                        class="lms-btn">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{$q->id}}').submit()"
                                                        class="lms-btn-danger"
                                                        style="padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{$q->id}}"
                                                        action="{{ route('question.destroy', encryptor('encrypt',$q->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Questions Found
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