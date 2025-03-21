@forelse ($projectSubmissions as $key => $submission)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>
        <img src="{{ asset('uploads/students/' . $submission->student->image) }}" 
            alt="Student Image" class="rounded-circle" width="50" height="50">
    </td>
    <td>{{ $submission->student->name_en ?? 'Unknown' }}</td>
    <td>
        <a href="{{ $submission->project_link }}" target="_blank" class="btn btn-primary">
            <i class="fas fa-external-link-alt"></i> View Project
        </a>
    </td>
    <td>
        <div style="max-height: 80px; overflow-y: auto; ">
            {!! !empty($submission->comment) ? $submission->comment : '<span class="text-muted">No comments</span>' !!}
        </div>
    </td>
    <!-- <td>
        <span class="badge bg-{{ $submission->project_status == 'approved' ? 'success' : ($submission->project_status == 'reviewed' ? 'info' : 'warning') }} text-dark">
            {{ ucfirst($submission->project_status) }}
        </span>
    </td> -->
    <td>
    @if ($submission->project_status == 'pending')
        <button class="btn btn-warning review-btn"
                data-id="{{ $submission->id }}" 
                data-name="{{ $submission->student->name_en }}" 
                data-image="{{ asset('uploads/students/' . $submission->student->image) }}" 
                data-comment="{{ $submission->comment }}" 
                data-status="{{ $submission->project_status }}">
            <i class="fas fa-check"></i> Review
        </button>
    @elseif ($submission->project_status == 'reviewed')
        <button class="btn btn-info edit-btn"
                data-id="{{ $submission->id }}" 
                data-name="{{ $submission->student->name_en }}" 
                data-image="{{ asset('uploads/students/' . $submission->student->image) }}" 
                data-comment="{{ $submission->comment }}" 
                data-status="{{ $submission->project_status }}">
            <i class="fas fa-edit"></i> Edit
        </button>
    @endif
</td>
</tr>
@empty
<tr>
    <th colspan="7" class="text-center">No Projects Found</th>
</tr>
@endforelse
