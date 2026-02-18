@props(['route'])
<x-dropdown>
    <x-slot name="trigger">
        <button class="inline-flex gap-2 items-center px-3 py-2 border-2 border-[#a066a6] text-base font-bold rounded-lg text-[#f8e9f9] bg-[#4a0051] hover:text-[#a066a6] focus:outline-none transition ease-in-out duration-150">
            <div class="text-nowrap">
                @php
                $lista_categorias = [
                1 => 'Dispositivos Móveis',
                2 => 'Computadores e Notebooks',
                3 => 'Acessórios e Componentes',
                4 => 'Jogos e Consoles',
                5 => 'Som e Áudio',
                6 => 'Imagens e Vídeo',
                7 => 'Smart Home',
                8 => 'Cabos e Conectores',
                ];
                echo $lista_categorias[request('categoria')] ?? 'Filtrar';
                @endphp
            </div>
            <div>
                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </x-slot>
    <x-slot name="content">
        <x-dropdown-link :href="route($route, request()->only('busca'))">
            {{ __('Todas as Categorias') }}
        </x-dropdown-link>

        @foreach ($lista_categorias as $key => $categoria)
        <x-dropdown-link :href="route($route, array_merge(request()->only('busca'), ['categoria' => $key]))">
            {{ __($categoria) }}
        </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>