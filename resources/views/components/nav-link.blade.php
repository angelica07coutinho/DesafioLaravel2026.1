@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-[3px] border-[#a066a6] text-md font-medium leading-5 text-gray-100 focus:outline-none focus:border-[#a066a6] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-[3px] border-transparent text-md font-medium leading-5 text-[#f8e9f9] hover:text-[#a066a6] hover:border-[#a066a6] focus:outline-none focus:text-[#f8e9f9] focus:border-[#f8e9f9] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
