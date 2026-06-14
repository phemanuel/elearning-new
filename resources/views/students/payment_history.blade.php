@extends('frontend.layouts.student-app')
@section('title', 'My Payments')
@section('body-attr')style="background-color: #ebebf2;"@endsection

@section('content')

<div class="pay-page">

    <!-- HEADER -->

    <div class="pay-header">

        <div>

            <span class="pay-tag">

                💳 Payment History

            </span>

            <h1>

                Your Purchases

            </h1>

            <p>

                Track all your course purchases and payment transactions.

            </p>

        </div>

    </div>


    <!-- SUMMARY -->

    <div class="pay-summary">

        <div class="pay-card pay-card-primary">

            <small>Total Payments</small>

            <h2>

                {{ $totalPayments }}

            </h2>

        </div>


        <div class="pay-card pay-card-green">

            <small>Total Amount Spent</small>

            <h2>

                ₦{{ number_format($totalSpent,2) }}

            </h2>

        </div>


        <div class="pay-card pay-card-purple">

            <small>Latest Purchase</small>

            <h2>

                {{ $latestPurchase ? $latestPurchase->format('d M, Y') : '-' }}

            </h2>

        </div>

    </div>


    <!-- PAYMENT HISTORY -->

    <div class="payment-list">

        @forelse($payments as $item)

        <div class="payment-item">

            <div class="payment-course">

                <img
                    src="{{ asset('uploads/courses/'.$item->course->image) }}"
                    alt="">

                <div>

                    <h4>

                        {{ $item->course->title_en }}

                    </h4>

                    <p>

                        👨‍🏫

                        {{ $item->instructor->name_en ?? 'Instructor' }}

                    </p>

                </div>

            </div>


            <div class="payment-meta">

                <div>

                    <small>Transaction ID</small>

                    <strong>

                        {{ $item->txnid }}

                    </strong>

                </div>


                <div>

                    <small>Amount</small>

                    <strong>

                        ₦{{ number_format($item->amount,2) }}

                    </strong>

                </div>


                <div>

                    <small>Status</small>

                    @if($item->status == 1)

                        <span class="status success">

                            ✓ Successful

                        </span>

                    @elseif($item->status == 0)

                        <span class="status pending">

                            ⏳ Pending

                        </span>

                    @else

                        <span class="status failed">

                            ✕ Failed

                        </span>

                    @endif

                </div>


                <div>

                    <small>Date</small>

                    <strong>

                        {{ $item->created_at->format('d M Y') }}

                    </strong>

                </div>

            </div>

        </div>

        @empty

        <div class="empty-pay">

            <div class="empty-icon">

                💳

            </div>

            <h3>

                No Payments Yet

            </h3>

            <p>

                Your course purchases will appear here.

            </p>

        </div>

        @endforelse

    </div>

</div>

@endsection