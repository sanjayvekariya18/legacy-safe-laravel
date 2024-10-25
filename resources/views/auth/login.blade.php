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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <main>
        <section class="modal-box-section h-vh position-relative w-100">
            <img src="assets/images/hero-img.jpg" class="w-100 h-100 object-cover" alt="">
            <div class="position-fixed bottom-0 end-0 d-flex align-items-center me-5 mb-4">
                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-white me-1">Powered by</div>
                <div class="legacy-logo">
                    <img src="assets/images/user.svg" class="w-100" alt="">
                </div>
            </div>
            <div class="position-absolute top-left-center w-100">
                <div class="col-4 mx-auto px-4">
                    <div class="modal-bg-layer radius10 dpt-45 text-center overflow-hidden">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="modal-box-data dmb-55">
                                <div class="tk-basic-sans fw-normal font30 leading34 space-0_3 text-white dmb-35">Sign
                                    in
                                </div>
                                <div class="position-relative dmb-20">
                                    <x-text-input type="text" name="email"
                                        placeholder="Email address…" :value="old('email')" required autofocus
                                        autocomplete="email" />
                                    <x-input-error :message="$errors->first('email')" />
                                </div>

                                <div class="position-relative dmb-20">
                                    <x-text-input type="password" name="password" placeholder="Password…"
                                        :value="old('password')" required autofocus autocomplete="password" />
                                    <x-input-error :message="$errors->first('password')" />

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="d-inline-block position-absolute top-center pe-4 end-0 tk-basic-sans fw-normal font12 leading19 space-0_12 text-797979">Forgot
                                            your password?</a>
                                    @endif
                                </div>
                                <div
                                    class="checkbox-container position-relative d-inline-flex align-items-center tk-basic-sans fw-normal font16 leading30 space-0_16 text-white dmb-20">
                                    <input type="checkbox" name="remember" id="remember"
                                        class="opacity-0 position-absolute top-0 start-0"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <span class="check-box white-checkbox radius7 position-relative me-2"></span>
                                    Click to remember me
                                </div>
                                <x-primary-button class="large-btn blue-btn">Sign me in</x-primary-button>
                            </div>
                        </form>
                        <div class="bg-white dpt-30 dpb-30">
                            <div class="tk-basic-sans fw-normal font14 leading19 space-0_14 text-3C3C3C">
                                Need an account?
                                <a href="{{ route('register') }}" class="d-inline-block text-3C3C3C"> Sign up here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
