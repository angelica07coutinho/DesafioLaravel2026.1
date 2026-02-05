@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#7066a6] bg-[#f8e9f9] text-sm text-[#a066a6] focus:border-[#7066a6] focus:ring-[#7066a6] rounded-md shadow-sm']) }}>
