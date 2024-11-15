@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="d-flex align-items-center justify-content-between dmb-35 pe-3">
        <div class="title d-flex align-items-center">
            <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/document.svg') }}" alt="">
            </div>
            <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                Users & Permissions
            </div>
        </div>
        <div class="col-5 ps-3">
            <div class="position-relative w-100">
                <form action="{{ route('users.index') }}" method="GET" class="d-flex mb-3">
                    <input name="search" value="{{ request()->get('search') }}" type="text"
                        placeholder="Who are you looking for?.."
                        class="input white-b-input height-50 w-100 tk-basic-sans font16 leading19 pe-5">
                    <div class="position-absolute h-100 top-0 end-0 d-flex align-items-center justify-content-end pe-2">
                        <button type="submit" class="bg-224598 search-icon radius4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/search-icon.svg') }}" alt="">
                        </button>
                    </div>
                </form>
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
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->company_name }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="me-3">
                                    {{ implode(',', $user->getRoleNames()->toArray()) }}
                                </span>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                        class="text-decoration-none border-0 bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                                    <a href="#remove-user-modal" data-user-id="{{ $user->id }}"
                                        data-user-name="{{ $user->name }}" data-bs-toggle="modal"
                                        data-bs-target="#remove-user-modal"
                                        class="delete-icon ms-3 d-inline-flex delete-user">
                                        <img src="{{ asset('images/delete-icon.svg') }}" alt="" class="h-100">
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex align-items-center justify-content-between dmb-50 pe-3">
        <div class="pagination d-flex align-items-center">
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
        <div>
            <a href="{{ route('users.create') }}"
                class="text-decoration-none large-btn blue-btn tk-basic-sans font16 leading22 space-0_16 fw-normal d-inline-flex align-items-center justify-content-center px-5 radius7">
                <img src="{{ asset('images/plus-circle.svg') }}" alt="" class="me-2">
                Create new user
            </a>
        </div>
    </div>
    <!-- remove-user-modal -->
    <div class="modal remove-user-modal fade" id="remove-user-modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="remove-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content position-relative border-0 radius4 bg-white justify-content-lg-center justify-content-start">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/white-close.svg') }}" alt="" />
                    </button>
                </div>
                <div class="">
                    <div class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25 col-8 mx-auto">
                        Are you sure you want to remove <span id="user-name"></span>
                    </div>
                    <div class="d-flex align-items-center row6">
                        <div class="col-6">
                            <!-- Confirm Delete Button -->
                            <form id="delete-user-form" action="" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="large-btn blue-btn2 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition">Yes,
                                    remove</button>
                            </form>

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
                        <img src="{{ asset('images/white-close.svg') }}" alt="" />
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
                                    id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
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
                                        <select id="js-select4" class="d-none" data-placeholder="Select an option">
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
                                    <input type="email" name="" placeholder="Email…"
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
@endsection
@push('page-specific-scripts')
    <script type="module">
        // When a delete button is clicked
        $('.delete-user').on('click', function(event) {
            // Prevent the default action
            event.preventDefault();

            // Get the user data from the button's data attributes
            var userId = $(this).data('user-id');
            var userName = $(this).data('user-name');

            // Update the modal content with the user's name
            $('#user-name').text(userName);

            // Update the form's action with the correct delete URL
            var route = '{{ route('users.soft-delete', ':id') }}'.replace(':id',
            userId); // Update the URL for the user deletion

            $('#delete-user-form').attr('action', route);
        });

        // Assuming you have a modal with id #myModal
        $('#remove-user').on('show.bs.modal', function(event) {
            // Code to execute before modal opens
            var button = $(event.relatedTarget); // Button that triggered the modal

            var role = button.data('user'); // Assuming data-user attribute on the button

            // Set the new heading
            $(this).find('.modal-content .text-center .tk-basic-sans').text(role);
        });
    </script>
@endpush
