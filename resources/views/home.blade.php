<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <div class="w-full gap-4 flex">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="inline-flex gap-2 items-center px-3 py-2 border-2 border-[#a066a6] text-base font-bold rounded-lg text-[#f8e9f9] bg-[#4a0051] hover:text-[#a066a6] focus:outline-none transition ease-in-out duration-150">
                            <div>
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
                        <x-dropdown-link :href="route('home', request()->only('busca'))">
                            {{ __('Todas as Categorias') }}
                        </x-dropdown-link>

                        @foreach ($lista_categorias as $key => $categoria)
                        <x-dropdown-link :href="route('home', array_merge(request()->only('busca'), ['categoria' => $key]))">
                            {{ __($categoria) }}
                        </x-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>
                <form method="GET" action="{{ route('home') }}" class="w-full relative">
                    @if(request('categoria'))
                    <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                    @endif
                    <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Pesquisar ..."
                        class="w-full bg-[#a066a6] border-2 border-[#4a0051] text-[#4a0051] placeholder:text-[#4a005180] rounded-lg px-3 py-2 pr-10 focus:border-[#000] focus:ring-[#a066a6] focus:outline-none">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#4a0051] text-lg hover:text-[#000]">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
            <div class="w-full justify-between flex flex-wrap gap-4">
                @foreach ($produtos as $produto)
                <a href="{{ route('produto', $produto->id) }}" class=" mb-8 bg-[#4a0051c3] rounded-lg overflow-hidden border-[3px] border-[#a066a6] flex flex-col gap-2 text-[#f8e9f9] hover:-translate-y-1 duration-200">
                    <img src="{{ $produto->foto }}" alt="{{ $produto->nome }}" class="object-cover w-[250px] h-[250px] border-[#a066a6] border-b-[3px]">
                    <div class="flex flex-col p-3 pt-2 gap-1">
                        <h2 class="text-xl">{{ $produto->nome }}</h2>
                        <p class="text-2xl font-bold text-[#B57DBA]">R${{ $produto->preco }}</p>
                        <div class="flex mt-2 justify-between items-center">
                            <button type="button" class="items-center px-2 py-1 bg-[#E2C4E5] hover:bg-[#a066a6] rounded-md font-bold text-lg text-[#4a0051] tracking-widest focus:bg-[#4a0051] focus:text-[#f8e9f9] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 duration-200 hover:transform hover:scale-105">
                                COMPRAR
                            </button>
                            <i class="bi bi-cart-plus text-3xl text-[#E2C4E5] hover:text-[#a066a6] cursor-pointer duration-200"></i> <!-- carrinho de compras depois -->
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>