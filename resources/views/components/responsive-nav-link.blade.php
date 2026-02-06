@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#a066a6] text-start text-base font-medium text-[#a066a6] bg-[#4a005160] focus:outline-none focus:text-[#4a0051] focus:bg-[#a066a6] focus:border-[#4a0051] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#f8e9f9] hover:bg-[#a066a650] hover:border-[#a066a6] focus:outline-none focus:text-[#a066a6] focus:bg-[#a066a675] focus:border-[#a066a6] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
