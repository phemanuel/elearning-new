@extends('frontend.layouts.student-app')
@section('title', "Learning Stats")
@section('body-attr') style="background-color: #f6f6f9;" @endsection

@section('content')

<div class="stats">

    <div class="stats__header">

        <div class="stats__titleRow">
            <h1>Learning Overview</h1>

            <span class="stats__badge">
                Live Analytics
            </span>
        </div>

        <p>
            Real-time overview of your learning progress, performance, and engagement activity.
        </p>

    </div>

    <!-- KPI STRIP -->
    <div class="stats__kpis">

        <div class="kpi kpi--default">
            <div class="kpi__label">Courses Enrolled</div>
            <div class="kpi__value">{{ $enrolledCourses }}</div>
        </div>

        <div class="kpi kpi--primary">
            <div class="kpi__label">Completion Rate</div>
            <div class="kpi__value">{{ $completionRate }}%</div>
        </div>

        <div class="kpi kpi--blue">
            <div class="kpi__label">Average Quiz Score</div>
            <div class="kpi__value">{{ $avgQuizScore }}%</div>
        </div>

        <div class="kpi kpi--purple">
            <div class="kpi__label">Learning Activities</div>
            <div class="kpi__value">{{ $totalLearningEvents }}</div>
        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="stats__grid">        
        <!-- LEFT -->
        <div class="panel">

            <div class="panel__title">Progress Overview</div>

            <div class="progress">

                <div class="progress__top">
                    <span>Average Course Progress</span>
                    <strong>{{ $avgProgress }}%</strong>
                </div>

                <div class="progress__bar">
                    <div style="width: {{ $avgProgress }}%"></div>
                </div>

            </div>

            <div class="mini">

                <div class="mini__box">
                    <span>Active Courses</span>
                    <strong>{{ $activeCourses }}</strong>
                </div>

                <div class="mini__box">
                    <span>Completed Courses</span>
                    <strong>{{ $completedCourses }}</strong>
                </div>

                <div class="mini__box">
                    <span>Completion Rate</span>
                    <strong>{{ $completionRate }}%</strong>
                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <!-- RIGHT -->
        <div class="panel">

            <div class="panel__title">Insights</div>

            <div class="insight">

                <div class="insight__title">Engagement Level</div>

                <div class="insight__badge">
                    {{ $engagementLevel }}
                </div>

            </div>

            <div class="insight">

                <div class="insight__title">Performance Insight</div>

                <div class="insight__text">

                    @if($completionRate >= 70)
                        Excellent progress — you're completing courses consistently.
                    @elseif($completionRate >= 40)
                        Moderate progress — keep building consistency.
                    @else
                        Low completion rate — consider increasing learning activity.
                    @endif

                </div>

            </div>

            <div class="insight">

                <div class="insight__title">Learning Behavior</div>

                <div class="insight__text">

                    @if($totalLearningEvents > 50)
                        High engagement — you're actively interacting with course content.
                    @elseif($totalLearningEvents > 20)
                        Medium engagement — occasional learning activity detected.
                    @else
                        Low engagement — increase study consistency for better results.
                    @endif

                </div>

            </div>

        </div>


    </div>

</div>

@endsection