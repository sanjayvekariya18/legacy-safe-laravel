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
                <img src="{{ asset('images/star-icon.svg') }}" alt="">
            </div>
            <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                Activity Log
            </div>
        </div>
        <div class="col-5 ps-3">
            <div class="position-relative w-100">
                <form action="{{ route('activity.logs') }}" method="GET" class="d-flex">
                    <input name="search" value="{{ request()->get('search') }}" type="text"
                        placeholder="Who are you looking for?.."
                        class="input white-b-input height-50 w-100 tk-basic-sans font16 leading19 pe-5">
                    <div class="position-absolute h-100 top-0 end-0 d-flex align-items-center justify-content-end pe-2">
                        <button type="submit"
                            class="bg-224598 search-icon radius4 d-flex align-items-center justify-content-center border-0">
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
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th scope="col" colspan="2">User</th>
                <th scope="col" colspan="4">Activity</th>
            </tr>
        </thead>
    </table>
    <div class="tables pe-3 dmb-45">
        <table class="table common-table log-table mb-0">
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->diffForHumans() }}</td>
                        <td>{{ $log->updated_at->format('d/m/Y') }}</td>
                        <td colspan="2">{{ $log->causer ? $log->causer->name : 'System' }}</td>
                        <td colspan="4">{{ $log->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Log found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex align-items-center justify-content-between dmb-50 pe-3">
        <div class="pagination d-flex align-items-center">
            {{ $logs->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
