@if ($errors->has($field))
    <span id="error-{{ $field }}" class="error-message" style="color: red;">
        {{ $errors->first($field) }}
    </span>
@endif


