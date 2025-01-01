@extends('layouts.app')

@section('content')
    <main>
        <section class="admin bg-F5F5F5 h-vh">
            <div class="d-flex flex-wrap h-100">

                <div class="admin-wrapper h-100 overflow-auto">
                    <div class="container-fluid h-100">
                        <div class="ps-5">


                            <div class="title d-flex align-items-center dmb-25">
                                <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('images/user-icon.svg') }}" alt="user icon">
                                </div>
                                <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                    Edit User
                                </div>
                            </div>

                            <form action="{{ route('user-manage.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-11 user-permission">
                                    <div class="row input-row dpb-30">
                                        <div class="col-6">

                                            <x-text-input type="text" placeholder="First name…" name="first_name"
                                                id="first_name" value="{{ old('first_name', $user->first_name) }}"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="first_name" />

                                            <x-input-error :message="$errors->first('first_name')" />

                                        </div>
                                        <div class="col-6">
                                            <x-text-input type="text" placeholder="Last name…" name="last_name"
                                                id="last_name" value="{{ old('last_name', $user->last_name) }}"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="last_name" />
                                            <x-input-error :message="$errors->first('last_name')" />
                                        </div>

                                        <div class="col-6">
                                            <x-text-input type="email" placeholder="Email…" name="email" id="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="email" />
                                            <x-input-error :message="$errors->first('email')" />
                                        </div>

                                        <div class="col-6">
                                            <x-text-input type="tel" placeholder="Mobile Number (+44)"
                                                name="mobile_number"
                                                value="{{ old('mobile_number', $user->mobile_number) }}" id="mobile_number"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="mobile_number" />
                                            <x-input-error :message="$errors->first('mobile_number')" />

                                        </div>


                                        <div class="col-6">
                                            <x-text-input type="password" placeholder="Password…" name="password"
                                                id="password" value=""
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="password" />
                                            <x-input-error :message="$errors->first('password')" />

                                        </div>

                                        <div class="col-6">
                                            <x-text-input type="password" placeholder="Confirm Password…"
                                                name="password_confirmation" value="" id="password_confirmation"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="password" />
                                        </div>
                                    </div>
                                    <div class="tk-basic-sans fw-normal font16 leading24 space-0_16 text-black dmb-20">
                                        Billing details</div>
                                    <div class="row input-row dpb-45">

                                        <div class="col-6">
                                            <x-text-input type="text" placeholder="First line of address…"
                                                name="address1" value="{{ old('address1', $user->address1) }}"
                                                id="address1"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="address1" />
                                            <x-input-error :message="$errors->first('address1')" />

                                        </div>

                                        <div class="col-6">
                                            <x-text-input type="text" placeholder="Second line of address…"
                                                name="address2" value="{{ old('address2', $user->address2) }}"
                                                id="address2"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="address2" />
                                            <x-input-error :message="$errors->first('address2')" />

                                        </div>

                                        <div class="col-6">
                                            <x-text-input type="text" placeholder="Country…" name="country"
                                                id="country" value="{{ old('country', $user->country) }}"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="country" />
                                            <x-input-error :message="$errors->first('country')" />
                                        </div>

                                        <div class="col-6">
                                            <x-text-input type="text" placeholder="Postcode…" name="postcode"
                                                id="postcode" value="{{ old('postcode', $user->postcode) }}"
                                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-15"
                                                autofocus autocomplete="postcode" />
                                            <x-input-error :message="$errors->first('postcode')" />

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between dmb-15">
                                        <div class="tk-basic-sans font16 leading24 space-0_16 text-black">User
                                            Permissions
                                        </div>
                                        <a href="{{ Route('permissions.edit', $user->id) }}"
                                            class="tk-basic-sans font16 leading24 space-0_16 text-black">Edit
                                            Permissions</a>
                                    </div>

                                    <div
                                        class="user-permission-box radius5 bg-white d-flex align-items-center ps-4 dmb-30 dpt-30 dpb-30">
                                        @foreach ($user->roles as $role)
                                            <div class="d-flex align-items-center user-permission-check">
                                                <div
                                                    class="checkbox-container black-checkbox-container position-relative  d-inline-flex align-items-center tk-basic-sans fw-normal font16 leading30 space-0_16 text-black">
                                                    <input type="checkbox" checked
                                                        class="opacity-0 position-absolute top-0 start-0">
                                                    <span
                                                        class="check-box black-checkbox radius5 position-relative me-3"></span>
                                                    {{ $role->name }}
                                                </div>
                                                <a href="#solicitor-modal" data-bs-toggle="modal"
                                                    data-bs-target="#solicitor-modal"
                                                    class="text-decoration-none d-inline-block tk-basic-sans fw-normal font16 leading30 space-0_16 text-808080 ms-1">(view
                                                    permissions)</a>
                                            </div>
                                        @endforeach
                                    </div>
                            </form>


                            <div class="d-flex justify-content-between dpb-80">
                                <div>

                                    <form action="{{ route('user-manage.delete', $user->id) }}" method="POST">
                                        <input id="id" name="id" hidden>
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" id="id"
                                            value="{{ $user->id }}">
                                        <button type="submit" id="archive-button"
                                            class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black radius7 border-1 bg-transparent user-permission-btn d-inline-flex align-items-center me-2">
                                            <img src="{{ asset('images/archiv-user.svg') }}"
                                                class="permission-box-user-logo me-1" alt="archive-user">
                                            Archive User
                                        </button>
                                    </form>


                                    <form id="delete-form" id="delete-button"
                                        action="{{ route('user-manage.delete', $user->id) }}" method="POST">
                                        <input id="id" name="id" hidden>
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" id="id"
                                            value="{{ $user->id }}">
                                        <button type="submit"
                                            class="tk-basic-sans fw-normal font16 leading19 space-0_16 text-black radius7 border-1 bg-transparent user-permission-btn d-inline-flex align-items-center">
                                            <img src="{{ asset('images/delet.svg') }}"
                                                class="permission-box-user-logo me-1" alt="delete icon">
                                            Remove User
                                        </button>
                                    </form>


                                </div>
                                <button type="submit" id="update-button"
                                    class="btnB blue-btn tk-basic-sans font16 leading19 space-0_16 text-decoration-none d-inline-flex align-items-center radius7">Save
                                    Changes</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>


    <!-- solicitor-modal -->
    <div class="modal solicitor-modal fade" id="solicitor-modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="solicitorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content position-relative border-0 radius4 bg-white">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/white-close.svg') }}" alt="Close Icon" />
                    </button>
                </div>
                <div class="text-center">
                    <div class="tk-basic-sans fw-normal font26 leading30 space-0_26 text-0F0F0F dmb-15">
                        Roles and Permissions
                    </div>

                    <ul class="list-none ps-0 mb-0">
                        @forelse ($user->roles as $role)
                            <li class="dmb-15">
                                <span
                                    class="d-block text-decoration-none tk-basic-sans font16 leading19 space-0_16 text-808080 fw-normal">
                                    Role: {{ $role->name }}
                                </span>
                                <ul class="ps-3">
                                    @forelse ($role->permissions as $permission)
                                        <li class="dmb-10">
                                            Permission: {{ $permission->name }}
                                        </li>
                                    @empty
                                        <li class="dmb-10">
                                            No permissions assigned to this role.
                                        </li>
                                    @endforelse
                                </ul>
                            </li>
                        @empty
                            <li class="dmb-15">
                                <span
                                    class="d-inline-block text-decoration-none tk-basic-sans font16 leading19 space-0_16 text-808080 fw-normal">
                                    No roles assigned to this user.
                                </span>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection
