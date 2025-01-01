@extends('layouts.app')
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
                @foreach ($documents as $document)
                    <tr>
                        <td colspan="2">
                            <img src="{{ asset('images/user.svg') }}" alt="user icon">
                            <span>
                                {{ $document->name }}
                            </span>
                        </td>
                        {{-- <td>{{ $document->User->name }}</td> --}}
                        <td>{{ $document->User ? $document->User->name : 'No User' }}</td>
                        <td>{{ $document->SharedWithUser->count() }} users</td>
                        <td>{{ $document->updated_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <button
                                    class="border-0 bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5"
                                    onclick="window.location.href='{{ route('document.show', $document->id) }}'">View</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
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
                            <img src="{{ asset('images/user.svg') }}" alt="user icon" class="">
                        </div>
                    </div>
                    <div class="ms-4 d-flex flex-column">
                        <div class="tk-basic-sans font22 leading30 space-0_22 text-0F0F0F fw-normal dmb-15">
                            Users/Permissions
                        </div>
                        <div class="tk-basic-sans font13 leading22 space-0_13 text-3C3C3C fw-normal dmb-15">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                        </div>
                        <a href="{{ route('user-manage.index') }}"
                            class="text-decoration-none d-inline-block w-fit bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
