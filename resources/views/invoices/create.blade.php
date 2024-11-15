@extends('layouts.app')
@section('title', 'Create Invoice')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="title d-flex align-items-center dmb-25">
        <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
            <img src="{{ asset('images/file-maneger.svg') }}" alt="">
        </div>
        <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
            File manager
        </div>
    </div>
    <div class="col-11">
        {{ var_dump($errors) }}
        <form class="row row8 form-row" action="{{ route('invoices.store') }}" method="post">
            @csrf
            <div class="col-12 dmt-15">
                <x-text-input class="white-b-input" type="text" name="name" placeholder="File name…"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :message="$errors->first('name')" />
            </div>
            <div class="col-6 dmt-15">
                <div class="manager-select d-inline-flex w-100">
                    <select name="user_id" id="js-select1" class="d-none"
                        data-placeholder="Client Name (Please select)">
                        <option></option>
                        @foreach ($professionalUsers as $user)
                            <option value="{{ $user->id }}" {{ $user == old('user_id') ? 'selected' : '' }}>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :message="$errors->first('user')" />
            </div>
            <div class="col-6 dmt-15">
                <input type="number" name="amount" placeholder="£ Invoice Amount…" :value="old('amount')"
                    class="input white-b-input tk-basic-sans font16 leading19 w-100 bg-white" required autocomplete="amount">
                    <x-input-error :message="$errors->first('amount')" />
            </div>
            <div class="col-12 dmt-15">
                <textarea name="description" placeholder="Invoice Description…" rows="8"
                    class="textarea white-b-textarea tk-basic-sans font16 space-0_16 leading19 w-100 bg-white py-3" required autocomplete="description">{{ old('description') }}</textarea>
                    <x-input-error :message="$errors->first('description')" />
            </div>
            <div class="dmt-25">
                <button type="submit"
                    class="d-inline-flex align-items-center justify-content-center text-decoration-none tk-basic-sans fw-normal font16 leading19 space-0_16 large-btn blue-btn2 radius7 w-100 transition">Save
                    changes</button>
            </div>
        </form>
    </div>
@endsection
