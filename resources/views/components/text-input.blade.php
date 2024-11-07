@props(['disabled' => false, 'readonly' => false])

<input @disabled($disabled) @readonly($readonly) {{ $attributes->merge(['class' => 'tk-basic-sans fw-normal input  font16 leading24 space-0_16 w-100']) }}>
