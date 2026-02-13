<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <div class="w-full gap-4 flex">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="inline-flex gap-2 items-center px-3 py-2 border-2 border-[#a066a6] text-base font-bold rounded-lg text-[#f8e9f9] bg-[#4a0051] hover:text-[#a066a6] focus:outline-none transition ease-in-out duration-150">
                            <div>
                                @if(request('categorias') == 1)
                                {{ __('Dispositivos Móveis') }}
                                @elseif(request('categorias') == 2)
                                {{ __('Computadores e Notebooks') }}
                                @elseif(request('categorias') == 3)
                                {{ __('Acessórios e Componentes') }}
                                @elseif(request('categorias') == 4)
                                {{ __('Jogos e Consoles') }}
                                @elseif(request('categorias') == 5)
                                {{ __('Som e Áudio') }}
                                @elseif(request('categorias') == 6)
                                {{ __('Imagens e Vídeo') }}
                                @elseif(request('categorias') == 7)
                                {{ __('Smart Home') }}
                                @elseif(request('categorias') == 8)
                                {{ __('Cabos e Conectores') }}
                                @else
                                {{ __('Categorias') }}
                                @endif
                            </div>
                            <div>
                                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link>
                            {{ __('Categorias') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Dispositivos Móveis') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Computadores e Notebooks') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Acessórios e Componentes') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Jogos e Consoles') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Som e Áudio') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Imagens e Vídeo') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Smart Home') }}
                        </x-dropdown-link>
                        <x-dropdown-link>
                            {{ __('Cabos e Conectores') }}
                        </x-dropdown-link>
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
                <div class=" mb-8 bg-[#4a0051c3] rounded-lg overflow-hidden border-[3px] border-[#a066a6] flex flex-col gap-2 text-[#f8e9f9] hover:-translate-y-1 duration-200">
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
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>