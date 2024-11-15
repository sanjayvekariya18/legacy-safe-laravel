<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Legacy Safe') }} | Sign up</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fuse.typekit.net">
    <link rel="stylesheet" href="https://use.typekit.net/nan6ioj.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/select2.min.js'])
</head>

<body>
    <main>
        <section class="modal-box-section h-vh w-100">
            <div class="position-fixed h-100 w-100 top-0 start-0">
                <img src="images/signin-page-img.png" class="w-100 h-100 object-cover" alt="">
            </div>
            <div class="position-fixed bottom-0 end-0 d-flex align-items-center me-5 mb-4">
                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-white me-1">Powered by</div>
                <div class="legacy-logo">
                    <img src="images/legecy-logo.svg" class="w-100" alt="">
                </div>
            </div>
            <div class="dpt-80 dpb-80">
                <div class="col-8 mx-auto create-account-box h-100">
                    <div class="modal-bg-layer radius10 dpt-50 h-100 text-center dpb-75">
                        <div class="col-10 px-4 mx-auto dmb-45 h-100">
                            <div class="tk-basic-sans fw-normal font30 leading34 space-0_3 text-white dmb-15">Create an
                                account
                            </div>
                            <form method="POST" action="{{ route('invite.register') }}">
                                @csrf
                                <div class="row input-row">
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="first_name"
                                            placeholder="First Name…" :value="old('first_name')" required autofocus
                                            autocomplete="first_name" />
                                        <x-input-error :message="$errors->first('first_name')" />
                                    </div>
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="last_name"
                                            placeholder="Last Name…" :value="old('last_name')" required
                                            autocomplete="last_name" />
                                        <x-input-error :message="$errors->first('last_name')" />
                                    </div>
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="email"
                                            placeholder="Email……" :value="$invite->email" autocomplete="email"
                                            :readonly="true" />
                                    </div>
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="mobile_number"
                                            placeholder="Mobile Number (+44)" :value="old('mobile_number')" required
                                            autocomplete="mobile_number" />
                                        <x-input-error :message="$errors->first('mobile_number')" />
                                    </div>
                                    @if ($invite->role == \App\Models\User::ROLE_PROFESSIONAL)
                                        <div class="col-6 position-relative dmb-20">
                                            <select name="professional_type" class="js-select3 d-none"
                                                data-placeholder="Professional Type (Please select)" disabled>
                                                <option></option>
                                                @foreach (\App\Models\User::PROFESSIONAL_TYPES as $professionalType)
                                                    <option value="{{ $professionalType }}"
                                                        {{ $professionalType == $invite->professional_type ? 'selected' : '' }}>
                                                        {{ $professionalType }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 position-relative dmb-20">
                                            <x-text-input class="white-input border-0" type="text"
                                                name="company_name" placeholder="Company Name…" :value="old('company_name')"
                                                required autocomplete="company_name" />
                                            <x-input-error :message="$errors->first('company_name')" />
                                        </div>
                                    @endif
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="password" name="password"
                                            placeholder="Password…" :value="old('password')" required
                                            autocomplete="new-password" />
                                        <x-input-error :message="$errors->first('password')" />
                                    </div>
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="password"
                                            name="password_confirmation" placeholder="Confirm Password…" required
                                            autocomplete="new-password" />
                                    </div>
                                </div>
                                <div class="tk-basic-sans font30 leading34 space-0_3 text-white dmt-45 dmb-35">
                                    Billing details</div>
                                <div class="row input-row">
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="address1"
                                            placeholder="First line of address…" :value="old('address1')" required
                                            autocomplete="address1" />
                                        <x-input-error :message="$errors->first('address1')" />
                                    </div>
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="address2"
                                            placeholder="Second line of address…" :value="old('address2')" required
                                            autocomplete="address2" />
                                        <x-input-error :message="$errors->first('address2')" />
                                    </div>
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="country"
                                            placeholder="Country…" :value="old('country')" required autocomplete="country" />
                                        <x-input-error :message="$errors->first('country')" />
                                    </div>
                                    <div class="col-6 position-relative dmb-20">
                                        <x-text-input class="white-input border-0" type="text" name="postcode"
                                            placeholder="Postcode…" :value="old('postcode')" required
                                            autocomplete="postcode" />
                                        <x-input-error :message="$errors->first('postcode')" />
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="{{ $invite->token }}">
                                <input type="hidden" name="role" value="{{ \App\Models\User::ROLE_CLIENT }}">
                                <x-primary-button class="large-btn blue-btn w-100 fw-normal">Sign
                                    up</x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
</body>

</html>
