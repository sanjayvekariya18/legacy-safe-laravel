@extends('layouts.app')

@section('content')


<section class="modal-box-section h-vh position-relative w-100">
    <img src="images/hero-img.jpg" class="w-100 h-100 object-cover" alt="">
    <div class="position-fixed bottom-0 end-0 d-flex align-items-center me-5 mb-4">
        <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-white me-1">Powered by</div>
        <div class="legacy-logo">
            <img src="images/user.svg" class="w-100" alt="">
        </div>
    </div>
    <div class="position-absolute top-left-center w-100">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="col-4 mx-auto px-4">
                <div class="modal-bg-layer radius10 dpt-50 text-center overflow-hidden">
                    <div class="modal-box-data dmb-35">
                        <div class="tk-basic-sans fw-normal font30 leading34 space-0_3 text-white dmb-35">Forgot
                            password</div>

                            <div class=" position-relative dmb-20">
                                <x-text-input type="email" id="email" name="email" placeholder="Email……"
                                    :value="old('email')" autofocus autocomplete="email" />
                                <x-input-error :message="$errors->first('email')" />
                            </div>
                                <x-primary-button class="large-btn blue-btn">Sign up</x-primary-button>
                    </div>

                    <div class="bg-white dpt-30 dpb-30"><a href="{{ route('login') }}"
                            class="tk-basic-sans fw-normal font14 leading19 space-0_14 text-3C3C3C">Back to sign
                            in</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
