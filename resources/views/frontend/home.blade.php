@extends('frontend.layouts.app')
@section('title', 'Home')
@section('footer-class') footer--two @endsection


@section('content')

<!-- Banner Starts Here -->
<section class="lmsHero">

    <div class="lmsHero__bg"
         style="background-image: url('{{ asset('frontend/dist/images/banner/banner.jpg') }}');">
    </div>

    <div class="lmsHero__container">

        <div class="lmsHero__grid">

            <!-- LEFT CONTENT -->
            <div class="lmsHero__content">

                <h1 class="lmsHero__title">
                    Unlock Knowledge Anywhere, Anytime with Experts.
                </h1>

                <p class="lmsHero__subtitle">
                    Our commitment is to guide you to the finest online courses,
                    offering expert insights whenever and wherever you are.
                </p>

                <!-- SEARCH -->
                <form class="lmsHero__searchForm">
                    <div class="lmsHero__searchBox">

                        <input type="text"
                               class="lmsHero__input"
                               placeholder="What do you want to learn today..." />

                        <button type="submit" class="lmsHero__searchBtn">
                            Search
                        </button>

                    </div>
                </form>

            </div>

            <!-- RIGHT IMAGE -->
            <div class="lmsHero__media">
                <img src="{{ asset('frontend/dist/images/banner/banner-image-05.png') }}"
                     alt="Learning illustration">
            </div>

        </div>

    </div>

</section>

<!-- <section class="lmsCategories">

    <div class="lmsCategories__container">

        <div class="lmsCategories__header">
            <h2 class="lmsCategories__title">Browse Categories</h2>

            <a href="{{ route('searchCourse') }}" class="lmsCategories__viewAll">
                View all →
            </a>
        </div>

        <div class="lmsCategories__grid">

            @forelse ($category->take(8) as $cat)

                @php
                    $courseCount = $cat->course()->where('status', 2)->count();
                @endphp

                <a href="{{ route('courseName', ['courseCategory' => $cat->category_name]) }}"
                   class="lmsCategoryCard">

                    <img src="{{ asset('uploads/courseCategories/'.$cat->category_image) }}"
                         class="lmsCategoryCard__img">

                    <div class="lmsCategoryCard__info">
                        <h4>{{ $cat->category_name }}</h4>
                        <p>{{ $courseCount }} Courses</p>
                    </div>

                </a>

            @empty
                <p>No categories available</p>
            @endforelse

        </div>

    </div>

</section> -->

<!--  Popular Courses Starts Here -->
<section class="lmsCourseTabs">
    <div class="container">
        <div class="row">
            <div class="lmsCourseTabs__header">

                <h3 class="lmsCourseTabs__title">
                    Our Popular Courses
                </h3>

                <div class="lmsCourseTabs__nav">

                    <button class="lmsTab is-active" data-tab="all">
                        All
                    </button>

                    <button class="lmsTab" data-tab="design">
                        Design
                    </button>

                    <button class="lmsTab" data-tab="data">
                        Data Science
                    </button>

                    <button class="lmsTab" data-tab="dev">
                        Programming
                    </button>

                    <button class="lmsTab" data-tab="sales">
                        Sales & Marketing
                    </button>

                    <button class="lmsTab" data-tab="business">
                        Business
                    </button>

                    <button class="lmsTab" data-tab="it">
                        IT & Software
                    </button>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="tab-content" id="pills-tabContent">
            <div class="lmsTabContent is-active" data-tab-content="all">

                <div class="lmsCourseGrid">

                    @forelse ($popularCourses as $pc)

                        <div class="lmsCourseCard">

                            <!-- IMAGE -->
                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $pc->id)]) }}"
                            class="lmsCourseCard__image">

                                <img src="{{ asset('uploads/courses/' . $pc->image) }}"
                                    alt="{{ $pc->title_en }}">

                            </a>

                            <!-- BODY -->
                            <div class="lmsCourseCard__body">

                                <h3 class="lmsCourseCard__title">
                                    <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $pc->id)]) }}">
                                        {{ $pc->title_en }}
                                    </a>
                                </h3>

                                <!-- INSTRUCTOR + PRICE -->
                                <div class="lmsCourseCard__meta">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $pc->instructor?->id)) }}"
                                    class="lmsCourseCard__instructor">

                                        <img src="{{ asset('uploads/users/' . $pc->instructor?->image) }}"
                                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                        <span>{{ $pc->instructor?->name_en ?? 'Unknown' }}</span>

                                    </a>

                                    <div class="lmsCourseCard__price">
                                        <span>
                                            {{ $pc->price && $pc->price > 0
                                                ? $pc->currency_type . number_format($pc->price, 2)
                                                : 'Free' }}
                                        </span>

                                        @if($pc->old_price && $pc->old_price > 0)
                                            <del>
                                                {{ $pc->currency_type . number_format($pc->old_price, 2) }}
                                            </del>
                                        @endif
                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="lmsCourseCard__stats">

                                    <div class="lmsStat">
                                        ⭐ <span>4.5</span>
                                    </div>

                                    <div class="lmsStat">
                                        ⏱ <span>
                                            {{ $pc->segments->count() }}
                                            {{ Str::plural('segment', $pc->segments->count()) }}
                                        </span>
                                    </div>

                                    <div class="lmsStat">
                                        📘 <span>
                                            {{ $pc->lessons->count() }}
                                            {{ Str::plural('lesson', $pc->lessons->count()) }}
                                        </span>
                                    </div>

                                </div>

                                <!-- CTA -->
                                <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $pc->id)]) }}"
                                class="lmsBtn lmsBtn--primary lmsCourseCard__btn">

                                    View Course

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="lmsEmptyState">
                            <div class="lmsEmptyState__box">
                                <h3>No courses available in this section</h3>
                                <p>Try exploring other categories or check back later.</p>
                            </div>
                        </div>

                    @endforelse

                </div>

                <!-- FOOTER CTA -->
                <div class="lmsTabContent__footer">
                    <a href="{{ route('searchCourse') }}" class="lmsBtn lmsBtn--ghost">
                        Browse All Courses
                    </a>
                </div>

            </div>


            <div class="lmsTabContent" data-tab-content="design">

                <div class="lmsCourseGrid">

                    @forelse ($designCourses as $dc)

                        <div class="lmsCourseCard">

                            <!-- IMAGE -->
                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dc->id)]) }}"
                            class="lmsCourseCard__image">

                                <img src="{{ asset('uploads/courses/'.$dc->image) }}"
                                    alt="{{ $dc->title_en }}">

                            </a>

                            <!-- BODY -->
                            <div class="lmsCourseCard__body">

                                <h3 class="lmsCourseCard__title">
                                    <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dc->id)]) }}">
                                        {{ $dc->title_en }}
                                    </a>
                                </h3>

                                <!-- META -->
                                <div class="lmsCourseCard__meta">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $dc->instructor?->id)) }}"
                                    class="lmsCourseCard__instructor">

                                        <img src="{{ asset('uploads/users/'.$dc?->instructor->image) }}"
                                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                        <span>{{ $dc?->instructor->name_en ?? 'Unknown Instructor' }}</span>

                                    </a>

                                    <div class="lmsCourseCard__price">
                                        <span>
                                            {{ $dc->price && $dc->price > 0
                                                ? $dc->currency_type . number_format($dc->price,2)
                                                : 'Free' }}
                                        </span>

                                        @if($dc->old_price && $dc->old_price > 0)
                                            <del>
                                                {{ $dc->currency_type . number_format($dc->old_price,2) }}
                                            </del>
                                        @endif
                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="lmsCourseCard__stats">

                                    <div class="lmsStat">⭐ <span>4.5</span></div>

                                    <div class="lmsStat">
                                        ⏱ <span>
                                            {{ $dc->segments->count() }}
                                            {{ Str::plural('segment', $dc->segments->count()) }}
                                        </span>
                                    </div>

                                    <div class="lmsStat">
                                        📘 <span>
                                            {{ $dc->lessons->count() }}
                                            {{ Str::plural('lesson', $dc->lessons->count()) }}
                                        </span>
                                    </div>

                                </div>

                                <!-- CTA (FIXED BUG) -->
                                <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dc->id)]) }}"
                                class="lmsBtn lmsBtn--primary lmsCourseCard__btn">

                                    View Course

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="lmsEmptyState">
                            <div class="lmsEmptyState__box">
                                <h3>No design courses available</h3>
                                <p>Check back later or explore other categories.</p>
                            </div>
                        </div>

                    @endforelse

                </div>

                <!-- FOOTER -->
                <div class="lmsTabContent__footer">
                    <a href="{{ route('searchCourse') }}" class="lmsBtn lmsBtn--ghost">
                        Browse All Courses
                    </a>
                </div>

            </div>

            <div class="lmsTabContent" data-tab-content="data">

                <div class="lmsCourseGrid">

                    @forelse ($dataCourses as $dac)

                        <div class="lmsCourseCard">

                            <!-- IMAGE -->
                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dac->id)]) }}"
                            class="lmsCourseCard__image">

                                <img src="{{ asset('uploads/courses/'.$dac->image) }}"
                                    alt="{{ $dac->title_en }}">

                            </a>

                            <!-- BODY -->
                            <div class="lmsCourseCard__body">

                                <h3 class="lmsCourseCard__title">
                                    <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dac->id)]) }}">
                                        {{ $dac->title_en }}
                                    </a>
                                </h3>

                                <!-- META -->
                                <div class="lmsCourseCard__meta">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $dac->instructor?->id)) }}"
                                    class="lmsCourseCard__instructor">

                                        <img src="{{ asset('uploads/users/'.$dac?->instructor->image) }}"
                                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                        <span>{{ $dac?->instructor->name_en ?? 'Unknown Instructor' }}</span>

                                    </a>

                                    <div class="lmsCourseCard__price">
                                        <span>
                                            {{ $dac->price && $dac->price > 0
                                                ? $dac->currency_type . number_format($dac->price,2)
                                                : 'Free' }}
                                        </span>

                                        @if($dac->old_price && $dac->old_price > 0)
                                            <del>
                                                {{ $dac->currency_type . number_format($dac->old_price,2) }}
                                            </del>
                                        @endif
                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="lmsCourseCard__stats">

                                    <div class="lmsStat">⭐ <span>4.5</span></div>

                                    <div class="lmsStat">
                                        ⏱ <span>
                                            {{ $dac->segments->count() }}
                                            {{ Str::plural('segment', $dac->segments->count()) }}
                                        </span>
                                    </div>

                                    <div class="lmsStat">
                                        📘 <span>
                                            {{ $dac->lessons->count() }}
                                            {{ Str::plural('lesson', $dac->lessons->count()) }}
                                        </span>
                                    </div>

                                </div>

                                <!-- CTA (FIXED BUG) -->
                                <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dac->id)]) }}"
                                class="lmsBtn lmsBtn--primary lmsCourseCard__btn">

                                    View Course

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="lmsEmptyState">
                            <div class="lmsEmptyState__box">
                                <h3>No data science courses available</h3>
                                <p>Try exploring other categories or check back later.</p>
                            </div>
                        </div>

                    @endforelse

                </div>

                <!-- FOOTER -->
                <div class="lmsTabContent__footer">
                    <a href="{{ route('searchCourse') }}" class="lmsBtn lmsBtn--ghost">
                        Browse All Courses
                    </a>
                </div>

            </div>

            <div class="lmsTabContent" data-tab-content="sales">

                <div class="lmsCourseGrid">

                    @forelse ($salesCourses as $sc)

                        <div class="lmsCourseCard">

                            <!-- IMAGE -->
                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $sc->id)]) }}"
                            class="lmsCourseCard__image">

                                <img src="{{ asset('uploads/courses/'.$sc->image) }}"
                                    alt="{{ $sc->title_en }}">

                            </a>

                            <!-- BODY -->
                            <div class="lmsCourseCard__body">

                                <h3 class="lmsCourseCard__title">
                                    <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $sc->id)]) }}">
                                        {{ $sc->title_en }}
                                    </a>
                                </h3>

                                <!-- META -->
                                <div class="lmsCourseCard__meta">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $sc->instructor?->id)) }}"
                                    class="lmsCourseCard__instructor">

                                        <img src="{{ asset('uploads/users/'.$sc?->instructor->image) }}"
                                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                        <span>{{ $sc?->instructor->name_en ?? 'Unknown Instructor' }}</span>

                                    </a>

                                    <div class="lmsCourseCard__price">
                                        <span>
                                            {{ $sc->price && $sc->price > 0
                                                ? $sc->currency_type . number_format($sc->price,2)
                                                : 'Free' }}
                                        </span>

                                        @if($sc->old_price && $sc->old_price > 0)
                                            <del>
                                                {{ $sc->currency_type . number_format($sc->old_price,2) }}
                                            </del>
                                        @endif
                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="lmsCourseCard__stats">

                                    <div class="lmsStat">⭐ <span>4.5</span></div>

                                    <div class="lmsStat">
                                        ⏱ <span>
                                            {{ $sc->segments->count() }}
                                            {{ Str::plural('segment', $sc->segments->count()) }}
                                        </span>
                                    </div>

                                    <div class="lmsStat">
                                        📘 <span>
                                            {{ $sc->lessons->count() }}
                                            {{ Str::plural('lesson', $sc->lessons->count()) }}
                                        </span>
                                    </div>

                                </div>

                                <!-- CTA (FIXED BUG) -->
                                <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $sc->id)]) }}"
                                class="lmsBtn lmsBtn--primary lmsCourseCard__btn">

                                    View Course

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="lmsEmptyState">
                            <div class="lmsEmptyState__box">
                                <h3>No sales & marketing courses available</h3>
                                <p>Explore other categories or check back later.</p>
                            </div>
                        </div>

                    @endforelse

                </div>

                <!-- FOOTER -->
                <div class="lmsTabContent__footer">
                    <a href="{{ route('searchCourse') }}" class="lmsBtn lmsBtn--ghost">
                        Browse All Courses
                    </a>
                </div>

            </div>

            <div class="lmsTabContent" data-tab-content="dev">

                <div class="lmsCourseGrid">

                    @forelse ($developmentCourses as $dv)

                        <div class="lmsCourseCard">

                            <!-- IMAGE -->
                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dv->id)]) }}"
                            class="lmsCourseCard__image">

                                <img src="{{ asset('uploads/courses/'.$dv->image) }}"
                                    alt="{{ $dv->title_en }}">

                            </a>

                            <!-- BODY -->
                            <div class="lmsCourseCard__body">

                                <h3 class="lmsCourseCard__title">
                                    <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dv->id)]) }}">
                                        {{ $dv->title_en }}
                                    </a>
                                </h3>

                                <!-- META -->
                                <div class="lmsCourseCard__meta">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $dv->instructor?->id)) }}"
                                    class="lmsCourseCard__instructor">

                                        <img src="{{ asset('uploads/users/'.$dv?->instructor->image) }}"
                                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                        <span>{{ $dv?->instructor->name_en ?? 'Unknown Instructor' }}</span>

                                    </a>

                                    <div class="lmsCourseCard__price">
                                        <span>
                                            {{ $dv->price && $dv->price > 0
                                                ? $dv->currency_type . number_format($dv->price,2)
                                                : 'Free' }}
                                        </span>

                                        @if($dv->old_price && $dv->old_price > 0)
                                            <del>
                                                {{ $dv->currency_type . number_format($dv->old_price,2) }}
                                            </del>
                                        @endif
                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="lmsCourseCard__stats">

                                    <div class="lmsStat">⭐ <span>4.5</span></div>

                                    <div class="lmsStat">
                                        ⏱ <span>
                                            {{ $dv->segments->count() }}
                                            {{ Str::plural('segment', $dv->segments->count()) }}
                                        </span>
                                    </div>

                                    <div class="lmsStat">
                                        📘 <span>
                                            {{ $dv->lessons->count() }}
                                            {{ Str::plural('lesson', $dv->lessons->count()) }}
                                        </span>
                                    </div>

                                </div>

                                <!-- CTA (FIXED BUG HERE) -->
                                <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $dv->id)]) }}"
                                class="lmsBtn lmsBtn--primary lmsCourseCard__btn">

                                    View Course

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="lmsEmptyState">
                            <div class="lmsEmptyState__box">
                                <h3>No programming courses available</h3>
                                <p>Try exploring other categories or check back later.</p>
                            </div>
                        </div>

                    @endforelse

                </div>

                <!-- FOOTER -->
                <div class="lmsTabContent__footer">
                    <a href="{{ route('searchCourse') }}" class="lmsBtn lmsBtn--ghost">
                        Browse All Courses
                    </a>
                </div>

            </div>
            <div class="lmsTabContent" data-tab-content="business">

                <div class="lmsCourseGrid">

                    @forelse ($businessCourses as $bc)

                        <div class="lmsCourseCard">

                            <!-- IMAGE -->
                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $bc->id)]) }}"
                            class="lmsCourseCard__image">

                                <img src="{{ asset('uploads/courses/'.$bc->image) }}"
                                    alt="{{ $bc->title_en }}">

                            </a>

                            <!-- BODY -->
                            <div class="lmsCourseCard__body">

                                <h3 class="lmsCourseCard__title">
                                    <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $bc->id)]) }}">
                                        {{ $bc->title_en }}
                                    </a>
                                </h3>

                                <!-- META -->
                                <div class="lmsCourseCard__meta">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $bc->instructor?->id)) }}"
                                    class="lmsCourseCard__instructor">

                                        <img src="{{ asset('uploads/users/'.$bc?->instructor->image) }}"
                                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                        <span>{{ $bc?->instructor->name_en ?? 'Unknown Instructor' }}</span>

                                    </a>

                                    <div class="lmsCourseCard__price">
                                        <span>
                                            {{ $bc->price && $bc->price > 0
                                                ? $bc->currency_type . number_format($bc->price,2)
                                                : 'Free' }}
                                        </span>

                                        @if($bc->old_price && $bc->old_price > 0)
                                            <del>
                                                {{ $bc->currency_type . number_format($bc->old_price,2) }}
                                            </del>
                                        @endif
                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="lmsCourseCard__stats">

                                    <div class="lmsStat">⭐ <span>4.5</span></div>

                                    <div class="lmsStat">
                                        ⏱ <span>
                                            {{ $bc->segments->count() }}
                                            {{ Str::plural('segment', $bc->segments->count()) }}
                                        </span>
                                    </div>

                                    <div class="lmsStat">
                                        📘 <span>
                                            {{ $bc->lessons->count() }}
                                            {{ Str::plural('lesson', $bc->lessons->count()) }}
                                        </span>
                                    </div>

                                </div>

                                <!-- CTA (FIXED BUG HERE) -->
                                <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $bc->id)]) }}"
                                class="lmsBtn lmsBtn--primary lmsCourseCard__btn">

                                    View Course

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="lmsEmptyState">
                            <div class="lmsEmptyState__box">
                                <h3>No business courses available</h3>
                                <p>Explore other categories or check back later.</p>
                            </div>
                        </div>

                    @endforelse

                </div>

                <!-- FOOTER -->
                <div class="lmsTabContent__footer">
                    <a href="{{ route('searchCourse') }}" class="lmsBtn lmsBtn--ghost">
                        Browse All Courses
                    </a>
                </div>

            </div>
            <div class="lmsTabContent" data-tab-content="it">

                <div class="lmsCourseGrid">

                    @forelse ($itCourses as $ic)

                        <div class="lmsCourseCard">

                            <!-- IMAGE -->
                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $ic->id)]) }}"
                            class="lmsCourseCard__image">

                                <img src="{{ asset('uploads/courses/'.$ic->image) }}"
                                    alt="{{ $ic->title_en }}">

                            </a>

                            <!-- BODY -->
                            <div class="lmsCourseCard__body">

                                <h3 class="lmsCourseCard__title">
                                    <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $ic->id)]) }}">
                                        {{ $ic->title_en }}
                                    </a>
                                </h3>

                                <!-- META -->
                                <div class="lmsCourseCard__meta">

                                    <a href="{{ route('instructorProfile', encryptor('encrypt', $ic->instructor?->id)) }}"
                                    class="lmsCourseCard__instructor">

                                        <img src="{{ asset('uploads/users/'.$ic?->instructor->image) }}"
                                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">

                                        <span>{{ $ic?->instructor->name_en ?? 'Unknown Instructor' }}</span>

                                    </a>

                                    <div class="lmsCourseCard__price">
                                        <span>
                                            {{ $ic->price && $ic->price > 0
                                                ? $ic->currency_type . number_format($ic->price,2)
                                                : 'Free' }}
                                        </span>

                                        @if($ic->old_price && $ic->old_price > 0)
                                            <del>
                                                {{ $ic->currency_type . number_format($ic->old_price,2) }}
                                            </del>
                                        @endif
                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="lmsCourseCard__stats">

                                    <div class="lmsStat">⭐ <span>4.5</span></div>

                                    <div class="lmsStat">
                                        ⏱ <span>
                                            {{ $ic->segments->count() }}
                                            {{ Str::plural('segment', $ic->segments->count()) }}
                                        </span>
                                    </div>

                                    <div class="lmsStat">
                                        📘 <span>
                                            {{ $ic->lessons->count() }}
                                            {{ Str::plural('lesson', $ic->lessons->count()) }}
                                        </span>
                                    </div>

                                </div>

                                <!-- CTA (FIXED BUG HERE) -->
                                <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $ic->id)]) }}"
                                class="lmsBtn lmsBtn--primary lmsCourseCard__btn">

                                    View Course

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="lmsEmptyState">
                            <div class="lmsEmptyState__box">
                                <h3>No IT & software courses available</h3>
                                <p>Explore other categories or check back later.</p>
                            </div>
                        </div>

                    @endforelse

                </div>

                <!-- FOOTER -->
                <div class="lmsTabContent__footer">
                    <a href="{{ route('searchCourse') }}" class="lmsBtn lmsBtn--ghost">
                        Browse All Courses
                    </a>
                </div>

            </div>
    <div class="featured-popular-courses-shape">
        <img src="{{asset('frontend/dist/images/shape/dots/dots-img-12.png')}}" alt="Shape"
            class="img-fluid dot-06" />
        <img src="{{asset('frontend/dist/images/shape/triangel.png')}}" alt="Shape" class="img-fluid dot-07" />
    </div>
</section>

{{-- Why You need to learn With Kings Digi Hub --}}
<section class="section feature feature--modern section--bg-offwhite-one">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="font-title--md">Why You Need to Learn with Kings Digi Hub</h2>
            <p class="text-muted">
                Everything you need to build real-world digital skills
            </p>
        </div>

        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="featureCard">
                    <div class="featureCard__icon featureCard__icon--green">
                        <!-- svg -->
                        <svg width="32" height="28" viewBox="0 0 32 28" fill="none">
                            <path d="M2 2H10.4C11.8852 2 13.3096 2.5619 14.3598 3.5621C15.41 4.56229 16 5.91885 16 7.33333V26C16 24.9391 15.5575 23.9217 14.7699 23.1716C13.9822 22.4214 12.9139 22 11.8 22H2V2Z"
                                stroke="currentColor" stroke-width="2.5"/>
                            <path d="M30 2H21.6C20.1148 2 18.6904 2.5619 17.6402 3.5621C16.59 4.56229 16 5.91885 16 7.33333V26C16 24.9391 16.4425 23.9217 17.2302 23.1716C18.0178 22.4214 19.0861 22 20.2 22H30V2Z"
                                stroke="currentColor" stroke-width="2.5"/>
                        </svg>
                    </div>

                    <h5>Affordable yet Enriched</h5>
                    <p>
                        Quality education should be accessible to everyone. Learn valuable skills without financial stress.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="featureCard">
                    <div class="featureCard__icon featureCard__icon--blue">
                        <!-- svg -->
                        <svg width="28" height="27" viewBox="0 0 28 27" fill="none">
                            <path d="M19.3855 12.224C21.8743 12.224 23.8915 10.2067 23.8915 7.71794"
                                stroke="currentColor" stroke-width="2.5"/>
                            <path d="M10.5993 13.7349C7.27274 13.7349 4.60767 11.0684 4.60767 7.74188"
                                stroke="currentColor" stroke-width="2.5"/>
                        </svg>
                    </div>

                    <h5>Expert Instructors</h5>
                    <p>
                        Learn from experienced professionals who guide you step-by-step through real-world skills.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="featureCard">
                    <div class="featureCard__icon featureCard__icon--red">
                        <!-- svg -->
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none">
                            <path d="M25.2502 13.2495C25.2502 19.8774 19.8781 25.2495 13.2502 25.2495"
                                stroke="currentColor" stroke-width="2.5"/>
                            <path d="M17.7021 17.0667L12.8113 14.1491V7.86108"
                                stroke="currentColor" stroke-width="2.5"/>
                        </svg>
                    </div>

                    <h5>Lifetime Access</h5>
                    <p>
                        Revisit courses anytime and continue learning at your own pace, forever.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!--  Learning Rules Starts Here -->
<section class="section learningSteps section--bg-white">
    <div class="container">

        <div class="row align-items-center g-5">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6 order-2 order-lg-0">

                <div class="learningSteps__content">

                    <h2 class="font-title--md mb-4">
                        Kings Digi Hub Simple <br class="d-none d-md-block">
                        Learning Steps
                    </h2>

                    <div class="learningSteps__list">

                        <div class="stepItem">
                            <div class="stepItem__num">01</div>
                            <div class="stepItem__body">
                                <h6>Create Your Learning Space</h6>
                                <p>Set up a personalized learning environment that fits your style and goals.</p>
                            </div>
                        </div>

                        <div class="stepItem">
                            <div class="stepItem__num">02</div>
                            <div class="stepItem__body">
                                <h6>Find the Right Course</h6>
                                <p>Use smart filters to discover courses that match your skill level and interest.</p>
                            </div>
                        </div>

                        <div class="stepItem">
                            <div class="stepItem__num">03</div>
                            <div class="stepItem__body">
                                <h6>Master Your Skills</h6>
                                <p>Learn step-by-step and gain real-world expertise in your chosen field.</p>
                            </div>
                        </div>

                    </div>

                    <a href="{{ route('searchCourse') }}" class="button button-lg button--primary mt-4">
                        Start Learning
                    </a>

                </div>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="col-lg-6 order-1 order-lg-0">
                <div class="learningSteps__image">
                    <img src="{{ asset('frontend/dist/images/hero/hero-img-03.png') }}"
                         class="img-fluid rounded-4" alt="learning">

                    <div class="floatingShape shape1"></div>
                    <div class="floatingShape shape2"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Best Instructors Starts Here -->
<!-- <section class="section best-instructor-featured overflow-hidden main-instructor-featured bg-offwhite">
    <div class="container">

        <div class="row align-items-center mb-5">

            <div class="col-md-8">
                <h3 class="font-title--md mb-1">
                    Meet Our Best Instructors
                </h3>

                <p class="text-muted mb-0">
                    Learn from industry experts with years of practical experience.
                </p>
            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('searchInstructor') }}" class="instructor-view-all">
                    View All
                    <span>→</span>
                </a>
            </div>

        </div>

        <div class="row g-4 justify-content-center">

            @forelse ($instructor->take(4) as $i)
                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="instructor-card-modern">

                        <div class="instructor-img-wrapper">
                            <img src="{{ asset('uploads/users/'.$i->image) }}" alt="Instructor" />

                            <ul class="instructor-social">
                                @if(!empty($i->social_facebook))
                                    <li><a href="{{ $i->social_facebook }}">F</a></li>
                                @endif

                                @if(!empty($i->social_instagram))
                                    <li><a href="{{ $i->social_instagram }}">I</a></li>
                                @endif

                                @if(!empty($i->social_linkedin))
                                    <li><a href="{{ $i->social_linkedin }}">L</a></li>
                                @endif

                                @if(!empty($i->social_twitter))
                                    <li><a href="{{ $i->social_twitter }}">T</a></li>
                                @endif

                                @if(!empty($i->social_youtube))
                                    <li><a href="{{ $i->social_youtube }}">Y</a></li>
                                @endif
                            </ul>
                        </div>

                        <div class="instructor-info">
                            <h5>
                                <a href="{{ route('instructorProfile', encryptor('encrypt', $i->id)) }}">
                                    {{ $i->name_en }}
                                </a>
                            </h5>
                            <p>{{ $i->designation }}</p>
                        </div>

                        <div class="instructor-action">
                            <a href="{{ route('instructorProfile', encryptor('encrypt', $i->id)) }}"
                               class="button button-sm button--primary w-100">
                                View Profile
                            </a>
                        </div>

                    </div>

                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No instructors available at the moment.</p>
                </div>
            @endforelse

        </div>        

    </div>
</section> -->

<!--  Latest Events Featured Starts Here -->
<!-- <section class="section section--bg-offwhite-three latest-events-featured main-events-featured">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="font-title--md">Latest Events</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 position-relative px-0 mx-0">
                <div class="eventsSlider">
                    @forelse ($event as $c)
                    <div class="contentCard contentCard--event contentCard--space">
                        <div class="contentCard-top">
                            <a href="#"><img src="{{asset('uploads/events/'.$c->image)}}" alt="images"
                                    class="img-fluid" /></a>
                        </div>
                        <div class="contentCard-bottom">
                            <h5>
                                <a href="{{route('courseDetails', encryptor('encrypt', $c->id))}}"
                                    class="font-title--card">{{$c->title}}</a>
                            </h5>
                            <div class="contentCard-more">
                                <div class="d-flex align-items-center">
                                    <div class="icon">
                                        <img src="{{asset('frontend/dist/images/icon/location.png')}}"
                                            alt="location" />
                                    </div>
                                    <span>{{$c->location}}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="icon">
                                        <img src="{{asset('frontend/dist/images/icon/calendar.png')}}"
                                            alt="calendar" />
                                    </div>
                                    <span>{{ \Carbon\Carbon::parse($c->date)->format('j F, Y, l') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    @empty
                    <p>No event available</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="{{route('searchCourse')}}" class="button button-lg button--primary mt-lg-5 mt-5">Browse all
                            events</a>
                    </div>
        </div>
    </div>
    <div class="main-events-featured-shape">
        <img src="{{asset('frontend/dist/images/shape/triangel3.png')}}" alt="shape" class="img-fluid shape01" />
    </div>
</section> -->

<!--  Main Become Instructor Starts Here -->
<section class="section main-become-instructor">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-become-instructor-item me-12">
                    <div class="main-image">
                        <img src="{{asset('frontend/dist/images/event/image03.png')}}" alt="image"
                            class="img-fluid" />
                    </div>
                    <div class="main-text">
                        <h6 class="font-title--sm">Become an Instructor</h6>
                        <p>
                        Share your expertise and passion by joining us as an instructor at Kings Digital Literacy Hub. Inspire the next generation of learners, create engaging courses, 
                        and make a meaningful impact in the digital education space!
                        </p>
                        <div class="text-center">
                            <a href="{{route('instructorSubscription')}}" class="green-btn">Apply as Instructor</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="main-become-instructor-item ms-12 mb-0">
                    <div class="main-image">
                        <img src="{{asset('frontend/dist/images/event/image04.png')}}" alt="image"
                            class="img-fluid" />
                    </div>
                    <div class="main-text">
                        <h6 class="font-title--sm">Use Kings Digi Hub For Business</h6>
                        <p>
                        Leverage Kings Digi Hub to enhance your business's digital skills and strategies. Our tailored programs provide the training needed to optimize operations, improve online presence, and drive growth. 
                        Empower your team and stay competitive in today’s digital landscape!
                        </p>
                        <div class="text-center">
                            <a href="#" class="green-btn">Get Kings Digi Hub For Business</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-become-instructor-shape">
        <img src="{{asset('frontend/dist/images/shape/line03.png')}}" alt="shape" class="img-fluid" />
    </div>
</section>

<!--  About Services Starts Here -->
<section class="testimonial-modern-section">
    <div class="container">

        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="testimonial-modern-title">
                    What Our Students Say
                </h2>
                <p class="testimonial-modern-subtitle">
                    Real feedback from learners using Kings Digi Hub
                </p>
            </div>
        </div>

        <div class="testimonial-marquee">
            <div class="testimonial-track">

                <!-- 1 -->
                <div class="testimonial-card">
                    <p>“The courses are very practical. I got my first freelance job after completing the web development track.”</p>
                    <div class="testimonial-footer">
                        <div class="user">
                            <img src="{{ asset('frontend/dist/images/avatar/blank.png') }}">
                            <div>
                                <h6>Michael A.</h6>
                                <span>Web Dev Student</span>
                            </div>
                        </div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>

                <!-- 2 -->
                <div class="testimonial-card">
                    <p>“Very clear lessons. I love how simple the UI is and how easy it is to follow each course.”</p>
                    <div class="testimonial-footer">
                        <div class="user">
                            <img src="{{ asset('frontend/dist/images/avatar/blank.png') }}">
                            <div>
                                <h6>Sarah K.</h6>
                                <span>Design Student</span>
                            </div>
                        </div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>

                <!-- 3 -->
                <div class="testimonial-card">
                    <p>“Affordable and powerful platform. The instructors really know what they are doing.”</p>
                    <div class="testimonial-footer">
                        <div class="user">
                            <img src="{{ asset('frontend/dist/images/avatar/blank.png') }}">
                            <div>
                                <h6>John D.</h6>
                                <span>Data Science</span>
                            </div>
                        </div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>

                <!-- 4 -->
                <div class="testimonial-card">
                    <p>“I like the lifetime access. I can always come back to revise my lessons anytime.”</p>
                    <div class="testimonial-footer">
                        <div class="user">
                            <img src="{{ asset('frontend/dist/images/avatar/blank.png') }}">
                            <div>
                                <h6>Grace E.</h6>
                                <span>Marketing Student</span>
                            </div>
                        </div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>

                <!-- 5 -->
                <div class="testimonial-card">
                    <p>“Best learning experience I’ve had online. The structure is very beginner friendly.”</p>
                    <div class="testimonial-footer">
                        <div class="user">
                            <img src="{{ asset('frontend/dist/images/avatar/blank.png') }}">
                            <div>
                                <h6>Daniel T.</h6>
                                <span>IT Student</span>
                            </div>
                        </div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- News Letter Starts Here -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-card">

            <!-- Decorative shapes -->
            <span class="newsletter-shape shape-1"></span>
            <span class="newsletter-shape shape-2"></span>

            <div class="row align-items-center">

                <div class="col-lg-6">
                    <div class="newsletter-content">

                        <span class="newsletter-badge">
                            🚀 Join 10,000+ Learners
                        </span>

                        <h2>
                            Subscribe to Our Newsletter
                        </h2>

                        <p>
                            Stay updated with the latest courses, tech trends,
                            career tips, and exclusive offers from
                            <strong>Kings Digi Hub.</strong>
                            Be the first to know about new learning opportunities.
                        </p>

                    </div>
                </div>

                <div class="col-lg-6">

                    <form action="{{route('mail-subscribe')}}" method="POST" class="newsletter-form">
                        @csrf

                        <div class="newsletter-input-group">

                            <div class="newsletter-input">
                                <i class="fas fa-envelope"></i>

                                <input
                                    type="email"
                                    name="email"
                                    placeholder="Enter your email address"
                                    required>
                            </div>

                            <button type="submit" class="newsletter-btn">
                                Subscribe
                            </button>

                        </div>

                        <small class="newsletter-note">
                            No spam. Unsubscribe anytime.
                        </small>

                    </form>

                </div>

            </div>

        </div>
    </div>
</section>

<button class="cat-fab" id="openCategoryDrawer">
    ☰ Course Categories
</button>
<button class="back-to-top" id="backToTopBtn" title="Back to top">
    ↑
</button>

<div class="cat-drawer" id="categoryDrawer">
    <div class="cat-drawer__overlay" id="closeCategoryDrawer"></div>

    <div class="cat-drawer__panel">
        <div class="cat-drawer__header">
            <h4>Browse Categories</h4>
            <button class="cat-drawer__close" id="closeCategoryBtn">&times;</button>
        </div>

        <div class="cat-drawer__body">
            @forelse($category as $cat)
                @php
                    $courseCount = $cat->course()->where('status', 2)->count();
                @endphp

                <a href="{{ route('courseName', ['courseCategory' => $cat->category_name]) }}"
                   class="cat-item">
                    <img src="{{ asset('uploads/courseCategories/'.$cat->category_image) }}" alt="">
                    <div>
                        <p class="title">{{ $cat->category_name }}</p>
                        <span>{{ $courseCount }} Courses</span>
                    </div>
                </a>
            @empty
                <p class="empty">No categories available</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    function drop() {
                    const dropBox = document.querySelector(".categoryDrop");
                    const arrow = document.querySelector(".select-button button svg");
                    arrow.classList.toggle("appear");
                    dropBox.classList.toggle("appear");
                }
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const tabs = document.querySelectorAll(".lmsTab");
    const contents = document.querySelectorAll(".lmsTabContent");

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {

            const target = this.getAttribute("data-tab");

            // remove active from all tabs
            tabs.forEach(t => t.classList.remove("is-active"));

            // activate clicked tab
            this.classList.add("is-active");

            // hide all content
            contents.forEach(content => {
                content.classList.remove("is-active");
            });

            // show matching content
            const activeContent = document.querySelector(
                `[data-tab-content="${target}"]`
            );

            if (activeContent) {
                activeContent.classList.add("is-active");
            }

        });
    });

});
</script>

@endpush