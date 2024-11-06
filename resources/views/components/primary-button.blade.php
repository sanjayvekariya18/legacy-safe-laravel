@props(['disabled' => false])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'd-inline-flex align-items-center justify-content-center text-decoration-none tk-basic-sans font16 leading19 space-0_16 radius7 transition']) }} @disabled($disabled)>
    {{ $slot }}
</button>
