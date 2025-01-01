@extends('layouts.app')

@section('content')

    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">

            <div class="admin-wrapper h-100 overflow-auto">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div class="h-100 d-flex flex-column justify-content-between">
                            <div>

                                <div class="d-flex align-items-center justify-content-between dmb-35 pe-3">
                                    <div class="title d-flex align-items-center">
                                        <div
                                            class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('images/document.svg') }}" alt="document icon">
                                        </div>
                                        <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                            Users & Permissions
                                        </div>
                                    </div>


                                    <div class="col-5 ps-3">
                                        <div class="position-relative w-100">
                                            <form action="{{ route('user-manage.index') }}" method="GET">
                                                <input type="text" name="search" value="{{ $search }}"
                                                    placeholder="Who are you looking for?.."
                                                    class="input white-b-input height-50 w-100 tk-basic-sans font16 leading19 pe-5">

                                                <div
                                                    class="position-absolute h-100 top-0 end-0 d-flex align-items-center justify-content-end pe-2">


                                                    <button type="submit"
                                                        class="bg-224598 search-icon radius4 d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('images/search-icon.svg') }}" alt="search icon">
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>




                                <table class="table common-table dmb-5 pe-3">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="tables pe-3 dmb-45">
                                    <table class="table common-table user-table mb-0">
                                        <tbody>
                                            @if (isset($users) && $users->count() > 0)
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->company_name }}</td>
                                                        <td> {{ implode(', ', $user->roles->toArray()) }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center justify-content-between">

                                                                <div class="d-flex align-items-center">

                                                                    <button
                                                                        class="border-0 bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5"
                                                                        onclick="window.location.href='{{ route('user-manage.edit', $user->id) }}'">View</button>



                                                                    <a href="#remove-user" data-id="{{ $user->id }}"
                                                                        data-bs-toggle="modal"
                                                                        class="delete-icon ms-3 d-inline-flex delete-user">
                                                                        <img src="{{ asset('images/delet.svg') }}"
                                                                            alt="Delete" class="h-100">
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center"
                                                        style="color: red; font-weight: bold; font-size: 16px;">
                                                        No users & permission .
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between dmb-30">
                                <div class="pagination d-flex align-items-center">
                                    {{ $users->links() }}
                                </div>



                                <div>
                                    <a href="#invite-user" data-bs-toggle="modal" data-bs-target="#invite-user"
                                        class="text-decoration-none large-btn blue-btn tk-basic-sans font16 leading22 space-0_16 fw-normal d-inline-flex align-items-center justify-content-center px-5 radius7 invite-user">
                                        <img src="{{ asset('images/plus-circle.svg') }}" alt="plus-circle icon"
                                            class="me-2">
                                        Invite new user
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- remove-user-modal -->
    <div class="modal remove-user-modal fade" id="remove-user" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="remove-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content position-relative border-0 radius4 bg-white justify-content-lg-center justify-content-start">
                <div class="close-div position-absolute">

                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/white-close.svg') }}" alt="Close Icon" />
                    </button>
                </div>
                <div class="">
                    <div
                        class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25 col-9 px-2 mx-auto">
                        Are you sure you want to remove {{-- {{ Auth::user()->first_name }}? --}}
                    </div>
                    <div class="d-flex align-items-center row6">
                        <div class="col-6">
                            <form id="delete-form" action="{{ route('user-manage.destroy', ':id') }}" method="POST">
                                <input id="id" name="id" hidden>
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" id="id" value="">
                                <button type="sumbit" id="confirm-delete"
                                    class="large-btn blue-btn2 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition">Yes,
                                    remove</button>
                            </form>

                        </div>
                        <div class="col-6">
                            <button type="submit"
                                class="large-btn btn-808080 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition"
                                data-bs-dismiss="modal" aria-label="Close">No, keep user</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- invite-user-modal -->

    <div class="modal invite-user-modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="invite-user"
        tabindex="-1" aria-labelledby="invite-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content position-relative border-0 radius4 bg-white justify-content-lg-center justify-content-start">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/white-close.svg') }}" alt="Close Icon" />
                    </button>
                </div>

                <form action="{{ route('user-manage.store') }}" method="post" id="user-form">
                    @csrf
                    <input type="hidden" id="role" name="role" value="1">
                    <input type="hidden" name="id">
                    <input type="hidden" name="invited_by" value="{{ auth()->id() }}" />

                    <div class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25">
                        Invite a user
                    </div>

                    <div class="w-100 d-flex justify-content-center">
                        <ul class="nav nav-tabs create-account-tabs bg-EBEBEB border-0 d-inline-flex align-items-center radius5 overflow-hidden px-1 dmb-15"
                            id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button onclick="setRole(1)"
                                    class="nav-link active tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                                    id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                    role="tab1" aria-controls="home" aria-selected="true">
                                    I’m a customer
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="setRole(0)"
                                    class="nav-link tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                                    id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                    role="tab2" aria-controls="profile" aria-selected="false">
                                    I’m a professional
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <!-- Customer Tab -->
                        <div class="tab-pane fade w-100 show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="d-flex w-100 justify-content-center">
                                <div class="w-100 d-flex justify-content-center">
                                    <input type="email" name="email" placeholder="Email…" id="email"
                                        class="input white-b-input tk-basic-sans font16 leading19 bg-white w-100">
                                    <x-input-error :message="$errors->first('email')" />
                                </div>

                            </div>
                        </div>

                        <!-- Professional Tab -->
                        <div class="tab-pane fade w-100" id="profile">
                            <div class="d-flex justify-content-center row8">
                                <div class="col-6">
                                    <div class="user-select d-inline-flex w-100">
                                        <select name="professional_type" class="js-select4 d-none" id="professional_type"
                                            data-placeholder="Select an option">
                                            <option></option>
                                            @foreach (\App\Models\User::PROFESSIONAL_TYPES as $professionalType)
                                                <option value="{{ $professionalType }}"
                                                    {{ $professionalType == old('professional_type') ? 'selected' : '' }}>
                                                    {{ $professionalType }}
                                                </option>
                                            @endforeach
                                            <x-input-error :message="$errors->first('professional_type')" />
                                        </select>
                                    </div>

                                </div>

                                <div class="col-6">

                                    <input type="email" name="email" placeholder="Email…" id="email-profile"
                                        class="input white-b-input tk-basic-sans font16 leading19 bg-white w-100">
                                    <x-input-error :message="$errors->first('email')" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-center dmt-20">
                        <button type="submit"
                            class="large-btn blue-btn2 w-248 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    </div>
    </div>


@endsection

@push('page-specific-scripts')
    <script type="module">
        $(document).on('click', '.delete-user', function() {

            let id = $(this).attr('data-id');
            console.log('dasdas', id);
            let actionUrl = "{{ route('user-manage.destroy', ':id') }}".replace(':id', id);
            $('#delete-form').attr('action', actionUrl);
            $('#id').val(id);
        });


        // invite user

        document.addEventListener('DOMContentLoaded', function() {
            const emailFieldCustomer = document.getElementById('email');
            const emailFieldProfessional = document.getElementById('email-profile');

            emailFieldCustomer.addEventListener('input', function() {
                emailFieldProfessional.value = emailFieldCustomer.value;
            });

            emailFieldProfessional.addEventListener('input', function() {
                emailFieldCustomer.value = emailFieldProfessional.value;
            });

            function setRole(role) {
                document.getElementById('role').value = role;
            }

            document.getElementById('home-tab').addEventListener('click', function() {
                setRole(1); // Customer
            });

            document.getElementById('profile-tab').addEventListener('click', function() {
                setRole(0); // Professional
            });
        });
    </script>
@endpush
