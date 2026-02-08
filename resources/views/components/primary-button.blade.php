<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#f8e9f9] border border-transparent hover:border-[#7066a6] rounded-md font-bold text-base text-[#4a0051] uppercase tracking-widest focus:bg-[#7066a6] focus:text-[#f8e9f9] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
