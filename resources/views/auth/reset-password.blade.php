<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Legacy Safe') }} | Sign In</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fuse.typekit.net">
    <link rel="stylesheet" href="https://use.typekit.net/nan6ioj.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/select2.min.js'])
</head>

<body>
    <main>
        <section class="modal-box-section h-vh position-relative w-100">
            <img src="{{ asset('images/signin-page-img.png') }}" class="w-100 h-100 object-cover" alt="">
            <div class="position-fixed bottom-0 end-0 d-flex align-items-center me-5 mb-4">
                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-white me-1">Powered by</div>
                <div class="legacy-logo">
                    <img src="{{ asset('images/legecy-logo.svg') }}" class="w-100" alt="">
                </div>
            </div>
            <div class="position-absolute top-left-center w-100">
                <div class="col-4 mx-auto px-4">
                    <div class="modal-bg-layer radius10 dpt-45 text-center overflow-hidden">
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="modal-box-data dmb-55">
                                <div class="tk-basic-sans fw-normal font30 leading34 space-0_3 text-white dmb-35">Reset
                                    Password
                                </div>
                                <div class="position-relative dmb-20">
                                    <x-text-input class="white-input border-0" type="text" name="email"
                                        placeholder="Email address…" :value="old('email', $email)" required autocomplete="email" />
                                    <x-input-error :message="$errors->first('email')" />
                                </div>

                                <div class="position-relative dmb-20">
                                    <x-text-input class="white-input border-0" type="password" name="password"
                                        placeholder="Password…" :value="old('password')" required autofocus
                                        autocomplete="password" />

                                </div>
                                <div class="position-relative dmb-20">
                                    <x-text-input class="white-input border-0" type="password"
                                        name="password_confirmation" placeholder="Confirm Password…" required
                                        autocomplete="new-password" />
                                    <x-input-error :message="$errors->first('password')" />
                                </div>
                                <x-primary-button class="large-btn blue-btn w-100 fw-normal">Reset
                                    Password</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
