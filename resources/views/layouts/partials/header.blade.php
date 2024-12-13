<div class="admin-menu-bar d-flex align-items-center justify-content-between dpt-25 dpb-40">
    <div class="breadcrumb-menu tk-basic-sans font12 leading14 space-0_12 fw-normal">
        <a href="{{ route('dashboard') }}" class="text-808080 d-inline-block text-decoration-none">
            Dashboard /
        </a>
        <a href="{{ route('document.index') }}" class="text-black d-inline-block text-decoration-none">
            Documents
        </a>
    </div>
    <a href="#" data-bs-toggle="modal" data-bs-target="#notificationModal"
        class="notification-menu radius4 overflow-hidden d-flex align-items-center justify-content-center position-relative">
        <img src="{{ asset('images/notification.svg') }}" alt="notification show" class="w-100">
        <div
            class="notification-count position-absolute d-flex align-items-center justify-content-center tk-basic-sans font10 lh-1 fw-light space-0_1 text-white bg-224598 rounded-circle">
                <div class="modal-title">{{ auth()->user()->unreadNotifications->count() }}</div>
        </div>
    </a>
</div>


<!-- Notifications Modal -->
<div class="modal fade notification-modal" id="notificationModal" tabindex="-1" role="dialog"
     aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <ul class="list-none ps-0 mb-0" id="notificationList">
                    @foreach (auth()->user()->notifications as $notification)
                        <li class="bg-blue-300 p-3 m-2">
                            {{ $notification->data['message'] }}
                            <small class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@push('page-specific-scripts')
<script>

    @if(auth()->user()->unreadNotifications->count() > 0)
        {{-- $(document).ready(function() {
            $('#notificationModal').modal('show');
        }); --}}
    @endif

    {{-- document.addEventListener("DOMContentLoaded", function () {
        @if(auth()->user()->unreadNotifications->count() > 0)
            $('#notificationModal').modal('show');

            setTimeout(function () {
                $('#notificationCount').fadeOut(500, function () {
                    $(this).remove();
                });
            }, 2000);
        @endif


        const notifications = document.querySelectorAll(".notification-item");
        notifications.forEach((notification) => {
            setTimeout(() => {
                notification.style.transition = "opacity 0.5s";
                notification.style.opacity = "0";
                setTimeout(() => notification.remove(), 500);
            }, 2000);
        });
    }); --}}
</script>
@endpush

