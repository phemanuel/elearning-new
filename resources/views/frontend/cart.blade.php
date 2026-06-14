@extends('frontend.layouts.student-app')
@section('title', 'My Cart')
@section('body-attr')style="background-color: #ebebf2;"@endsection

@section('content')
<!-- Breadcrumb Starts Here -->
<div class="cart-hero">

    <div class="container">

        <div class="cart-hero__content">

            <!-- LEFT -->

            <div class="cart-hero__left">

                <div class="cart-hero__tag">

                    🛒 Shopping Cart

                </div>

                <h1>

                    Continue Your Learning Journey

                </h1>

                <p>

                    Review your selected courses and proceed to checkout to unlock new skills.

                </p>

            </div>


            <!-- RIGHT -->

            <div class="cart-hero__right">

                <a href="{{ route('searchCourse') }}" class="cart-hero__link">

                    Browse More Courses

                    <span>→</span>

                </a>

            </div>

        </div>

    </div>

</div>
<!-- Breadcrumb Ends Here -->

<!-- Cart Section Starts Here -->
<section class="cart-page">

    <div class="container">

        @if(session('cart'))

        <div class="row g-4">

            <!-- LEFT -->

            <div class="col-lg-8">

                <div class="cart-header">

                    <h3>
                        My Cart
                    </h3>

                    <span>
                        {{ count(session('cart', [])) }}
                        Courses
                    </span>

                </div>

                @foreach(session('cart') as $id => $details)

                <div class="lms-cart-card">

                    <!-- IMAGE -->

                    <div class="lms-cart-image">

                        <img
                            src="{{ asset('uploads/courses/'.$details['image']) }}"
                            alt="{{ $details['title_en'] }}">

                    </div>

                    <!-- BODY -->

                    <div class="lms-cart-body">

                        <h4>

                            <a href="{{ route('courseDetails', encryptor('encrypt',$id)) }}">

                                {{ $details['title_en'] }}

                            </a>

                        </h4>

                        <p class="instructor">

                            👨‍🏫 {{ $details['instructor'] }}

                        </p>

                        <div class="price-row">

                            <div>

                                <span class="price">

                                    {{ $details['price']
                                        ? $details['currency_type'].number_format($details['price'],2)
                                        : 'Free'
                                    }}

                                </span>

                                @if($details['old_price'])

                                <span class="old-price">

                                    {{ $details['currency_type'].number_format($details['old_price'],2) }}

                                </span>

                                @endif

                            </div>

                            <button
                                class="remove-btn remove-from-cart"
                                data-id="{{ $id }}">

                                <i class="far fa-trash-alt"></i>

                            </button>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>


            <!-- RIGHT -->

            <div class="col-lg-4">

                <div class="summary-card">

                    <h4>

                        Order Summary

                    </h4>


                    <div class="summary-row">

                        <span>Subtotal</span>

                        <strong>

                            {{ $details['currency_type'] }}

                            {{ number_format(session('cart_details')['cart_total'],2) }}

                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>

                            Coupon Discount

                            ({{ session('cart_details')['discount'] ?? 0 }}%)

                        </span>

                        <strong>

                            {{ $details['currency_type'] }}

                            {{ number_format(session('cart_details')['discount_amount'] ?? 0,2) }}

                        </strong>

                    </div>


                    <div class="summary-total">

                        <span>Total</span>

                        <strong>

                            {{ $details['currency_type'] }}

                            {{ number_format(session('cart_details')['total_amount'],2) }}

                        </strong>

                    </div>


                    <a
                        href="{{ route('checkout') }}"
                        class="checkout-btn">

                        Proceed to Checkout

                    </a>


                    <form
                        action="{{ route('coupon_check') }}"
                        method="POST">

                        @csrf

                        <label>

                            Coupon Code

                        </label>

                        <div class="coupon-box">

                            <input
                                type="text"
                                name="coupon"
                                placeholder="Enter coupon">

                            <button>

                                Apply

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        @else

        <div class="empty-cart">

            <div class="empty-icon">

                🛒

            </div>

            <h2>

                Your Cart is Empty

            </h2>

            <p>

                Discover amazing courses and start learning today.

            </p>

            <!-- <a
                href="{{ route('searchCourse') }}"
                class="browse-btn">

                Browse Courses

            </a> -->

        </div>

        @endif

    </div>

</section>
<!-- Cart Section Ends Here -->
@endsection


@push('scripts')
<script>
    $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{route('remove.from.cart')}}',
                    method: "DELETE",
                    data: {
                        _token: '{{csrf_token()}}',
                        id: ele.data('id') // Use data-id attribute
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
</script>
@endpush