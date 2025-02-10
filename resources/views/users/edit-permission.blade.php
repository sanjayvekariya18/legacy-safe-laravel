@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="text-decoration-none title d-inline-flex align-items-center dmb-25">
        <div class="title-icon-back radius4 d-flex align-items-center justify-content-center">
            <img src="{{ asset('images/left-arrow.svg') }}" alt="">
        </div>
        <div
            class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black fw-normal ms-3">
            Back to user
        </div>
    </a>
    <div class="col-11 user-permission dpb-65">
        @foreach ($user->roles as $role)
            <div
                class="user-permission-edit-post radius5 d-flex align-items-center px-3 dmb-20 tk-basic-sans font16 leading24 space-0_16 text-black bg-white dpt-20 dpb-20">
                {{ $role->name }}
            </div>
            <form action="{{ route('users.update.permission', ['user' => $user->id]) }}" method="POST">
                @csrf
                <div class="pe-5 dmb-35">
                    <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-15">
                        Select access</div>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-4 dmb-15">
                                <div
                                    class="checkbox-container position-relative  d-inline-flex align-items-center tk-basic-sans fw-normal font16 leading29 space-0_16 text-black">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }} class="opacity-0 position-absolute top-0 start-0">
                                    <span class="check-box black-checkbox radius5 position-relative me-3 text-capitalize"></span>
                                    {{ $permission->name }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center dmb-60">
                    <a href="#" class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080">Delete
                        Permission <img src="{{ asset('images/delete-icon.svg') }} " class="delete-icon ms-2" alt="Delete"></a>
                    <!-- enable btn -->
                    {{-- <button type="submit"
                        class="btnB DEDEDE-bg-btn radius7 border-0 transition tk-basic-sans font16 leading19 space-0_16 text-808080">Save
                        Changes</button> --}}
                    <!-- disable btn -->
                    <button type="submit" class="btnB blue-btn radius7 border-0 transition tk-basic-sans font16 leading19 space-0_16 text-808080">Save Changes</button>
                </div>
            </form>
        @endforeach
    </div>
@endsection
