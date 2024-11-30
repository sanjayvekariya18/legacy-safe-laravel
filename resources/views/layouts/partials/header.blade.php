<div class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-40">
    <div class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item">
                        @if ($breadcrumb['url'])
                            <a class="text-808080 d-inline-block text-decoration-none"
                                href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                        @else
                            {{ $breadcrumb['title'] }}
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
    @livewire('notifications')
</div>
<div class="modal fade notification-modal" id="notificationModal" tabindex="-1" role="dialog"
    aria-bs-labelledby="notificationModalLabel" aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="tk-basic-sans font12 leading22 space-0_12 text-808080 fw-normal dmb-20">
                Notifications
            </div>
            <ul class="list-none ps-0 mb-0">
                @forelse (auth()->user()->unreadNotifications as $notification)
                    <li class="tk-basic-sans font14 leading22 space-0_14 text-black fw-normal dmb-30">
                        {{ $notification->data['message'] }}
                    </li>
                @empty
                    <li>
                        <a href="#" class="dropdown-item">No new notifications</a>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
