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
                    <a href="#" class="fs-6 text-secondary">Subscription</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- Breadcrumb Ends Here -->

<!-- About Feature Starts Here -->
<section class="section aboutFeature pb-0">
    <div class="container">
        <form action="" method="POST">
            <table width="30%" align="center">
            <tr>
                <td>
                <div>
                    <label for="duration">Select Duration:</label>
                    <select id="duration" class="form-control" onchange="calculateTotalAmount()">
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
            <div class="col-lg-6 my-3"> <!-- my-3 adds margin to both top and bottom -->
                <div class="about-feature">
                    <h5 class="font-title--sm">{{$s->name}}</h5>
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
                            <i class="fas fa-certificate text-danger"></i> &nbsp;
                            @if($s->certificate == 1) Certificate of Completion @else No Certificate of Completion @endif
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
                        @if($s->student_upload > 50)
                        <li class="list-group-item">
                            <i class="fas fa-hands-helping text-info"></i>&nbsp; Free setup assistance for first-time users
                        </li>
                        @endif
                    </ul>                    
                    <br>
                    @if($s->amount > 0)
                        <h5 class="font-title--sm" style="color:blue;">
                            <strong id="finalAmount_{{$s->id}}">₦{{ number_format($s->amount, 2) }}</strong>
                            <small style="color:red; font-size: 50%;">
                                (<span id="durationText_{{$s->id}}">1 Month</span>) saves <i><strong id="savings_{{$s->id}}">₦0.00</strong></i>
                            </small>
                        </h5>
                    @else
                        <h5 class="font-title--sm" style="color:blue;">Free</h5>
                    @endif
                    <br>
                    @if($s->student_upload >= 2000)
                    <a href="#" class="button button-lg button--dark w-100">Contact Sales</a>
                    @else
                    <a href="{{route('instructorRegister')}}" class="button button-lg button--dark w-100">Get started</a>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>
<!-- About Feature Ends Here -->
 <section>
    <br>
    <br>
 </section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function calculateTotalAmount() {
    // Get the selected duration value from the dropdown
    const durationDropdown = document.getElementById('duration');
    const selectedDuration = parseInt(durationDropdown.value);

    // Define the discount rates based on the duration
    const discountRates = { 1: 0, 3: 0.02, 6: 0.05, 12: 0.1 }; // Discount rates per duration

    // Loop through all the plans and update the corresponding values
    @foreach($subPlan as $s)
        // Use unique IDs for each plan to avoid conflicts
        const baseAmount = {{ $s->amount }}; // Base amount from Laravel
        const discountRate = discountRates[selectedDuration] || 0;

        // Calculate the total amount after applying the discount
        const totalAmount = baseAmount * selectedDuration * (1 - discountRate);
        const savedAmount = baseAmount * selectedDuration * discountRate;

        // Update the UI for this specific plan by targeting the unique IDs
        document.getElementById('finalAmount_{{$s->id}}').innerText = `₦${totalAmount.toFixed(2)}`;
        document.getElementById('savings_{{$s->id}}').innerText = `₦${savedAmount.toFixed(2)}`;
        document.getElementById('durationText_{{$s->id}}').innerText = `${selectedDuration} ${selectedDuration > 1 ? 'Months' : 'Month'}`;
    @endforeach
}

</script>
