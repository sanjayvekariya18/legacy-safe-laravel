<div>
    <a href="#" wire:click="markAllAsRead" data-bs-toggle="modal" data-bs-target="#notificationModal"
        class="notification-menu radius4 overflow-hidden d-flex align-items-center justify-content-center position-relative">
        <img src="{{ asset('images/bell-icon.svg') }}" alt="" class="w-100">
        @if ($unreadCount > 0)
            <div
                class="notification-count position-absolute d-flex align-items-center justify-content-center tk-basic-sans font10 lh-1 fw-light space-0_1 text-white bg-224598 rounded-circle">
                {{ $unreadCount }}
            </div>
        @endif
    </a>
</div>
