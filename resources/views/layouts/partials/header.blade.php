<div class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-40">
    <div class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
        <a href="#" class="text-808080 d-inline-block text-decoration-none">
            Dashboard /
        </a>
        <a href="#" class="text-black d-inline-block text-decoration-none">
            Documents
        </a>
    </div>
    <a href="#" data-bs-toggle="modal" data-bs-target="#notificationModal"
        class="notification-menu radius4 overflow-hidden d-flex align-items-center justify-content-center position-relative">
        <img src="{{ asset('images/notification.svg') }}" alt="" class="w-100">
        <div
            class="notification-count position-absolute d-flex align-items-center justify-content-center tk-basic-sans font10 lh-1 fw-light space-0_1 text-white bg-224598 rounded-circle">
            0</div>
    </a>
</div>
<div class="modal fade notification-modal" id="notificationModal" tabindex="-1" role="dialog"
    aria-bs-labelledby="notificationModalLabel" aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="tk-basic-sans font12 leading22 space-0_12 text-808080 fw-normal dmb-20">
                Notifications
            </div>
            <ul class="list-none ps-0 mb-0">
                <li class="tk-basic-sans font14 leading22 space-0_14 text-black fw-normal dmb-30">
                    Added you as a user to document name
                </li>
                <li class="tk-basic-sans font14 leading22 space-0_14 text-black fw-normal dmb-30">
                    Uploaded document name for approval
                </li>
                <li class="tk-basic-sans font14 leading22 space-0_14 text-black fw-normal dmb-30">
                    Submitted a message to document name
                </li>
                <li class="tk-basic-sans font14 leading22 space-0_14 text-black fw-normal dmb-30">
                    Uploaded document name for approval
                </li>
            </ul>
        </div>
    </div>
</div>
