@props(['disabled' => false])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'd-inline-flex align-items-center justify-content-center text-decoration-none tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 w-100 transition']) }} @disabled($disabled)>
    {{ $slot }}
</button>
