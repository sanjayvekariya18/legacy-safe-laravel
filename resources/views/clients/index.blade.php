@extends('layouts.app')
@section('title', 'Documents')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex align-items-center justify-content-between dmb-35 pe-3">
        <div class="title d-flex align-items-center">
            <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/user-icon.svg') }}" alt="">
            </div>
            <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                Clients
            </div>
        </div>
        <div class="col-5 ps-3">
            <div class="position-relative w-100">
                <form action="{{ route('clients.index') }}" method="GET" class="d-flex mb-3">
                    <input name="search" value="{{ request()->get('search') }}" type="text"
                        placeholder="Who are you looking for?.."
                        class="input white-b-input height-50 w-100 tk-basic-sans font16 leading19 pe-5">
                    <div class="position-absolute h-100 top-0 end-0 d-flex align-items-center justify-content-end pe-2">
                        <button type="submit"
                            class="bg-224598 search-icon radius4 d-flex align-items-center justify-content-center">
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
                <th scope="col">Owner</th>
                <th scope="col">Total Documents</th>
                <th scope="col"></th>
            </tr>
        </thead>
    </table>
    <div class="tables pe-3 dmb-45">
        <table class="table common-table document-table mb-0">
            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                        <td>{{ $client->document_count }}</td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <!-- enable btn -->
                                <a href="{{ route('client.documents', ['client_id' => $client->user_id]) }}"
                                    class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5">View</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No Client found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex align-items-center justify-content-between dmb-50 pe-3">
        <div class="pagination d-flex align-items-center">
            {{ $clients->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
