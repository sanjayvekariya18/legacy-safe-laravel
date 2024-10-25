@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
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
            <tr>
                <td colspan="2">
                    <img  src="{{ asset('images/user.svg') }}" alt="">
                    <span>
                        Document Name
                    </span>
                </td>
                <td>Jason Bourne</td>
                <td>3 Users</td>
                <td>13/05/2024</td>
                <td>
                    <div class="d-flex justify-content-end">
                        <a href=""
                            class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <img  src="{{ asset('images/user.svg') }}" alt="">
                    <span>
                        Document Name
                    </span>
                </td>
                <td>Jason Bourne</td>
                <td>3 Users</td>
                <td>13/05/2024</td>
                <td>
                    <div class="d-flex justify-content-end">
                        <a href=""
                            class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <img  src="{{ asset('images/user.svg') }}" alt="">
                    <span>
                        Document Name
                    </span>
                </td>
                <td>Jason Bourne</td>
                <td>3 Users</td>
                <td>13/05/2024</td>
                <td>
                    <div class="d-flex justify-content-end">
                        <a href=""
                            class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row row8 dmt-80">
    <div class="tk-basic-sans font12 leading22 space-0_12 text-black fw-normal dmb-25">
        Quicklinks
    </div>
    <div class="col-4">
        <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
            <div class="d-inline-flex">
                <div class="dashboard-icon bg-F0F0F0 radius7">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                        <img  src="{{ asset('images/user.svg') }}" alt="" class="">
                    </div>
                </div>
                <div class="ms-4 d-flex flex-column">
                    <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                        Users/Permissions
                    </div>
                    <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    </div>
                    <a href=""
                        class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
            <div class="d-inline-flex">
                <div class="dashboard-icon bg-F0F0F0 radius7">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                        <img  src="{{ asset('images/user.svg') }}" alt="" class="">
                    </div>
                </div>
                <div class="ms-4 d-flex flex-column">
                    <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                        Users/Permissions
                    </div>
                    <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    </div>
                    <a href=""
                        class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="bg-white dashboard-card radius7 px-4 dpt-35 dpb-30">
            <div class="d-inline-flex">
                <div class="dashboard-icon bg-F0F0F0 radius7">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                        <img  src="{{ asset('images/user.svg') }}" alt="" class="">
                    </div>
                </div>
                <div class="ms-4 d-flex flex-column">
                    <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                        Users/Permissions
                    </div>
                    <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    </div>
                    <a href=""
                        class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
