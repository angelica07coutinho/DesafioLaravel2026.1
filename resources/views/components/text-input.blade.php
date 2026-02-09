@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#4a0051] bg-[#f8e9f9] text-sm text-[#a066a6] focus:border-[#4a0051] focus:ring-[#4a0051] rounded-md']) }}>
