@extends('frontend.layouts.app')
@section('title', 'Subscription')
@section('header-attr') class="nav-shadow" @endsection

@section('content')
<!-- Breadcrumb Starts Here -->
<div class="py-0">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}" class="fs-6 text-secondary">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#" class="fs-6 text-secondary">Subscription Plans</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb Ends Here -->

<!-- About Feature Starts Here -->
<!-- About Feature Starts Here -->
<section class="section aboutFeature pb-0">
    <div class="container">
        <form action="" method="POST">
            <table width="30%" align="center">
            <tr>
                <td>
                <div>
                    <label for="duration">Select Duration(Months):</label>
                    <select id="no_of_months" class="form-control" onchange="calculateTotalAmountForAllPlans()">
                        <option value="1">1 Month</option>
                        <option value="3">3 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">12 Months</option>
                    </select>
                </div>
                </td>
            </tr>
        </table>
        </form>
        
        <div class="row">
        @foreach($subPlan as $s)
        <div class="col-lg-6 my-3 plan-container" data-plan-id="{{ $s->id }}" data-amount="{{ $s->amount }}"> 
            <div class="about-feature">
                <h5 class="font-title--sm"><i class="{{$s->icon}}"></i> {{$s->name}}</h5>
            <div class="scrollable-list-container">
                <ul class="list-group text-left mt-3">
                    <li class="list-group-item">
                        <i class="fas fa-upload text-primary"></i> &nbsp;
                        {{ $s->course_upload >= 50 ? 'Unlimited' : $s->course_upload }} Courses Upload
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-users text-success"></i> &nbsp;
                        {{ $s->student_upload >= 2000 ? 'Unlimited' : $s->student_upload }} Students On-board
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-hdd text-info"></i> &nbsp;
                        {{ $s->allocated_space >= 50 ? 'Unlimited Storage for materials' : $s->allocated_space . 'GB storage for materials' }}
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-percentage text-warning"></i> &nbsp;
                        {{$s->transaction_fee}}% Transaction Fee on Each Course Sales
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-edit text-secondary"></i> &nbsp;
                        @if($s->enrollment == 1) Manual Enrollment @else No Manual Enrollment @endif
                    </li>
                    <li class="list-group-item">
                        @if($s->name == 'ENTERPRISE')
                        <i class="fas fa-certificate text-danger"></i> &nbsp;
                        @if($s->certificate == 1) Branded certificates for students @else No Certificate of Completion @endif
                        @else 
                        <i class="fas fa-certificate text-danger"></i> &nbsp;
                        @if($s->certificate == 1) Certificate of Completion @else No Certificate of Completion @endif
                        @endif
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-clock text-dark"></i> &nbsp;
                        @if($s->extra_day == 0) No Extra Day @else {{$s->extra_day}} Extra Day/s Bonus @endif
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-arrows-alt text-primary"></i>&nbsp; Drag & Drop Course Builder
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-question-circle text-success"></i> &nbsp;Quiz & Assessment Builder
                    </li>
                    @if($s->name == 'STARTER')
                    <li class="list-group-item">
                        <i class="fas fa-chart-line text-primary"></i> &nbsp;Basic analytics (track student progress)
                    </li>
                    @endif

                    @if($s->name == 'GROWTH')
                    <li class="list-group-item">
                        <i class="fas fa-chart-bar text-info"></i> &nbsp;Advanced analytics (completion rates, detailed reports)
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-lightbulb text-warning"></i> &nbsp;Marketing strategy consultation with our marketing team (1 session every 2 months)
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-percent text-success"></i> &nbsp;5% discount on Kings Digital Literacy Hub's paid ads for your courses
                    </li>
                    @endif

                    @if($s->name == 'PREMIUM')
                    <li class="list-group-item">
                        <i class="fas fa-code text-danger"></i> &nbsp;Public API access
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-headset text-primary"></i> &nbsp;Priority customer support (24/7 live chat and phone support)
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-paint-brush text-info"></i> &nbsp;Free course page customization (branded course pages)
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-lightbulb text-warning"></i> &nbsp;Marketing strategy consultation with our marketing team (1 session per month)
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-percent text-success"></i> &nbsp;10% discount on Kings Digital Literacy Hub's paid ads for your courses
                    </li>
                    @endif

                    @if($s->name == 'ENTERPRISE')
                    <li class="list-group-item">
                        <i class="fas fa-database text-dark"></i> &nbsp;Advanced analytics + full API access
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-ban text-secondary"></i> &nbsp;Removable branding
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-user-tie text-primary"></i> &nbsp;Dedicated account manager
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-lightbulb text-warning"></i> &nbsp;Monthly marketing strategy consultations with our marketing team
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-bullseye text-info"></i> &nbsp;Marketing strategy consultation for promoting a specific course (tailored campaigns)
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-percent text-success"></i> &nbsp;20% discount on Kings Digital Literacy Hub's paid ads for your courses
                    </li>
                    @endif

                    @if($s->student_upload > 50)
                    <li class="list-group-item">
                        <i class="fas fa-hands-helping text-info"></i>&nbsp; Free setup assistance for first-time users
                    </li>
                    @endif
                </ul> 
            </div>                   
                <br>
                @if($s->amount > 0 && $s->amount < 50000)
                    <h5 class="font-title--sm" style="color:blue;">
                        <strong class="finalAmount">₦{{ number_format($s->amount, 2) }}</strong>
                        <small style="color:red; font-size: 50%;">
                            (<span class="durationText">1 Month</span>) saves <i><strong class="savings">₦0.00</strong></i>
                        </small>
                    </h5>
                @elseif($s->amount == 0)
                    <h5 class="font-title--sm" style="color:blue;">Free</h5>
                @endif
                <br>
                @if($s->course_upload >=50)
                <a href="{{route('contact-sales')}}" class="button button-lg button--dark w-100">Contact Sales</a>
                @else
                <a href="{{route('instructorRegister', encryptor('encrypt', $s->id))}}" class="button button-lg button--dark w-100">Get started</a>
                @endif
            </div>
        </div>
        @endforeach

        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function calculateTotalAmountForAllPlans() {
    const noOfMonths = parseInt(document.getElementById('no_of_months')?.value || 1);

    // Loop through all plans
    document.querySelectorAll('.plan-container').forEach(planElement => {
        const amountPerMonth = parseFloat(planElement.getAttribute('data-amount')) || 0;

        // Calculate total amount and discount
        let totalAmount = amountPerMonth * noOfMonths;
        let discountRate = 0;

        if (noOfMonths === 3) discountRate = 0.02; // 2% discount for 3 months
        if (noOfMonths === 6) discountRate = 0.05; // 5% discount for 6 months
        if (noOfMonths === 12) discountRate = 0.10; // 10% discount for 12 months

        const discountAmount = totalAmount * discountRate;
        const finalAmount = totalAmount - discountAmount;

        // Update the total amount displayed
        const finalAmountElement = planElement.querySelector('.finalAmount');
        if (finalAmountElement) {
            finalAmountElement.textContent = `₦${finalAmount.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }

        // Update the savings displayed
        const savingsElement = planElement.querySelector('.savings');
        if (savingsElement) {
            savingsElement.textContent = `₦${discountAmount.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }

        // Update the duration text
        const durationTextElement = planElement.querySelector('.durationText');
        if (durationTextElement) {
            const durationText = `${noOfMonths} ${noOfMonths > 1 ? 'Months' : 'Month'}`;
            durationTextElement.textContent = durationText;
        }
    });
}

// Initialize calculation on page load and on dropdown change
document.addEventListener('DOMContentLoaded', calculateTotalAmountForAllPlans);
document.getElementById('no_of_months').addEventListener('change', calculateTotalAmountForAllPlans);

</script>
@endpush
