@extends('frontend.layouts.student-app')
@section('title', "My Certificates")
@section('body-attr') style="background-color: #f6f6f9;" @endsection

@section('content')

<div class="cert-wrapper">

    {{-- HEADER --}}
    <div class="cert-hero">
        <div>
            <h1>🎓 Certificates</h1>
            <p>Download and view certificates for completed courses</p>
        </div>

        <div class="cert-count">
            {{ $certificates->count() }} Completed
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="cert-grid">

        @forelse ($certificates as $item)

            <div class="cert-card">

                <div class="cert-left">

                    <div class="cert-icon">
                        🏆
                    </div>

                    <div class="cert-info">
                        <h3>{{ $item->course->title ?? 'Untitled Course' }}</h3>
                        <p>Completed Course • Eligible for Certificate</p>

                        <span class="cert-badge">
                            ✔ Completed
                        </span>
                    </div>

                </div>

                <div class="cert-right">

                    <a href="{{ route('certificate.view', $item->id) }}" class="cert-btn">
                        View Certificate
                    </a>

                </div>

            </div>

        @empty

            <div class="cert-empty">
                <h2>No Certificates Yet</h2>
                <p>Complete your courses to unlock certificates.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection