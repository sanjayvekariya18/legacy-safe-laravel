@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (!Auth::user()->hasRole(\App\Models\User::ROLE_ADMIN))
        <div class="tk-basic-sans font26 leading30 space-0_26 text-black fw-semibold dmb-75">
            Hi {{ Auth::user()->name }}, welcome to your LegacySafe
        </div>
        <table class="table common-table dmb-5 pe-3">
            <thead>
                <tr>
                    <th scope="col" colspan="2">File name</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Shared with</th>
                    <th scope="col">Last Modified</th>
                    <th scope="col"></th>
                </tr>
            </thead>
        </table>
        <div class="tables pe-3">
            <table class="table common-table document-table mb-0">
                <tbody>
                    @forelse ($documents as $document)
                        <tr>
                            <td colspan="2">
                                <img src="{{ asset('images/file-icon.svg') }}" alt="">
                                <span>
                                    {{ $document->name }}
                                </span>
                            </td>
                            <td>{{ $document->user->name }}</td>
                            <td>{{ $document->sharedWithUsers->count() }} Users</td>
                            <td>{{ $document->updated_at->format('d-m-Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    @if (Auth::user()->hasRole(\App\Models\User::ROLE_CLIENT))
                                        <a href="{{ route('documents.show', ['document' => $document]) }}"
                                            class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                                    @else
                                        <a href="{{ route('shared.documents.show', ['document' => $document]) }}"
                                            class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Document found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
    <div class="row row8 dmt-80">
        <div class="tk-basic-sans font12 leading22 space-0_12 text-black fw-normal dmb-25">
            Quicklinks
        </div>
        @if (Auth::user()->hasRole(\App\Models\User::ROLE_ADMIN))
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/user-icon.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                Users/Permissions
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('users.index') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/document.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                Invoices
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('invoices.index') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/file-maneger.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                Activity Log
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('activity.logs') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->hasRole(\App\Models\User::ROLE_CLIENT))
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/file-maneger.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                File manager
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('documents.create') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/document.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                Documents
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('documents.index') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/user-icon.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                Shared Users
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('shared.users.index') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->hasRole(\App\Models\User::ROLE_PROFESSIONAL))
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/document.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                Documents to review
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('shared.documents.index') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
                    <div class="d-inline-flex">
                        <div class="dashboard-icon bg-F0F0F0 radius7">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/user-icon.svg') }}" alt="" class="">
                            </div>
                        </div>
                        <div class="ms-4 d-flex flex-column">
                            <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                                Client
                            </div>
                            <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            </div>
                            <a href="{{ route('clients.index') }}"
                                class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 bg-224598-btn ">View</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
