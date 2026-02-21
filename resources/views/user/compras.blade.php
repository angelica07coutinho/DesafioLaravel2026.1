<x-app-layout>
    <div class="flex flex-col gap-8 max-w-4xl mx-auto py-8">
        <div class="w-full gap-4 flex">
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="inline-flex gap-2 items-center px-3 py-2 border-2 border-[#a066a6] text-base font-bold rounded-lg text-[#f8e9f9] bg-[#4a0051] hover:text-[#a066a6] focus:outline-none transition ease-in-out duration-150">
                        <div class="text-nowrap">
                            @if(request('status') == 'concluida')
                            {{ __('Concluídas') }}
                            @elseif(request('status') == 'pendente')
                            {{ __('Pendentes') }}
                            @elseif(request('status') == 'cancelada')
                            {{ __('Canceladas') }}
                            @else
                            {{ __('Status') }}
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
                    <x-dropdown-link :href="route('user.compras.index', request()->only('periodo'))">
                        {{ __('Mostrar Todas') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.compras.index', array_merge(request()->only('periodo'), ['status' => 'concluida']))">
                        {{ __('Concluídas') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.compras.index', array_merge(request()->only('periodo'), ['status' => 'pendente']))">
                        {{ __('Pendentes') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.compras.index', array_merge(request()->only('periodo'), ['status' => 'cancelada']))">
                        {{ __('Canceladas') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>            
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="inline-flex gap-2 items-center px-3 py-2 border-2 border-[#a066a6] text-base font-bold rounded-lg text-[#f8e9f9] bg-[#4a0051] hover:text-[#a066a6] focus:outline-none transition ease-in-out duration-150">
                        <div class="text-nowrap">
                            @if(request('periodo') == '1mes')
                            {{ __('Último Mês') }}
                            @elseif(request('periodo') == '6meses')
                            {{ __('Últimos 6 Meses') }}
                            @elseif(request('periodo') == '1ano')
                            {{ __('Último Ano') }}
                            @else
                            {{ __('Período') }}
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
                    <x-dropdown-link :href="route('user.compras.index', request()->only('status'))">
                        {{ __('Todas as Datas') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.compras.index', array_merge(request()->only('status'), ['periodo' => '1mes']))">
                        {{ __('Último Mês') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.compras.index', array_merge(request()->only('status'), ['periodo' => '6meses']))">
                        {{ __('Últimos 6 Meses') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.compras.index', array_merge(request()->only('status'), ['periodo' => '1ano']))">
                        {{ __('Último Ano') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
            <x-secondary-button class="text-nowrap ml-auto">
                Gerar Relatório PDF
            </x-secondary-button>
        </div> 
        @foreach ($compras as $compra)
        <div class="flex flex-col bg-[#4a0051c3] gap-3 p-3 border-2 border-[#a066a6] rounded-lg">
            @foreach ($compra->itens as $item)
            <div class="flex gap-3 pb-3 border-b-2 border-[#a066a6] items-center">
                <div class="w-1/4">
                    <img src="/images/default.png" class="w-full h-auto object-cover">
                </div>
                <div class="w-3/4 flex flex-col gap-1">
                    <div class="flex justify-between">
                        <p class="text-md text-[#f8e9f9] bg-[#a066a6] px-3 my-1 rounded-full w-min text-nowrap">{{ $item->produto->categoria->nome }}</p>
                        <a href="{{ route('produto', $item->produto->id) }}" class="text-md text-[#f8e9f9] hover:underline">Mais informações ></a>
                    </div>
                    <h3 class="text-2xl font-bold text-[#f8e9f9]">{{ $item->produto->nome }}</h3>
                    <p class="text-lg text-[#f8e9f9]">De: {{ $item->produto->vendedor->name }}</p>
                    <p class="text-lg text-[#f8e9f9]">Preço: R$ {{ number_format($item->produto->preco, 2, ',', '.') }}</p>
                    <p class="text-lg text-[#f8e9f9]">Quantidade: {{ $item->quantidade }}</p>
                </div>
            </div>
            @endforeach
            <div>
                <p class="text-md text-[#f8e9f9]">Data da compra: {{ $compra->created_at->format('d/m/Y') }}</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <p class="text-md text-[#f8e9f9]">Status:</p>
                        <p class="text-md text-[#c593ca] font-semibold">{{ ucfirst(str_replace('_', ' ', $compra->status)) }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="text-md text-[#f8e9f9]">Total: </p>
                        <p class="text-lg font-semibold text-[#c593ca]">R$ {{ number_format($compra->total, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Paginação -->
        {{ $compras->links() }}
    </div>
</x-app-layout>