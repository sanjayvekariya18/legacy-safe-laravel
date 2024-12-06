<div class="admin-sidebar h-100 overflow-hidden bg-white h-100">
    <div class="d-flex flex-column justify-content-between h-100">
        <div class="d-flex align-items-center">
            <div class="admin-user-box radius7 bg-224598 tk-basic-sans fw-normal font22 leading24 space-0_22 text-white d-flex align-items-center justify-content-center me-2">
                {{ ucfirst(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="tk-basic-sans fw-normal font12 leading14 space-0_12 text-black">{{ Auth::user()->name }}</div>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('dashboard') || Request::is('shared-documents*') ? 'active' : '' }}">
                <div class="me-2 ms-3 admin-menu-icon d-flex">
                    <img src="{{ asset('images/home-icon.svg') }}" class="w-100" alt="">
                </div>
                <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Dashboard</div>
            </a>
            @if (Auth::user()->hasRole(\App\Models\User::ROLE_CLIENT))
                <a href="{{ route('documents.create') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Route::is('documents.create') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/file-maneger.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">File manager</div>
                </a>
            @endif
            @if (Auth::user()->hasRole(\App\Models\User::ROLE_CLIENT))
                <a href="{{ route('documents.index') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Route::is('documents.index') || Route::is('documents.show') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/document.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Documents</div>
                </a>
            @endif
            @if (Auth::user()->hasRole(\App\Models\User::ROLE_PROFESSIONAL))
                <a href="{{ route('clients.index') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('clients*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/user-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Clients</div>
                </a>
            @endif
            @if (Auth::user()->hasRole(\App\Models\User::ROLE_ADMIN))
                <a href="{{ route('users.index') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('users*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/user-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Users</div>
                </a>
            @endif
            @if (Auth::user()->hasRole(\App\Models\User::ROLE_ADMIN) || Auth::user()->hasRole(\App\Models\User::ROLE_PROFESSIONAL))
                <a href="{{ route('invoices.index') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('invoices*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/star-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Invoices</div>
                </a>
            @endif
            @if (Auth::user()->hasRole(\App\Models\User::ROLE_CLIENT))
                <a href="{{ route('shared.users.index') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('shared-users*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/user-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Invited users</div>
                </a>
                <a href="{{ route('subscriptions.index') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('subscribe*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/star-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Upgrade your plan</div>
                </a>
            @endif
            @if (Auth::user()->hasRole(\App\Models\User::ROLE_ADMIN))
                <a href="{{ route('products.index') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('product*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/star-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Products</div>
                </a>
                <a href="{{ route('permissions') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('permissions*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/user-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Role & Permissions</div>
                </a>
                <a href="{{ route('activity.logs') }}" class="text-decoration-none d-flex align-items-center admin-menu dmb-10 {{ Request::is('activity*') ? 'active' : '' }}">
                    <div class="me-2 ms-3 admin-menu-icon d-flex">
                        <img src="{{ asset('images/star-icon.svg') }}" class="w-100" alt="">
                    </div>
                    <div class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black">Activity Logs</div>
                </a>
            @endif
        </div>
        <div class="">
            <a class="dropdown-item tk-basic-sans font16 leading22 text-black dmb-20 d-inline-flex align-items-center" href="javascript:void(0);"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <div class="me-2 ms-3 admin-menu-icon d-inline-block">
                    <img src="{{ asset('images/logout.svg') }}" class="w-100" alt="">
                </div>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <div class="d-flex align-items-center">
                <div class="tk-basic-sans fw-normal font12 leading14 space-0_12 text-808080 opacity-60 me-1">Powered by</div>
                <div class="dashboard-logo">
                    <img src="{{ asset('images/legecy-black-logo.svg') }}" class="w-100" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
