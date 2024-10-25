@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'tk-basic-sans fw-normal input white-input font16 leading24 space-0_16 border-0 w-100']) }}>
