@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#4a0051]']) }}>
    {{ $value ?? $slot }}
</label>
