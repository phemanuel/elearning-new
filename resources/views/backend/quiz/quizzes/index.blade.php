@extends('backend.layouts.app')
@section('title', 'Quiz List')

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
                    <h4>Quiz List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <!-- <li class="breadcrumb-item active"><a href="{{route('quiz.index')}}">Quizzes</a></li> -->
                    <li class="breadcrumb-item active"><a href="{{route('quiz.index')}}">All Quiz</a>
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
                                    <div class="lms-card-title">Quizzes</div>
                                    <div style="font-size:12px; color:#64748b;">
                                        Manage assessments and questions
                                    </div>
                                </div>

                                <a href="{{ route('quiz.create') }}"
                                class="lms-btn">
                                    + Add Quiz
                                </a>

                            </div>

                            <!-- Table -->
                            <div class="lms-table-wrapper">

                                <table class="lms-table" id="example3">

                                    <thead>
                                        <tr>
                                            <th>Quiz</th>
                                            <th>Course</th>
                                            <th>Segment</th>
                                            <th>Questions</th>
                                            <th>Pass Mark</th>
                                            <th>Questions Manager</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($quiz as $q)

                                            <tr>

                                                <!-- Quiz Title -->
                                                <td>
                                                    <div style="font-weight:700;">
                                                        {{ $q->title }}
                                                    </div>
                                                    <div style="font-size:11px; color:#94a3b8;">
                                                        Quiz ID: #{{ $q->id }}
                                                    </div>
                                                </td>

                                                <!-- Course -->
                                                <td>
                                                    {{ $q->course?->title_en }}
                                                </td>

                                                <!-- Segment -->
                                                <td>
                                                    {{ $q->segment->title_en ?? 'No Segment' }}
                                                </td>

                                                <!-- Questions Count -->
                                                <td>
                                                    <span style="font-weight:600;">
                                                        {{ $q->questions->count() }}
                                                    </span>
                                                </td>

                                                <!-- Pass Mark -->
                                                <td>
                                                    <span class="lms-badge lms-badge-warning">
                                                        {{ $q->pass_mark }}%
                                                    </span>
                                                </td>

                                                <!-- Questions Action (Unified UX) -->
                                                <td>

                                                    @if($q->questions->count() > 0)

                                                        <a href="{{ route('question.show', encryptor('encrypt', $q->id)) }}"
                                                        class="lms-btn">
                                                            View Questions
                                                        </a>

                                                    @else

                                                        <a href="{{ route('question.createNew', ['id' => encryptor('encrypt', $q->id)]) }}"
                                                        class="lms-btn">
                                                            + Add Questions
                                                        </a>

                                                    @endif

                                                </td>

                                                <!-- Actions -->
                                                <td>

                                                    <div style="display:flex; gap:8px;">

                                                        <a href="{{ route('quiz.edit', encryptor('encrypt',$q->id)) }}"
                                                        class="lms-btn">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                        onclick="$('#form{{$q->id}}').submit()"
                                                        style="background:#ef4444; color:#fff; padding:6px 10px; border-radius:8px; font-size:12px;">
                                                            Delete
                                                        </a>

                                                    </div>

                                                    <form id="form{{$q->id}}"
                                                        action="{{ route('quiz.destroy', encryptor('encrypt',$q->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="7" style="text-align:center; padding:20px; color:#94a3b8;">
                                                    No Quizzes Found
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