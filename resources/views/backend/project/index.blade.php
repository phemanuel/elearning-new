@extends('backend.layouts.app')
@section('title', 'Project List')

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
                    <h4>Project List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('project.index')}}">All Project</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <!-- <li class="nav-item"><a href="javascript:void(0);" data-toggle="tab"
                            class="nav-link btn-primary">Grid
                            View</a></li> -->
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Project List </h4>
                                <a href="{{route('project.create')}}" class="btn btn-primary">+ Add Project</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Course')}}</th>
                                                <th>{{__('Project Content')}}</th>
                                                <th>{{__('Additional Info')}}</th>
                                                <th>{{__('Submission')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($project as $key => $q)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$q->course_title}}</td> 
                                                <td>
                                                    <div style="max-height: 100px;  overflow-y: auto; white-space: pre-wrap;">
                                                        {!! $q->project_content ?? 'No content' !!}
                                                    </div>
                                                </td>    
                                                <td>
                                                    <div style="max-height: 100px; overflow-y: auto;">    
                                                        {{ $q->additional_info }}</td>   
                                                    </div>                              
                                                <td>
                                                    <a href="{{ route('project.show', encryptor('encrypt', $q->course_id)) }}" 
                                                    class="btn btn-info" title="View Submission">
                                                        View 
                                                        @if($q->pending_submissions > 0)
                                                            <span class="badge bg-white text-dark border border-dark">{{ $q->pending_submissions }}</span>
                                                        @else
                                                            <span class="badge bg-white text-dark border border-dark">0</span>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('project.edit', encryptor('encrypt',$q->id))}}"
                                                        class="btn btn-sm btn-primary" title="Edit"><i
                                                            class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        title="Delete" onclick="$('#form{{$q->id}}').submit()"><i
                                                            class="la la-trash-o"></i></a>
                                                    <form id="form{{$q->id}}"
                                                        action="{{route('project.destroy', encryptor('encrypt',$q->id))}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan="4" class="text-center">No Project Found</th>
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
</div>

@endsection

@push('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

@endpush