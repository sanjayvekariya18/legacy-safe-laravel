@extends('layouts.app')
    @section('content')
    <main>
        <section class="admin bg-F5F5F5 h-vh">
            <div class="d-flex flex-wrap h-100">

                <div class="admin-wrapper h-100 overflow-auto">
                    <div class="container-fluid h-100">
                        <div class="ps-5 h-100 d-flex flex-column">
                            <div class="h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <div
                                        class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-40">
                                        <div
                                            class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
                                            <a href="#" class="text-808080 d-inline-block text-decoration-none">
                                                Dashboard /
                                            </a>
                                            <a href="#" class="text-black d-inline-block text-decoration-none">
                                                Users & Permissions
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
                                    <div class="d-flex align-items-center justify-content-between dmb-35 pe-3">
                                        <div class="title d-flex align-items-center">
                                            <div
                                                class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                                <img src="images/document.svg" alt="">
                                            </div>
                                            <div
                                                class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                                Users & Permissions
                                            </div>
                                        </div>
                                        <div class="col-5 ps-3">
                                            <div class="position-relative w-100">
                                                <input type="text" placeholder="Who are you looking for?.."
                                                    class="input white-b-input height-50 w-100 tk-basic-sans font16 leading19 pe-5">
                                                <div
                                                    class="position-absolute h-100 top-0 end-0 d-flex align-items-center justify-content-end pe-2">
                                                    <div
                                                        class="bg-224598 search-icon radius4 d-flex align-items-center justify-content-center">
                                                        <img src="images/search-icon.svg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table common-table dmb-5 pe-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Permissions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="tables pe-3 dmb-45">
                                        <table class="table common-table user-table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        John Doe
                                                    </td>
                                                    <td>
                                                        example123.@email.com
                                                    </td>
                                                    <td>
                                                        John Doe Company
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="me-3"> User</span>
                                                            <div class="d-flex align-items-center">
                                                                <button
                                                                    class="border-0 bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</button>
                                                                <a href="#remove-user" data-bs-toggle="modal"
                                                                    data-bs-target="#remove-user"
                                                                    class="delete-icon ms-3 d-inline-flex">
                                                                    <img src="images/delet.svg" alt=""
                                                                        class="h-100">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between dmb-30">
                                    <div class="pagination d-flex align-items-center">
                                        <a href="#"
                                            class="pagination-item text-decoration-none tk-basic-sans font13 leading22 space-0_13 text-808080 fw-normal me-3">
                                            <span class="text-black">
                                                1 - 50</span> of 100</a>
                                        <a href="#"
                                            class="text-decoration-none pagination-arrow  text-black d-flex align-items-center justify-content-center radius4 me-3 prev">
                                            <img src="images/left.svg" alt="">
                                        </a>
                                        <a href="#"
                                            class="text-decoration-none pagination-arrow  text-black d-flex align-items-center justify-content-center radius4 me-3 next">
                                            <img src="images/right.svg" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <a href="invite-user" data-bs-toggle="modal" data-bs-target="#invite-user"
                                            class="text-decoration-none large-btn blue-btn tk-basic-sans font16 leading22 space-0_16 fw-normal d-inline-flex align-items-center justify-content-center px-5 radius7">
                                            <img src="images/plus-circle.svg" alt="" class="me-2">
                                            Invite new user
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- remove-user-modal -->
    <div class="modal remove-user-modal fade" id="remove-user" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="remove-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content position-relative border-0 radius4 bg-white justify-content-lg-center justify-content-start">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="images/white-close.svg" alt="" />
                    </button>
                </div>
                <div class="">
                    <div
                        class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25 col-9 px-2 mx-auto">
                        Are you sure you want to remove John Doe
                    </div>
                    <div class="d-flex align-items-center row6">
                        <div class="col-6">
                            <button
                                class="large-btn blue-btn2 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition">Yes,
                                remove</button>
                        </div>
                        <div class="col-6">
                            <button
                                class="large-btn btn-808080 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition"
                                data-bs-dismiss="modal" aria-label="Close">No, keep user</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- invite-user-modal -->
    <div class="modal invite-user-modal fade" id="invite-user" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="invite-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content position-relative border-0 radius4 bg-white justify-content-lg-center justify-content-start">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="assets/images/white-close.svg" alt="" />
                    </button>
                </div>
                <div class="">
                    <div class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25">
                        Invite a user
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <ul class="nav nav-tabs create-account-tabs bg-EBEBEB border-0 d-inline-flex align-items-center radius5 overflow-hidden px-1 dmb-15"
                            id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link active tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                                    id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                                    aria-controls="home" aria-selected="true">
                                    I’m a customer
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                                    id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                    role="tab" aria-controls="profile" aria-selected="false">
                                    I’m a professional
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade w-100 show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="d-flex w-100 justify-content-center">
                                <div class="w-100 d-flex justify-content-center">
                                    <input type="email" name="" placeholder="Email…"
                                        class="input white-b-input tk-basic-sans font16 leading19 bg-white w-100">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade w-100" id="profile">
                            <div class="d-flex justify-content-center row8">
                                <div class="col-6">
                                    <div class="user-select d-inline-flex w-100">
                                        <select class="js-select4 d-none" data-placeholder="Select an option">
                                            <option></option>
                                            <option value="Solicitor">Solicitor
                                            </option>
                                            <option value="Financial Adviser">Financial Adviser
                                            </option>
                                            <option value="Accountant">Accountant
                                            </option>
                                            <option value="Executor">Executor
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <input type="email" name="email" placeholder="Email…"
                                        class="input white-b-input tk-basic-sans font16 leading19 bg-white w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center dmt-20">
                        <button
                            class="large-btn blue-btn2 w-248 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

    @endsection


</html>
