@extends('layouts.app')

    @section('content')
    <main>
        <section class="admin bg-F5F5F5 h-vh">
            <div class="d-flex flex-wrap h-100">
                <div class="admin-wrapper">
                    <div class="container-fluid h-100">
                        <div class="ps-5 h-100 d-flex flex-column">
                            <div
                                class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-40">
                                <div class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
                                    <a href="#" class="text-808080 d-inline-block text-decoration-none">
                                        Dashboard /
                                    </a>
                                    <a href="#" class="text-black d-inline-block text-decoration-none">
                                        Clients
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
                            <div class="d-flex flex-column h-100 justify-content-between">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between dmb-35 pe-3">
                                        <div class="title d-flex align-items-center">
                                            <div
                                                class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                                <img src="images/favicon.svg" alt="">
                                            </div>
                                            <div
                                                class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                                Documents
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
                                                <th scope="col" colspan="3">Owner</th>
                                                <th scope="col">Shared with</th>
                                                <th scope="col">Last Modified</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="tables pe-3">
                                        <table class="table common-table document-table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">
                                                        Jason Bourne
                                                    </td>
                                                    <td>3 Users</td>
                                                    <td>13/05/2024</td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            <!-- enable btn -->
                                                            <a href="{{ route('documents.show') }}"
                                                                class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                                                            <!-- disable btn -->
                                                            <!-- <a href=""
                                                        class="text-decoration-none bg-DEDEDE tk-basic-sans font14 leading14 space-0_14 text-808080 py-2 px-4 radius5">View</a> -->
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

    @endsection

</html>
