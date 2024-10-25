<div class="admin-sidebar h-100 overflow-hidden bg-white h-100">
    <div class="d-flex flex-column justify-content-between h-100">
        <div class="d-flex align-items-center">
            <div
                class="admin-user-box radius7 bg-224598 tk-basic-sans fw-normal font22 leading24 space-0_22 text-white d-flex align-items-center justify-content-center me-2">
                {{ ucfirst(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="tk-basic-sans fw-normal font12 leading14 space-0_12 text-black">{{ Auth::user()->name }}</div>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div>
            <a href="" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 active">
                <div class="me-2 ms-3 admin-menu-icon d-flex">
                    <img src="{{ asset('images/home.svg') }}" class="w-100" alt="">
                </div>
                <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Dashboard</div>
            </a>
            <a href="" class="text-decoration-none d-flex align-items-center admin-menu dmb-10">
                <div class="me-2 ms-3 admin-menu-icon d-flex">
                    <img src="{{ asset('images/file.svg') }}" class="w-100" alt="">
                </div>
                <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">File manager</div>
            </a>
            <a href="" class="text-decoration-none d-flex align-items-center admin-menu dmb-10">
                <div class="me-2 ms-3 admin-menu-icon d-flex">
                    <img src="{{ asset('images/document.svg') }}" class="w-100" alt="">
                </div>
                <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Documents</div>
            </a>
            <a href="" class="text-decoration-none d-flex align-items-center admin-menu dmb-10">
                <div class="me-2 ms-3 admin-menu-icon d-flex">
                    <img src="{{ asset('images/user-icon.svg') }}" class="w-100" alt="">
                </div>
                <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Users & Permissions</div>
            </a>
            <a href="" class="text-decoration-none d-flex align-items-center admin-menu dmb-10">
                <div class="me-2 ms-3 admin-menu-icon d-flex">
                    <img src="{{ asset('images/star.svg') }}" class="w-100" alt="">
                </div>
                <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Upgrade your plan</div>
            </a>
        </div>
        <div class="d-flex align-items-center">
            <div class="tk-basic-sans fw-normal font12 leading14 space-0_12 text-808080 opacity60 me-1">Powered by
            </div>
            <div class="dashboard-logo">
                <img src="{{ asset('images/logo.svg') }}" class="w-100" alt="">
            </div>
        </div>
    </div>
</div>
