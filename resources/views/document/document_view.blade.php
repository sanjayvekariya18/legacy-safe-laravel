@extends('layouts.app')

@section('content')

    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">

            <div class="admin-wrapper h-100 overflow-auto">
                <div class="container-fluid h-100">
                    <div class="pe-3">
                        <div class="d-flex align-items-end justify-content-between dmb-45">
                            <div class="title dmb-5">
                                <div class="d-inline-flex align-items-center">
                                    <div
                                        class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/document.svg') }}" alt="document icon">
                                    </div>
                                    <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                        <p><strong>Document Name:</strong> {{ $documents->name }}</p>

                                    </div>
                                </div>
                                <div class="ps-5 ms-3">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal text-capitalize me-4">View
                                        File</a>

                                    <a href="javascript:void(0);" data-id="{{ $documents->id }}" data-bs-toggle="modal"
                                        data-bs-target="#removeFileModal"
                                        class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal text-capitalize me-4 remove-file-btn">
                                        Remove File
                                    </a>




                                    <!-- Modal for Removing File -->

                                    <form method="DELETE" action="{{ route('documents.delete', ':id') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" id="user-id" name="id" value="">
                                        <div class="modal fade" id="removeFileModal" tabindex="-1"
                                            aria-labelledby="removeFileModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="removeFileModalLabel">Remove Document
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to remove this document?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                            id="confirmRemoveButton">Yes, Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                            <div class="col-6 ps-5 d-flex justify-content-between">
                                <div class="">
                                    <div
                                        class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                                        Owner
                                    </div>
                                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                        <div>
                                            <td>{{ $documents->User ? $documents->User->name : 'No User' }}</td>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div
                                        class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                                        Shared with
                                    </div>
                                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                        <div>
                                            <p>{{ $documents->SharedWithUser->count() }} users</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div
                                        class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                                        Last Modified
                                    </div>
                                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                        <div>
                                            <p>{{ $documents->updated_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-section bg-white radius7 dmb-45">
                            <div class="accordion-item">
                                <div class="accordion-header d-flex justify-content-between px-4 py-3">
                                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                                        Ready to send the file for approval?
                                    </div>
                                    <div class="accordion-header-btn transition">
                                        <a href="javascript:void(0);" onclick="toggleDivVisibility()"
                                            class="ready-view-btn tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal ms-3">
                                            View/Edit the recipients
                                        </a>



                                        <div id="notification-message"></div>

                                        <a href="javascript:void(0)"
                                            class="notify-btn text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 ms-3">
                                            Notify professional
                                        </a>
                                    </div>
                                    <div class="close-arrow bg-224598 overflow-hidden rounded-circle cursor-pointer"
                                        id="closeContent" onclick="toggleDivVisibility()">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <img src="{{ asset('images/white-close.svg') }}" class="Close Icon"
                                                alt="Close Icon ">
                                        </div>
                                    </div>
                                </div>

                                <div id="accordion-content" class="accordion-content dpt-60 px-4" style="display: none;">
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

                                            @if ($usersPermission->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">No Intvited User Not Found Please
                                                        New User Invitation Link Created</td>
                                                </tr>
                                            @else
<<<<<<< Updated upstream
                                                @foreach ($usersPermission as $permission)
                                                    <form method="POST" id="form"
                                                        action="{{ route('document.update', $permission->id) }}"
                                                        data-id="{{ $permission->id }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <tr>
                                                            <td>{{ $permission->first_name }}</td>
                                                            <td>{{ $permission->company_name }}</td>
                                                            <td> {{ implode(', ', $permission->roles->toArray()) }}</td>
                                                            <td>
                                                                <div
                                                                    class="d-inline-flex align-items-center position-relative switch-container">
                                                                    <div
                                                                        class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                        Yes
                                                                    </div>


                                                                    {{-- toggle yes no --}}
                                                                    <input type="radio" name="to_be_notified"
                                                                        data-onstyle="danger" data-offstyle="info"
                                                                        data-id="{{ $permission->id }}"
                                                                        data-toggle="toggle" data-on="yes" data-off="no"
                                                                        value="{{ $permission->to_be_notified}}"
                                                                        {{-- {{ $permission->to_be_notified ? 'checked' : '' }}  --}}
                                                                        checked
                                                                        class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">

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

                                                                        </div>


                                                                        {{-- toggle yes no  --}}

                                                                        <input type="radio" name="to_be_visible"
                                                                            data-onstyle="danger"
                                                                             data-offstyle="info"
                                                                            {{-- data-id="{{ $permission->id }}" --}}
                                                                            {{-- value="{{ $permission->to_be_visible }}" --}}
                                                                            data-toggle="toggle" data-on="yes"
                                                                            data-off="no"
                                                                              {{-- {{ $permission->to_be_visible == 1 ? 'checked' : '' }} --}}
                                                                            class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5  ">


                                                                        <label class="switch me-2 transition"></label>
                                                                        <div
                                                                            class="tk-basic-sans font16 le  ading22 space-0_16 text-black fw-normal me-2">
                                                                            No
                                                                        </div>
                                                                    </div>

                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-id="{{ $permission->id }}"
                                                                        data-invited_by="{{ $permission->invited_by }}"
                                                                        data-bs-target="#userModal"
                                                                        class="text-decoration-none d-inline-flex delete-user"><img
                                                                            src="{{ asset('images/three-dot-menu.svg') }}"
                                                                            class="three-dot" alt="Three dot">
                                                                    </a>

                                                                </div>

                                                            </td>

                                                        </tr>
=======
                                                @foreach ($usersPermission->toArray() as $permission)
                                                    <td>{{ $permission['first_name'] }}</td>
                                                    <td>{{ $permission['company_name'] }}</td>
                                                    <td>
                                                        {{ $permission['roles'][0]['name'] }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="d-inline-flex align-items-center position-relative switch-container">

                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                No
                                                            </div>

                                                            {{-- toggle yes no --}}
                                                            <label class="toggle custom--toggle">
                                                                <input type="checkbox" data-toggle="toggle"
                                                                    name="to_be_notified" data-type="to_be_notified"
                                                                    data-id="{{ $permission['shared_with_user'][0]['id'] }}"
                                                                    class="toggle-input"
                                                                    {{ $permission['shared_with_user'][0]['to_be_notified'] == 1 ? 'checked' : '' }}>
                                                                <span class="slider"></span>
                                                            </label>

                                                            <div
                                                                class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                Yes
                                                            </div>

                                                        </div>
                                                    </td>

                                                    <td>

                                                        <div class="d-flex justify-content-between">
                                                            <div
                                                                class="d-inline-flex align-items-center position-relative switch-container">
                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    No
                                                                </div>

                                                                <label class="toggle custom--toggle">
                                                                    <input type="checkbox" data-toggle="toggle"
                                                                        name="to_be_visible" data-type="to_be_visible"
                                                                        data-id="{{ $permission['shared_with_user'][0]['id'] }}"
                                                                        class="toggle-input"
                                                                        {{ $permission['shared_with_user'][0]['to_be_visible'] == 1 ? 'checked' : '' }}>
                                                                    <span class="slider"></span>
                                                                </label>

                                                                <div
                                                                    class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                                                    Yes
                                                                </div>

                                                            </div>

                                                            <a href="#" data-bs-toggle="modal"
                                                                data-id="{{ $permission['id'] }}"
                                                                data-invited_by="{{ $permission['invited_by'] }}"
                                                                data-bs-target="#userModal"
                                                                class="text-decoration-none d-inline-flex delete-user"><img
                                                                    src="{{ asset('images/three-dot-menu.svg') }}"
                                                                    class="three-dot" alt="Three dot">
                                                            </a>

                                                        </div>

                                                    </td>

                                                    </tr>
>>>>>>> Stashed changes
                                                    </form>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="title dmb-20">
                            <div class="d-inline-flex align-items-center">
                                <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('images/mail.svg') }}" alt="mail icon ">
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

                            @foreach ($chats as $chat)
                                <div class="d-flex align-items-center justify-content-between dmb-45">
                                    <div class="d-flex align-items-center col-10">
                                        <div
                                            class="alphbet-icon bg-224598 tk-basic-sans font16 leading22 text-white text-uppercase fw-normal d-flex align-items-center justify-content-center rounded-circle me-3">
                                            <p class="mb-0">{{ substr($chat->User->name, 0, 1) }}</p>
                                        </div>
                                        <div>
                                            <p class="tk-basic-sans font16 leading22 text-black fw-normal mb-0">
                                                {{ $chat->User->name }}</p>
                                            <p class="tk-basic-sans font16 leading22 text-808080 fw-normal mb-0">
                                                {{ $chat->message ?? 'No messages available' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-2 tk-basic-sans font12 leading22 text-black fw-normal text-end">
                                        <p class="mb-0">{{ $chat->updated_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <form id="chat-form" action="{{ route('document.store', $documents->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                <div class="textarea-input">

                                    <input type="hidden" name="document_id" value="{{ $documents->id }}">

                                    <textarea name="message" id="message" placeholder="Write your message…"
                                        class="tk-basic-sans font16 leading22 space-0_16 text-808080 fw-normal w-100 radius5 px-3 py-3 dmb-20"></textarea>

                                    <div class="error">{{ $errors->first('message') }}</div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="message-files">
                                            <span
                                                class="tk-basic-sans font13 leading22 space-0_13 text-black fw-normal me-3">
                                                Select a file to upload
                                            </span>
                                            <button
                                                class="bg-transparent tk-basic-sans font12 leading22 space-0_12 text-black fw-normal px-4 position-relative">
                                                Browse files
                                                <input type="file" name="file" id="file"
                                                    class="position-absolute start-0 w-100 h-100 top-0 opacity-0">
                                                <div class="error">{{ $errors->first('file') }}</div>
                                            </button>

                                        </div>

                                        <div>
                                            <button type="submit"
                                                class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white dpt-10 dpb-10 px-4 radius5 ms-3">
                                                Submit message
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>



                        <div class="d-flex align-items-center justify-content-between dpb-65">
                            <a href="{{ route('document.index') }}"
                                class="back-all text-decoration-none tk-basic-sans font13 leading22 space-0_13 text-black fw-normal d-inline-flex align-items-center">
                                <div class="text-black d-flex align-items-center justify-content-center radius4 me-2">
                                    <img src="{{ asset('images/left.svg') }}" alt="left icon">
                                </div>
                                Back to all
                            </a>


                            <a href="{{ route('user-manage.index') }}"
                                class="text-decoration-none large-btn blue-btn tk-basic-sans font16 leading22 space-0_16 fw-normal d-inline-flex align-items-center justify-content-center px-5 radius7 ">
                                <img src="{{ asset('images/plus-circle.svg') }}" alt="plus-circle icon" class="me-2">
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

    <div class="modal fade remove-user-modal" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="remove-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content position-relative border-0 radius4 bg-white justify-content-lg-center justify-content-start">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/white-close.svg') }}" alt="white-close icon" />
                    </button>
                </div>
                <div class="">
                    <div
                        class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25 col-9 px-2 mx-auto">
                        Are you sure you want to remove {{-- {{ Auth::user()->first_name }}? --}}
                    </div>

                    <div class="d-flex align-items-center row6">
                        <div class="col-6">

                            <form id="delete-form" method="POST" action="{{ route('document.destroy', ':id') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="invited_by" value="">
                                <button type="submit" id="confirm-delete"
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


    <div class="modal fade user-modal" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content radius4">
                <div class="modal-header">
                    <h6 class="modal-title" id="userModalLabel">User Actions</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-none ps-0 mb-0">

                        <li class="dmb-15">
                            <a href="#remove-user" id="remove-user-link" data-bs-toggle="modal"
                                data-bs-target="#remove-user"
                                class="d-inline-block text-decoration-none tk-basic-sans font14 leading22 space-0_14 text-black fw-normal delete-user">
                                Remove User </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Viewing File -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">File View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table common-table ready-table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>url</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($documents && $documents->count())
                                <tr>
                                    <td>{{ $documents->name }}</td>
                                    <td> <img src="{{ asset('storage/' . $documents->url) }}"
                                            alt="{{ $documents->name }}" class="img-thumbnail"
                                            style="max-width: 150px; max-height: 150px;"></td>
                                </tr>
                                <td>
                                @else
                                    <tr>
                                        <td colspan="2">No documents found.</td>
                                    </tr>
                            @endif
                        </tbody>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<<<<<<< Updated upstream
=======
    <script src="{{ mix('js/app.js') }}"></script>
>>>>>>> Stashed changes

@endsection


@push('page-specific-scripts')
    <script>
<<<<<<< Updated upstream
        {{-- delete user --}}
        $(document).on('click', '.delete-user', function() {
            let userId = $(this).data('id');
            let invitedBy = $(this).data('invited_by');

            console.log('ID:', userId);
            console.log('Invited By:', invitedBy);

=======
        const documentId = @json($documents->id);


        {{-- delete user --}}
        $(document).on('click', '.delete-user', function() {
            let userId = $(this).data('id');
            let invitedBy = $(this).data('invited_by');

            console.log('ID:', userId);
            console.log('Invited By:', invitedBy);

>>>>>>> Stashed changes
            $('#delete-form').attr('action', "{{ route('document.destroy', ':id') }}".replace(':id', userId));
            $('input[name="invited_by"]').val(invitedBy);

        });
<<<<<<< Updated upstream
=======


        {{-- document delete --}}


        $(document).on('click', '.remove-file-btn', function() {
            var documentId = $(this).data('id');
            $('#confirmRemoveButton').data('id', documentId);
            $('#removeFileModal').modal('show');
        });


        $('#confirmRemoveButton').on('click', function() {
            var documentId = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/documents/' + documentId + '/delete',
                type: 'DELETE',
                success: function(response) {
                    if (response.status) {
                        alert(response.message);
                        location.reload();
                        window.location.href = '/document';
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while deleting the document.');
                }
            });


            $('#removeFileModal').modal('hide');
        });



        {{-- chat --}}

        $("#chat-form").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('document.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $("#messages").append(`<p><strong>You:</strong> ${response.message}</p>`);
                        $("#message").val('');
                    }
                },
                error: function(xhr) {
                    alert(`Error: ${xhr.responseJSON.error || 'Something went wrong!'}`);
                }
            });
        });

        {{-- notify button --}}

        $(document).ready(function() {
            $('.notify-btn').click(function() {
                $.ajax({
                    url: 'document.show',
                    method: 'GET',
                    success: function(response) {
                        $('#notification-message').html(
                            `<div class="alert alert-success">${response.success}</div>`
                        );
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('#notification-message').html(
                                `<div class="alert alert-danger">${xhr.responseJSON.error}</div>`
                            );
                        } else {
                            $('#notification-message').html(
                                `<div class="alert alert-success">Permission Yes SET!</div>`
                            );
                        }
                    }
                });
            });
        });
>>>>>>> Stashed changes




        //  radio button toggle

<<<<<<< Updated upstream


        {{-- document delete --}}


        $(document).on('click', '.remove-file-btn', function() {
            var documentId = $(this).data('id');
            $('#confirmRemoveButton').data('id', documentId);
            $('#removeFileModal').modal('show');
        });


        $('#confirmRemoveButton').on('click', function() {
            var documentId = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/documents/' + documentId + '/delete',
                type: 'DELETE',
                success: function(response) {
                    if (response.status) {
                        alert(response.message);
                        location.reload();
                        window.location.href = '/document';
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while deleting the document.');
                }
            });


            $('#removeFileModal').modal('hide');
        });



        {{-- chat --}}

        $("#chat-form").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('document.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $("#messages").append(`<p><strong>You:</strong> ${response.message}</p>`);
                        $("#message").val('');
                    }
                },
                error: function(xhr) {
                    alert(`Error: ${xhr.responseJSON.error || 'Something went wrong!'}`);
                }
            });
        });

        {{-- notify button --}}

        $(document).ready(function() {
            $('.notify-btn').click(function() {
                $.ajax({
                    url: 'document.show',
                    method: 'GET',
                    success: function(response) {
                        $('#notification-message').html(
                            `<div class="alert alert-success">${response.success}</div>`
                        );
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('#notification-message').html(
                                `<div class="alert alert-danger">${xhr.responseJSON.error}</div>`
                            );
                        } else {
                            $('#notification-message').html(
                                `<div class="alert alert-success">Permission Yes SET!</div>`
                            );
                        }
                    }
                });
            });
        });




        // $(document).on('change', 'input[type="radio"]', function() {

        //     var id = $(this).data('id');
        //     var field = $(this).data('name');
        //     var value = $(this).val();


        //     $.ajax({
        //         url: '/document/' + id,
        //         type: 'PUT',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             [field]: value,
        //         },
        //         success: function(response) {

        //             alert(response.message);
        //             $('input[data-id="' + response.id + '"][name="' + response.field + '"][value="' +
        //                 response.value + '"]').prop('checked', true);
        //         },
        //         error: function(xhr) {

        //             console.error(xhr.responseText);
        //             alert('Something went wrong!');
        //         }
        //     });
        // });



        // toggle js che

        $(document).on('change', 'input[type="radio"]', function() {
            var id = $(this).data('id');
            var field = $(this).attr('name');
            var value = $(this).val();

            $.ajax({
                url: '/document/' + id,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    [field]: value
                },
                success: function(response) {
                    alert(response.message);
                    $(`input[data-id="${response.id}"][name="${response.field}"][value="${response.value}"]`)
                        .prop('checked', true);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Something went wrong!');
                }
            });
        });





        {{-- Ready to send the file for approval? --}}


=======
        $('.toggle-input').change(function() {
            let toggleType = $(this).data('type');
            let id = $(this).data('id');
            let value = $(this).prop('checked') ? 1 : 0;
            let data = {};
            data[toggleType] = value;
            data['_token'] = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/document/" + id,
                type: "PUT",
                data: data,
                success: function(response) {

                    alert('permission change successFully !');

                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $('#notification-message').html(
                            `<div class="alert alert-danger">${xhr.responseJSON.error}</div>`
                        );
                    }
                }
            });
        });




        {{-- Ready to send the file for approval? --}}


>>>>>>> Stashed changes
        function toggleDivVisibility() {
            const contentDiv = document.getElementById("accordion-content");

            if (contentDiv.style.display === "none") {
                contentDiv.style.display = "block";
            } else {
                contentDiv.style.display = "none";
            }
        }
        document.getElementById("accordion-content").style.display = "none";
    </script>
@endpush
