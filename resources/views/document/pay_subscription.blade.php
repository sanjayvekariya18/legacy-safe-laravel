@extends('layouts.app')

@section('content')
    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">
            <div class="admin-wrapper">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div class="col-11 pe-4">
                            <div class="row row18">
                                <div class="col-8">
                                    <div class="upgrade-cards radius5 bg-white dpt-35 dpb-30">
                                        <div class="dmb-20 d-flex justify-content-between align-items-center">
                                            <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F">
                                                Upgrade you plan</div>
                                            <div class="">
                                                <img src="{{ asset('images/user.svg') }}" class="upgrade-brand-logo ms-1"
                                                    alt="user icon">
                                                <img src="{{ asset('images/user.svg') }}" class="upgrade-brand-logo ms-1"
                                                    alt="user icon">
                                                <img src="{{ asset('images/user.svg') }}" class="upgrade-brand-logo ms-1"
                                                    alt="user icon">
                                            </div>
                                        </div>
                                        <div
                                            class="tk-basic-sans fw-normal font16 space-0_16 leading24 text-808080 dmb-30 col-9">
                                            You will receive a confirmation of upgrade directly to you email used for
                                            registration
                                        </div>
                                        <div>
                                            <from>
                                                <input type="text" placeholder="Card number…" name="card_number"
                                                    id="card_number"
                                                    class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-10"></input>
                                                <div class="row row8 dmb-10">

                                                    <div class="col-8">
                                                        <input type="text" placeholder="Expiration…" name="expiration"
                                                            id="expiration"
                                                            class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100"></input>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" placeholder="CVC…" name="cvc"
                                                            id="cvc"
                                                            class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100"></input>
                                                    </div>
                                                </div>
                                                <input type="text" placeholder="Postcode…" name="postcode"
                                                    class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-30"></input>
                                                <div class="d-flex align-items-center justify-content-between dmb-35">
                                                    <div
                                                        class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">
                                                        Total</div>
                                                    <div
                                                        class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F">
                                                        ₹{{ $yearlyPrice }}<spassn
                                                            class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">
                                                            </span>
                                                    </div>
                                                </div>
                                                <button class="btnB blue-btn border-0 radius7 w-100 dmb-15">Purchase this
                                                    plan</button>
                                            </from>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="upgrade-cards radius5 bg-white dpt-35 dpb-45">
                                        <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-black dmb-15">
                                            {{ $plans->name }}</div>
                                        <div class="tk-basic-sans fw-normal font12 leading22 space-0_22 text-black dmb-30">
                                            All the basics of starting a new plan</div>
                                        <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">
                                            What’s included:</div>
                                        <div
                                            class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                                            <img src="{{ asset('images/down-arrow.svg') }}" class="correct-arrow mt-2 me-2"
                                                alt="down-arrow icon">{{ $plans->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
