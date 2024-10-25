@props(['message'])
@if ($message)
    <span class="invalid-feedback d-block text-start" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@endif
