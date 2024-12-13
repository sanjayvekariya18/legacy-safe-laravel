@extends('layouts.app')

@section('content')
<main>
    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">

            <div class="admin-wrapper h-100 overflow-auto">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-40">
                            <div class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
                                <a href="#" class="text-808080 d-inline-block text-decoration-none">
                                    Dashboard / Documents /
                                </a>
                                <a href="#" class="text-black d-inline-block text-decoration-none">
                                    Document Name
                                </a>
                            </div>
                            <div class="d-flex align-items-center">
                                <div
                                    class="bg-224598 tk-basic-sans font14 leading22 space-0_14 text-white fw-normal px-3 py-1 radius5 d-flex align-items-center ms-4">
                                    <div class="star-icon d-inline-flex me-2">
                                        <img src="images/fill-star.svg" alt="" class="h-100">
                                    </div>
                                    Allow full access
                                </div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#notificationModal"
                                    class="notification-menu radius4 overflow-hidden d-flex align-items-center justify-content-center position-relative ms-4">
                                    <img src="images/notification.svg" alt="" class="w-100">
                                    <div
                                        class="notification-count position-absolute d-flex align-items-center justify-content-center tk-basic-sans font10 lh-1 fw-light space-0_1 text-white bg-224598 rounded-circle">
                                        0</div>
                                </a>
                            </div>
                        </div>
                        <div class="pe-3">
                            <div class="d-flex align-items-end justify-content-between dmb-45">
                                <div class="title dmb-5">
                                    <div class="d-inline-flex align-items-center">
                                        <div
                                            class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                            <img src="images/document.svg" alt="">
                                        </div>
                                        <div
                                            class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                            Document Name
                                        </div>
                                    </div>
                                    <div class="ps-5 ms-3">
                                        <a href=""
                                            class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal text-capitalize me-4">View
                                            File</a>
                                        <a href=""
                                            class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal text-capitalize me-4">Remove
                                            File</a>
                                    </div>
                                </div>
                                <div class="col-6 ps-5 d-flex justify-content-between">
                                    <div class="">
                                        <div
                                            class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                                            Owner
                                        </div>
                                        <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                            Jason Bourne
                                        </div>
                                    </div>
                                    <div class="">
                                        <div
                                            class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                                            Shared with
                                        </div>
                                        <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                            3 Users
                                        </div>
                                    </div>
                                    <div class="">
                                        <div
                                            class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                                            Last Modified
                                        </div>
                                        <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                            13/05/2024
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-section bg-white radius7 dmb-45">
                                <div class="accordion-item">
                                    <div
                                        class="accordion-header d-flex justify-content-between cursor-pointer px-4 py-3">
                                        <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                            Ready to send the file for approval?
                                        </div>
                                        <div class="accordion-header-btn transition">
                                            <a href=""
                                                class="ready-view-btn tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal ms-3">
                                                View/Edit the recipients
                                            </a>
                                            <a href="#"
                                                class="notify-btn text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 ms-3">Notify
                                                professional</a>
                                        </div>
                                        <div class="close-arrow bg-224598 overflow-hidden rounded-circle">
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <img src="assets/images/white-close.svg" class="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-content dpt-60 px-4">
                                        <table class="table common-table ready-table">
                                            <thead>
                                                <tr>
                                                    <th>Message</th>
                                                    <th>Company</th>
                                                    <th>Permissions</th>
                                                    <th>To be notified</th>
                                                    <th>File Visibility</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>Company Name here</td>
                                                    <td>User</td>
                                                    <td>
                                                        <div
                                                            class="d-inline-flex align-items-center position-relative switch-container">
                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                Yes
                                                            </div>
                                                            <input type="radio" name="toggle"
                                                                class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">
                                                            <input type="radio" name="toggle"
                                                                class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2">
                                                            <label class="switch me-2 transition"></label>
                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                No
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-between">
                                                            <div
                                                                class="d-inline-flex align-items-center position-relative switch-container">
                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    Yes
                                                                </div>
                                                                <input type="radio" name="toggle"
                                                                    class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">
                                                                <input type="radio" name="toggle"
                                                                    class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2">
                                                                <label class="switch me-2 transition"></label>
                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    No
                                                                </div>
                                                            </div>
                                                            <a href="" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#userModal"
                                                                class="text-decoration-none d-inline-flex text-decoration-none"><img
                                                                    src="assets/images/three-dot-menu.svg"
                                                                    class="three-dot" alt=""></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>Company Name here</td>
                                                    <td>User</td>
                                                    <td>
                                                        <div
                                                            class="d-inline-flex align-items-center position-relative switch-container">
                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                Yes
                                                            </div>
                                                            <input type="radio" name="toggle"
                                                                class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">
                                                            <input type="radio" name="toggle"
                                                                class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2">
                                                            <label class="switch me-2 transition"></label>
                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                No
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-between">
                                                            <div
                                                                class="d-inline-flex align-items-center position-relative switch-container">
                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    Yes
                                                                </div>
                                                                <input type="radio" name="toggle"
                                                                    class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">
                                                                <input type="radio" name="toggle"
                                                                    class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2">
                                                                <label class="switch me-2 transition"></label>
                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    No
                                                                </div>
                                                            </div>
                                                            <a href="" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#userModal"
                                                                class="text-decoration-none d-inline-flex text-decoration-none"><img
                                                                    src="assets/images/three-dot-menu.svg"
                                                                    class="three-dot" alt=""></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>Company Name here</td>
                                                    <td>User</td>
                                                    <td>
                                                        <div
                                                            class="d-inline-flex align-items-center position-relative switch-container">
                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                Yes
                                                            </div>
                                                            <input type="radio" name="toggle"
                                                                class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">
                                                            <input type="radio" name="toggle"
                                                                class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2">
                                                            <label class="switch me-2 transition"></label>
                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                No
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-between">
                                                            <div
                                                                class="d-inline-flex align-items-center position-relative switch-container">
                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    Yes
                                                                </div>
                                                                <input type="radio" name="toggle"
                                                                    class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">
                                                                <input type="radio" name="toggle"
                                                                    class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2">
                                                                <label class="switch me-2 transition"></label>
                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    No
                                                                </div>
                                                            </div>
                                                            <a href="" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#userModal"
                                                                class="text-decoration-none d-inline-flex text-decoration-none"><img
                                                                    src="assets/images/three-dot-menu.svg"
                                                                    class="three-dot" alt=""></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="title dmb-20">
                                <div class="d-inline-flex align-items-center">
                                    <div
                                        class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                        <img src="images/mail.svg" alt="">
                                    </div>
                                    <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                        Message area
                                    </div>
                                </div>
                            </div>
                            <div class="message-area bg-white radius7 dpt-30 dpb-45 dmb-25">
                                <div class="d-flex dmb-20">
                                    <div
                                        class="col-10 tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal">
                                        Message
                                    </div>
                                    <div
                                        class="col-2 tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal">
                                        Submitted
                                    </div>
                                </div>
                                <div class="d-inline-flex dmb-45">
                                    <div class="col-10">
                                        <div class="col-11 pe-4">
                                            <div class="d-inline-flex">
                                                <div
                                                    class="alphbet-icon bg-224598 tk-basic-sans font16 leading22 space-0_16 text-white text-uppercase fw-normal d-inline-flex align-items-center justify-content-center rounded-circle">
                                                    J
                                                </div>
                                                <div>
                                                    <div
                                                        class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal dmb-15">
                                                        Jack - Account holder
                                                    </div>
                                                    <div
                                                        class="tk-basic-sans font16 leading22 space-0_16 text-808080 fw-normal">
                                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                                        diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                                        aliquyam erat, sed diam voluptua. At vero eos et accusam et
                                                        justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 tk-basic-sans font12 leading22 space-0_12 text-black fw-normal">
                                        13/05/2024
                                    </div>
                                </div>
                                <div class="d-inline-flex dmb-45">
                                    <div class="col-10">
                                        <div class="col-11 pe-4">
                                            <div class="d-inline-flex">
                                                <div
                                                    class="alphbet-icon bg-224598 tk-basic-sans font16 leading22 space-0_16 text-white text-uppercase fw-normal d-inline-flex align-items-center justify-content-center rounded-circle">
                                                    P
                                                </div>
                                                <div>
                                                    <div
                                                        class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal dmb-15">
                                                        Peter - Professional
                                                    </div>
                                                    <div
                                                        class="tk-basic-sans font16 leading22 space-0_16 text-808080 fw-normal">
                                                        Sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                                                        labore et dolore magna aliquyam erat, sed diam voluptua. At
                                                        vero eos et accusam et justo duo dolores et ea rebum.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 tk-basic-sans font12 leading22 space-0_12 text-black fw-normal">
                                        13/05/2024
                                    </div>
                                </div>
                                <div class="textarea-input">
                                    <textarea name="" id="" placeholder="Write your message…"
                                        class="tk-basic-sans font16 leading22 space-0_16 text-808080 fw-normal w-100 radius5 px-3 py-3 dmb-20"></textarea>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="message-files">
                                            <span
                                                class="tk-basic-sans font13 leading22 space-0_13 text-black fw-normal me-3">
                                                Select a file to upload
                                            </span>
                                            <button
                                                class="bg-transparent tk-basic-sans font12 leading22 space-0_12 text-black fw-normal px-4 position-relative">
                                                Browse files
                                                <input type="file" name="" id=""
                                                    class="position-absolute start-0 w-100 h-100 top-0 opacity-0">
                                            </button>
                                        </div>
                                        <div>
                                            <a href=""
                                                class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white dpt-10 dpb-10 px-4 radius5 ms-3">
                                                Submit message
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between dpb-65">
                                <a href=""
                                    class="back-all text-decoration-none tk-basic-sans font13 leading22 space-0_13 text-black fw-normal d-inline-flex align-items-center">
                                    <div
                                        class="text-black d-flex align-items-center justify-content-center radius4 me-2">
                                        <img src="assets/images/left.svg" alt="">
                                    </div>
                                    Back to all
                                </a>
                                <a href=""
                                    class="text-decoration-none large-btn blue-btn tk-basic-sans font16 leading22 space-0_16 fw-normal d-inline-flex align-items-center justify-content-center px-5 radius7">
                                    <img src="assets/images/plus-circle.svg" alt="" class="me-2">
                                    Invite new user
                                </a>
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
                    <img src="assets/images/white-close.svg" alt="" />
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

<div class="modal fade user-modal" id="userModal" tabindex="-1" role="dialog" aria-bs-labelledby="userModalLabel"
    aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content radius4">
            <ul class="list-none ps-0 mb-0">
                <li class="dmb-15">
                    <a href=""
                        class="d-inline-block text-decoration-none tk-basic-sans font14 leading22 space-0_14 text-black fw-normal">View
                        User</a>
                </li>
                <li class="dmb-15">
                    <a href="#remove-user" data-bs-toggle="modal" data-bs-target="#remove-user"
                        class="d-inline-block text-decoration-none tk-basic-sans font14 leading22 space-0_14 text-black fw-normal">
                        Remove User</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>

@endsection

</html>
