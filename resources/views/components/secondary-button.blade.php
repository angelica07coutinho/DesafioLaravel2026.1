<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#4a0051] border-2 border-[#a066a6] hover:border-[#f8e9f9] rounded-lg font-bold text-base text-[#f8e9f9] tracking-widest focus:bg-[#a066a6] focus:text-[#4a0051] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
