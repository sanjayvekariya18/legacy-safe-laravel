<p class="mt-1 text-sm text-gray-600">
    {{ __('Ensure your account is using a long, random password to stay secure.') }}
</p>
<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')
    <div class="row mb-3">
        <label for="update_password_current_password"
            class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

        <div class="col-md-6">
            <input id="update_password_current_password" type="password"
                class="form-control @error('update_password') is-invalid @enderror" name="current_password" required
                autocomplete="current-password">

            @error('update_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->updatePassword->get('current_password') }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="update_password_password"
            class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

        <div class="col-md-6">
            <input id="update_password_password" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="new-password">

            @error('update_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->updatePassword->get('password') }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="update_password_password_confirmation"
            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="update_password_password_confirmation" type="password" class="form-control"
                name="password_confirmation" required autocomplete="new-password">
            @error('update_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->updatePassword->get('password_confirmation') }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>
            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </div>
</form>
