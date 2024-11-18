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
            <img src="{{ asset('images/document.svg') }}" alt="">
        </div>
        <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
            Create Product
        </div>
    </div>
    <div class="col-11">
        <form class="row row8 form-row" action="{{ route('products.update', $product->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="col-6 dmt-15">
                <x-text-input class="white-b-input" type="text" name="name" placeholder="Product name…"
                    :value="old('name', $product->name)" required autofocus autocomplete="name" />
                <x-input-error :message="$errors->first('name')" />
            </div>
            <div class="col-6 dmt-15">
                <x-text-input class="white-b-input" type="text" name="title" placeholder="title…"
                    :value="old('title', $product->title)" required autofocus autocomplete="title" />
                <x-input-error :message="$errors->first('title')" />
            </div>
            <div class="col-6 dmt-15">
                <input type="number" name="monthly_price" placeholder="£ Montly Price…" value="{{ old('monthly_price', $product->monthly_price) }}"
                    class="input white-b-input tk-basic-sans font16 leading19 w-100 bg-white" required autocomplete="monthly_price">
                    <x-input-error :message="$errors->first('monthly_price')" />
            </div>
            <div class="col-6 dmt-15">
                <input type="number" name="yearly_price" placeholder="£ Yearly Price…" value="{{ old('yearly_price', $product->yearly_price) }}"
                    class="input white-b-input tk-basic-sans font16 leading19 w-100 bg-white" required autocomplete="yearly_price">
                    <x-input-error :message="$errors->first('yearly_price')" />
            </div>
            <div class="col-12 dmt-15">
                <textarea name="description" placeholder="Product Description…" rows="8"
                    class="textarea white-b-textarea tk-basic-sans font16 space-0_16 leading19 w-100 bg-white py-3" required autocomplete="description">{{ old('description', $product->description) }}</textarea>
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
