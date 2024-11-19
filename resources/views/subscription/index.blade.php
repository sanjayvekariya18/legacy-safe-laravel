@extends('layouts.app')
@section('title', 'Subscription')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="col-11 pe-2">
        <div class="d-flex justify-content-between align-items-center dmb-75">
            <div class="title d-flex align-items-center">
                <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/star-icon.svg') }}" alt="">
                </div>
                <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                    Upgrade your plan
                </div>
            </div>

            <ul class="nav nav-tabs create-account-tabs bg-EBEBEB border-0 d-inline-flex align-items-center radius5 overflow-hidden px-1"
                id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link active tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                        id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                        aria-controls="home" aria-selected="true">
                        Monthly billing
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                        id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                        aria-controls="profile" aria-selected="false">
                        Yearly billing
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row row18">

                    @foreach ($products as $product)
                        <div class="col-4">
                            <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">
                                    {{ $product->name }}
                                </div>
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">
                                    {{ $product->title }}</div>
                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">
                                    £{{ $product->monthly_price }}<span
                                        class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span>
                                </div>
                                @if ($subscriptionItem && $product->stripe_product_id == $subscriptionItem->stripe_product && $product->stripe_price_id_monthly == $subscriptionItem->stripe_price)
                                <button class="btnB DEDEDE-bg-btn border-0 radius7 w-100 dmb-15">Plan
                                    Selected</button>
                                @else
                                    <a href="{{ route('subscriptions.card', ['product' => $product, 'interval' => 'monthly']) }}"
                                        class="text-decoration-none large-btn blue-btn d-inline-flex align-items-center justify-content-center radius7 w-100 dmb-15">
                                        Select this plan
                                    </a>
                                @endif
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">
                                    What’s included:</div>
                                <div
                                    class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                                    <img src="{{ asset('images/true-icon.svg') }}" class="correct-arrow mt-2 me-2"
                                        alt="">{{ $product->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row row18">
                    @foreach ($products as $product)
                        <div class="col-4">
                            <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">
                                    {{ $product->name }}</div>
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">
                                    {{ $product->title }}</div>
                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">
                                    £{{ $product->yearly_price }}<span
                                        class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span>
                                </div>
                                @if ($subscriptionItem && $product->stripe_product_id == $subscriptionItem->stripe_product && $product->stripe_price_id_yearly == $subscriptionItem->stripe_price)
                                <button class="btnB DEDEDE-bg-btn border-0 radius7 w-100 dmb-15">Plan
                                    Selected</button>
                                @else
                                    <a href="{{ route('subscriptions.card', ['product' => $product, 'interval' => 'yearly']) }}"
                                        class="text-decoration-none large-btn blue-btn d-inline-flex align-items-center justify-content-center radius7 w-100 dmb-15">
                                        Select this plan
                                    </a>
                                @endif
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">
                                    What’s included:</div>
                                <div
                                    class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                                    <img src="{{ asset('images/true-icon.svg') }}" class="correct-arrow mt-2 me-2"
                                        alt="">{{ $product->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
