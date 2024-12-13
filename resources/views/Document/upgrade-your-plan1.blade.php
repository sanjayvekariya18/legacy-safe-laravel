@extends('layouts.app')

    @section('content')


    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">

            <div class="admin-wrapper">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-40">
                            <div class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
                                <a href="#" class="text-808080 d-inline-block text-decoration-none">
                                    Dashboard /
                                </a>
                                <a href="#" class="text-black d-inline-block text-decoration-none">
                                    Upgrade your plan
                                </a>
                            </div>
                            <div
                                class="notification-menu radius4 overflow-hidden d-flex align-items-center justify-content-center position-relative">
                                <img src="images/notification.svg" alt="" class="w-100">
                                <div
                                    class="notification-count position-absolute d-flex align-items-center justify-content-center tk-basic-sans font10 lh-1 fw-light space-0_1 text-white bg-224598 rounded-circle">
                                    0</div>
                            </div>
                        </div>
                        <div class="col-11 pe-2">
                            <div class="d-flex justify-content-between align-items-center dmb-75">
                                <div class="title d-flex align-items-center">
                                    <div
                                        class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                        <img src="images/star.svg" alt="">
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
                                            id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                            role="tab" aria-controls="home" aria-selected="true">
                                            Monthly billing
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button
                                            class="nav-link tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                                            id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                            role="tab" aria-controls="profile" aria-selected="false">
                                            Yearly billing
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row row18">
                                        <div class="col-4">
                                            <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                                <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">Plan name</div>
                                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">All the basics of starting a new plan</div>
                                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">£99<span class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span></div>
                                               <a href="{{ route('pay-plan') }}"><button class="btnB DEDEDE-bg-btn border-0 radius7 w-100 dmb-15">Plan Selected</button></a>
                                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">What’s included:</div>
                                                <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20"><img src="images/tick.svg" class="correct-arrow mt-2 me-2" alt="">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>
                                        <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start"><img src="images/tick.svg" class="correct-arrow mt-2 me-2" alt="">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                                <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">Plan name</div>
                                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">All the basics of starting a new plan</div>
                                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">£199<span class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span></div>
                                                <button class="btnB blue-btn border-0 radius7 w-100 dmb-15">Select this plan</button>
                                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">What’s included:</div>
                                                <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20"><img src="images/tick.svg" class="correct-arrow mt-2 me-2" alt="">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>
                                        <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start"><img src="images/tick.svg" class="correct-arrow mt-2 me-2" alt="">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                                <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">Plan name</div>
                                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">All the basics of starting a new plan</div>
                                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">£299<span class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span></div>
                                                <button class="btnB blue-btn border-0 radius7 w-100 dmb-15">Select this plan</button>
                                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">What’s included:</div>
                                                <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20"><img src="images/tick.svg" class="correct-arrow mt-2 me-2" alt="">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>
                                        <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start"><img src="images/tick.svg" class="correct-arrow mt-2 me-2" alt="">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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

</html>
