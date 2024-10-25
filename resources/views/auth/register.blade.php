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
                <img src="images/hero-img.jpg" class="w-100 h-100 object-cover" alt="">
            </div>
            <div class="position-fixed bottom-0 end-0 d-flex align-items-center me-5 mb-4">
                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-white me-1">Powered by</div>
                <div class="legacy-logo">
                    <img src="images/user.svg" class="w-100" alt="">
                </div>
            </div>
            <div class="dpt-80 dpb-80">
                <div class="col-8 mx-auto create-account-box h-100">
                    <div class="modal-bg-layer radius10 dpt-50 h-100 text-center dpb-75">
                        <div class="col-10 px-4 mx-auto dmb-45 h-100">
                            <div class="tk-basic-sans fw-normal font30 leading34 space-0_3 text-white dmb-15">Create an
                                account
                            </div>
                            <ul class="nav nav-tabs create-account-tabs bg-EBEBEB border-0 d-inline-flex align-items-center radius5 overflow-hidden px-1 dmb-25"
                                id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link active tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                                        id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                        role="tab" aria-controls="home" aria-selected="true">
                                        I’m a customer
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                                        id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                        role="tab" aria-controls="profile" aria-selected="false">
                                        I’m a professional
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row input-row">
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="first_name" placeholder="First Name…" :value="old('first_name')" required autofocus autocomplete="first_name" />
                                                <x-input-error :message="$errors->first('first_name')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="last_name" placeholder="Last Name…" :value="old('last_name')" required autocomplete="last_name" />
                                                <x-input-error :message="$errors->first('last_name')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="email" placeholder="Email……" :value="old('email')" required autocomplete="email" />
                                                <x-input-error :message="$errors->first('email')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="mobile" placeholder="Mobile Number (+44)" :value="old('mobile')" required autocomplete="mobile" />
                                                <x-input-error :message="$errors->first('mobile')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="password" name="password" placeholder="Password…" :value="old('password')" required autocomplete="new-password" />
                                                <x-input-error :message="$errors->first('password')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="password" name="password_confirmation" placeholder="Confirm Password…" required autocomplete="new-password" />
                                            </div>
                                        </div>
                                        <div class="tk-basic-sans font30 leading34 space-0_3 text-white dmt-45 dmb-35">
                                            Billing details</div>
                                        <div class="row input-row">
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="address1" placeholder="First line of address…" :value="old('address1')" required autocomplete="address1" />
                                                <x-input-error :message="$errors->first('address1')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="address2" placeholder="Second line of address…" :value="old('address2')" required autocomplete="address2" />
                                                <x-input-error :message="$errors->first('address2')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="country" placeholder="Country…" :value="old('country')" required autocomplete="country" />
                                                <x-input-error :message="$errors->first('country')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="postcode" placeholder="Postcode…" :value="old('postcode')" required autocomplete="postcode" />
                                                <x-input-error :message="$errors->first('postcode')" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="role" value="{{ \App\Models\User::ROLE_CUSTOMER }}">
                                        <x-primary-button class="large-btn blue-btn">Sign up</x-primary-button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row input-row">
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="first_name" placeholder="First Name…" :value="old('first_name')" required autofocus autocomplete="first_name" />
                                                <x-input-error :message="$errors->first('first_name')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="last_name" placeholder="Last Name…" :value="old('last_name')" required autocomplete="last_name" />
                                                <x-input-error :message="$errors->first('last_name')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="email" placeholder="Email……" :value="old('email')" required autocomplete="email" />
                                                <x-input-error :message="$errors->first('email')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="mobile" placeholder="Mobile Number (+44)" :value="old('mobile')" required autocomplete="mobile" />
                                                <x-input-error :message="$errors->first('mobile')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <select name="professional_type" class="js-select3 d-none" data-placeholder="Professional Type (Please select)">
                                                    <option></option>
                                                    @foreach (\App\Models\User::PROFESSIONAL_TYPES as $professionalType)
                                                        <option value="{{ $professionalType }}" {{ $professionalType == old('professional_type') ? 'selected' : '' }}>
                                                            {{ $professionalType }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="company_name" placeholder="Company Name…" :value="old('company_name')" required autocomplete="company_name" />
                                                <x-input-error :message="$errors->first('company_name')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="password" name="password" placeholder="Password…" :value="old('password')" required autocomplete="new-password" />
                                                <x-input-error :message="$errors->first('password')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="password" name="password_confirmation" placeholder="Confirm Password…" required autocomplete="new-password" />
                                            </div>
                                        </div>
                                        <div class="tk-basic-sans font30 leading34 space-0_3 text-white dmt-45 dmb-35">
                                            Billing details</div>
                                        <div class="row input-row">
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="address1" placeholder="First line of address…" :value="old('address1')" required autocomplete="address1" />
                                                <x-input-error :message="$errors->first('address1')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="address2" placeholder="Second line of address…" :value="old('address2')" required autocomplete="address2" />
                                                <x-input-error :message="$errors->first('address2')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="country" placeholder="Country…" :value="old('country')" required autocomplete="country" />
                                                <x-input-error :message="$errors->first('country')" />
                                            </div>
                                            <div class="col-6 position-relative dmb-20">
                                                <x-text-input type="text" name="postcode" placeholder="Postcode…" :value="old('postcode')" required autocomplete="postcode" />
                                                <x-input-error :message="$errors->first('postcode')" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="role" value="{{ \App\Models\User::ROLE_PROFESSIONAL }}">
                                        <x-primary-button class="large-btn blue-btn">Sign up</x-primary-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
