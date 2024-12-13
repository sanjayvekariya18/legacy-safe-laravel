@extends('layouts.app')

    @section('content')

    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">
            <div class="admin-sidebar h-100 overflow-hidden bg-white h-100">

            </div>
            <div class="admin-wrapper">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-95">
                            <div class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
                                <a href="{{ route('subscription.pay') }}" class="text-808080 d-inline-block text-decoration-none">
                                    Dashboard / Upgrade your plan
                                </a>
                                <a href="#" class="text-black d-inline-block text-decoration-none">
                                    / Select this plan
                                </a>
                            </div>
                            <div
                                class="notification-menu radius4 overflow-hidden d-flex align-items-center justify-content-center position-relative">
                                <img src="{{ asset('images/notification.svg') }}" alt="notification icon" class="w-100">
                                <div
                                    class="notification-count position-absolute d-flex align-items-center justify-content-center tk-basic-sans font10 lh-1 fw-light space-0_1 text-white bg-224598 rounded-circle">
                                    0</div>
                            </div>
                        </div>
                        <div class="col-11 pe-4">
                            <div class="row row18">
                                <div class="col-8">
                                    <div class="upgrade-cards radius5 bg-white dpt-35 dpb-30">
                                        <div class="dmb-20 d-flex justify-content-between align-items-center">
                                            <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F">
                                                Upgrade you plan</div>
                                            <div class="">
                                                <img src="{{ asset('images/user.svg') }}" class="upgrade-brand-logo ms-1" alt="user icon">
                                                <img src="{{ asset('images/user.svg') }}" class="upgrade-brand-logo ms-1" alt="user icon">
                                                <img src="{{ asset('images/user.svg') }}" class="upgrade-brand-logo ms-1" alt="user icon">
                                            </div>
                                        </div>
                                        <div
                                            class="tk-basic-sans fw-normal font16 space-0_16 leading24 text-808080 dmb-30 col-9">
                                            You will receive a confirmation of upgrade directly to you email used for
                                            registration
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Card number…"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-10"></input>
                                            <div class="row row8 dmb-10">
                                                <div class="col-8">
                                                    <input type="text" placeholder="Expiration…"
                                                        class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100"></input>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" placeholder="CVC…"
                                                        class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100"></input>
                                                </div>
                                            </div>
                                            <input type="text" placeholder="Postcode…"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-30"></input>
                                            <div class="d-flex align-items-center justify-content-between dmb-35">
                                                <div
                                                    class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">
                                                    Total</div>
                                                <div
                                                    class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F">
                                                    £99<span
                                                        class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span>
                                                </div>
                                            </div>
                                            <button class="btnB blue-btn border-0 radius7 w-100 dmb-15">Purchase this
                                                plan</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="upgrade-cards radius5 bg-white dpt-35 dpb-45">
                                        <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-black dmb-15">Plan name</div>
                                        <div class="tk-basic-sans fw-normal font12 leading22 space-0_22 text-black dmb-30">All the basics of starting a new plan</div>
                                        <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">What’s included:</div>
                                        <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20"><img src="{{ asset('images/down-arrow.svg') }}" class="correct-arrow mt-2 me-2" alt="down-arrow icon">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>
                                        <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start"><img src="{{ asset('images/down-arrow.svg') }}" class="correct-arrow mt-2 me-2" alt="down-arrow icon">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

@endsection
