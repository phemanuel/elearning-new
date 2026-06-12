@extends('frontend.layouts.student-app')
@section('title', "Learning activity")
@section('body-attr') style="background-color: #f6f6f9;" @endsection

@section('content')

<div class="activity">

    <!-- HEADER -->
    <div class="activity__header">
        <h1>Learning Activity</h1>
        <p>Your complete learning history and engagement timeline</p>
    </div>

    <!-- TIMELINE -->
    <div class="timeline">

        @forelse($activities as $activity)

            <div class="timeline__item">

                <div class="timeline__icon">

                    @if($activity['type'] == 'course_completed')
                        🎓
                    @elseif($activity['type'] == 'quiz_attempt')
                        🧪
                    @elseif($activity['type'] == 'progress_update')
                        📊
                    @else
                        📖
                    @endif

                </div>

                <div class="timeline__content">

                    <div class="timeline__title">

                        @if($activity['type'] == 'course_completed')
                            Completed {{ $activity['course'] }}
                        @elseif($activity['type'] == 'quiz_attempt')
                            Took quiz in {{ $activity['course'] }}
                        @elseif($activity['type'] == 'progress_update')
                            Progress updated in {{ $activity['course'] }}
                        @else
                            Viewed lesson in {{ $activity['course'] }}
                        @endif

                    </div>

                    <div class="timeline__meta">

                        @if($activity['lesson'])
                            <span>{{ $activity['lesson'] }}</span>
                        @endif

                        @if(!is_null($activity['progress']))
                            <span>{{ $activity['progress'] }}%</span>
                        @endif

                        @if(!is_null($activity['score']))
                            <span>Score: {{ $activity['score'] }}%</span>
                        @endif

                        <span class="time">
                            {{ $activity['time']->diffForHumans() }}
                        </span>

                    </div>

                </div>

            </div>

        @empty

            <div class="empty">
                No activity recorded yet.
            </div>

        @endforelse

    </div>

</div>

@endsection