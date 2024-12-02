@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="title d-flex align-items-center dmb-25">
        <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
            <img src="{{ asset('images/user-icon.svg') }}" alt="">
        </div>
        <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
            Edit User
        </div>
    </div>
    <div class="col-11 user-permission">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row input-row dpb-30">
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="first_name" placeholder="First name…"
                        :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                    <x-input-error :message="$errors->first('first_name')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="last_name" placeholder="Last Name…"
                        :value="old('last_name', $user->last_name)" required autocomplete="last_name" />
                    <x-input-error :message="$errors->first('last_name')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="email" placeholder="Email……"
                        :value="old('email', $user->email)" required autocomplete="email" />
                    <x-input-error :message="$errors->first('email')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="mobile_number"
                        placeholder="Mobile Number (+44)" :value="old('mobile_number', $user->mobile_number)" required autocomplete="mobile_number" />
                    <x-input-error :message="$errors->first('mobile_number')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="password" name="password" placeholder="Password…"
                        :value="old('password')" autocomplete="new-password" />
                    <x-input-error :message="$errors->first('password')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="password" name="password_confirmation"
                        placeholder="Confirm Password…" autocomplete="new-password" />
                </div>
            </div>
            <div class="tk-basic-sans fw-normal font16 leading24 space-0_16 text-black dmb-20">
                Billing details</div>
            <div class="row input-row dpb-45">
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="address1" placeholder="First line of address…"
                        :value="old('address1', $user->address1)" required autocomplete="address1" />
                    <x-input-error :message="$errors->first('address1')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="address2" placeholder="Second line of address…"
                        :value="old('address2', $user->address2)" required autocomplete="address2" />
                    <x-input-error :message="$errors->first('address2')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="country" placeholder="Country…"
                        :value="old('country', $user->country)" required autocomplete="country" />
                    <x-input-error :message="$errors->first('country')" />
                </div>
                <div class="col-6 position-relative dmb-20">
                    <x-text-input class="white-b-input" type="text" name="postcode" placeholder="Postcode…"
                        :value="old('postcode', $user->postcode)" required autocomplete="postcode" />
                    <x-input-error :message="$errors->first('postcode')" />
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between dmb-15">
                <div class="tk-basic-sans font16 leading24 space-0_16 text-black">
                    User Permissions
                    <x-input-error :message="$errors->first('roles')" />
                </div>
            </div>
            <div class="user-permission-box radius5 bg-white d-flex flex-wrap align-items-center ps-4 dmb-30 dpt-30 dpb-30">
                @foreach ($roles as $role)
                    <div class="d-flex align-items-center user-permission-check dmb-10">
                        <div
                            class="checkbox-container black-checkbox-container position-relative  d-inline-flex align-items-center tk-basic-sans fw-normal font16 leading30 space-0_16 text-black">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                class="opacity-0 position-absolute top-0 start-0">
                            <span class="check-box black-checkbox radius5 position-relative me-3"></span>
                            {{ $role->name }}
                        </div>
                        <a href="#solicitor-modal" data-role="{{ $role->name }}"
                            data-permissions="{{ json_encode($role->permissions->pluck('name')) }}" data-bs-toggle="modal"
                            data-bs-target="#solicitor-modal"
                            class="text-decoration-none d-inline-block tk-basic-sans fw-normal font16 leading30 space-0_16 text-808080 ms-1">(view
                            permissions)</a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-between dpb-80">
                <div>
                    <button type="button" data-action='softDeleteForm'
                        class="tk-basic-sans font16 leading19 space-0_16 text-black radius7 border-1 bg-transparent user-permission-btn align-items-center me-2">
                        <img src="{{ asset('images/archive-icon.svg') }}" class="permission-box-user-logo me-2"
                            alt="">
                        Archive User
                    </button>
                    <button type="button" data-action='hardDeleteForm'
                        class="tk-basic-sans font16 leading19 space-0_16 text-black radius7 border-1 bg-transparent user-permission-btn align-items-center">
                        <img src="{{ asset('images/delete-icon.svg') }}" class="permission-box-user-logo me-2" alt="">
                        Remove User
                    </button>
                </div>
                <button type="submit"
                    class="btnB blue-btn tk-basic-sans font16 leading19 space-0_16 align-items-center radius7">Save
                    Changes</button>
            </div>
        </form>
    </div>

    <!-- Soft Delete Form -->
    <form id="softDeleteForm" action="{{ route('users.soft-delete', $user) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <!-- Hard Delete Form -->
    <form id="hardDeleteForm" action="{{ route('users.hard-delete', $user) }}" method="POST">
        @method('DELETE')
        @csrf
    </form>

    <!-- solicitor-modal -->
    <div class="modal solicitor-modal fade" id="solicitor-modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="solicitorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content position-relative border-0 radius4 bg-white ">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/white-close.svg') }}" alt="" />
                    </button>
                </div>
                <div class="text-center">
                    <div class="tk-basic-sans fw-normal font26 leading30 space-0_26 text-0F0F0F dmb-15"></div>
                    <ul class="list-none ps-0 mb-0">
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script type="module">
        $('.user-permission-btn').on("click", function () {
             // Get the form by ID
            var form = document.getElementById($(this).data('action'));
            form.submit(); // Submit the form
        });

        // Assuming you have a modal with id #myModal
        $('#solicitor-modal').on('show.bs.modal', function(event) {
            // Code to execute before modal opens
            var button = $(event.relatedTarget); // Button that triggered the modal

            var role = button.data('role'); // Assuming data-role attribute on the button
            var permissions = button.data('permissions'); // Assuming data-permissions attribute on the button

            // Set the new heading
            $(this).find('.modal-content .text-center .tk-basic-sans').text(role);

            // Clear any existing list items
            var listContainer = $(this).find('.modal-content ul');
            listContainer.empty();

            // Append list items dynamically
            permissions.forEach(function(item) {
                listContainer.append(
                    `<li class="dmb-15"><a href="" class="d-inline-block text-decoration-none tk-basic-sans font16 leading19 space-0_16 text-808080 fw-normal">• ${item}</a></li>`
                    );
            });
        });
    </script>
@endpush
