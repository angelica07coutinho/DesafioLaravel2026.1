<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center">
        <div class="w-1/2 bg-white p-6 rounded-lg border-2 border-[#a066a6] mb-4">
            <h2 class="text-center text-xl font-bold text-[#4a0051]">Vendas por Mês</h2>
            {!! $chart->renderHtml() !!}
            {!! $chart->renderChartJsLibrary() !!}
            {!! $chart->renderJs() !!}
        </div>
        <div class="w-full gap-4 flex mb-4">
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
                    <x-dropdown-link :href="route('user.vendas.index', request()->only('periodo'))">
                        {{ __('Mostrar Todas') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.vendas.index', array_merge(request()->only('periodo'), ['status' => 'concluida']))">
                        {{ __('Concluídas') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.vendas.index', array_merge(request()->only('periodo'), ['status' => 'pendente']))">
                        {{ __('Pendentes') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.vendas.index', array_merge(request()->only('periodo'), ['status' => 'cancelada']))">
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
                    <x-dropdown-link :href="route('user.vendas.index', request()->only('status'))">
                        {{ __('Todas as Datas') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.vendas.index', array_merge(request()->only('status'), ['periodo' => '1mes']))">
                        {{ __('Último Mês') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.vendas.index', array_merge(request()->only('status'), ['periodo' => '6meses']))">
                        {{ __('Últimos 6 Meses') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('user.vendas.index', array_merge(request()->only('status'), ['periodo' => '1ano']))">
                        {{ __('Último Ano') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
            <x-secondary-button class="text-nowrap ml-auto">
                Gerar Relatório PDF
            </x-secondary-button>
        </div>
        <div class="w-full overflow-auto sm:rounded-lg border-2 border-[#a066a6] mt-4">
            <table class="min-w-full">
                <thead class="bg-[#a066a6] text-[#f8e9f9]">
                    <tr>
                        <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-5">ID</th>
                        <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-2/3">Produto</th>
                        <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-1/3">Cliente</th>
                        <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Data</th>
                        <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Status</th>
                        <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] w-20 text-nowrap">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-[#4a0051c6] divide-y-2 divide-[#a066a6] text-[#f8e9f9]">
                    @foreach ($vendas as $venda)
                    <tr>
                        <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $venda->id }}</td>
                        <td class="px-3 py-2 border-r border-[#a066a6] max-w-xs overflow-hidden text-ellipsis whitespace-nowrap">{{ $venda->itens->first()->produto->nome }}</td>
                        <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">{{ $venda->cliente->name }}</td>
                        <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $venda->created_at->format('d/m/Y') }}</td>
                        <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center text-lg">
                            @if ($venda->status === 'pendente')
                            <i class="bi bi-exclamation-circle-fill text-yellow-600"></i>
                            @elseif ($venda->status === 'concluida')
                            <i class="bi bi-check-circle-fill text-green-600"></i>
                            @else
                            <i class="bi bi-x-circle-fill text-red-600"></i>
                            @endif
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">
                            R$ {{ number_format($venda->total, 2, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $vendas->links() }}
    </div>
</x-app-layout>