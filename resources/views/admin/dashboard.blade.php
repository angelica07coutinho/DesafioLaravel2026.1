<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center">
        <div class="flex w-full gap-4">
            <div class="w-2/5 flex flex-col gap-4">
                <div class="h-min bg-white p-6 rounded-lg border-2 border-[#a066a6]">
                    <h2 class="text-center text-xl font-bold text-[#4a0051] mb-2">Produtos Cadastrados por Mês</h2>
                    {!! $chartP->renderHtml() !!}
                    {!! $chartP->renderChartJsLibrary() !!}
                    {!! $chartP->renderJs() !!}
                </div>
                <div class="h-min bg-white p-6 rounded-lg border-2 border-[#a066a6]">
                    <h2 class="text-center text-xl font-bold text-[#4a0051] mb-2">Vendas Realizadas por Mês</h2>
                    {!! $chartV->renderHtml() !!}
                    {!! $chartV->renderChartJsLibrary() !!}
                    {!! $chartV->renderJs() !!}
                </div>
            </div>
            <div class="w-3/5">
                <div class="w-full gap-4 flex mb-4">
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
                            <x-dropdown-link :href="route('admin.dashboard', request()->only('status'))">
                                {{ __('Todas as Datas') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.dashboard', array_merge(request()->only('status'), ['periodo' => '1mes']))">
                                {{ __('Último Mês') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.dashboard', array_merge(request()->only('status'), ['periodo' => '6meses']))">
                                {{ __('Últimos 6 Meses') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.dashboard', array_merge(request()->only('status'), ['periodo' => '1ano']))">
                                {{ __('Último Ano') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    <div class="ml-auto gap-4 flex">
                        <x-secondary-button class="text-nowrap">
                            <a href="{{ route('admin.relatorio.pdf', request()->all()) }}">
                                Relatório PDF
                            </a>
                        </x-secondary-button>
                        <x-secondary-button class="text-nowrap">
                            <a href="{{ route('admin.relatorio.excel', request()->all()) }}">
                                Relatório XLSX
                            </a>
                        </x-secondary-button>
                    </div>
                </div>
                <div class="overflow-auto sm:rounded-lg border-2 border-[#a066a6] mb-4">
                    <table class="min-w-full">
                        <thead class="bg-[#a066a6] text-[#f8e9f9]">
                            <tr>
                                <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-2/3">Produto</th>
                                <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-1/3">Cliente</th>
                                <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Data</th>
                                <!-- <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Status</th> -->
                                <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] w-20 text-nowrap">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#4a0051c6] divide-y-2 divide-[#a066a6] text-[#f8e9f9]">
                            @foreach ($vendas as $venda)
                            <tr>
                                <td class="px-3 py-2 border-r border-[#a066a6] max-w-40 overflow-hidden text-ellipsis whitespace-nowrap">{{ $venda->itens->first()->produto->nome }}</td>
                                <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">{{ $venda->cliente->name }}</td>
                                <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $venda->created_at->format('d/m/Y') }}</td>
                                <!-- <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center text-lg">
                                    @if ($venda->status === 'pendente')
                                    <i class="bi bi-exclamation-circle-fill text-yellow-600"></i>
                                    @elseif ($venda->status === 'concluida')
                                    <i class="bi bi-check-circle-fill text-green-600"></i>
                                    @else
                                    <i class="bi bi-x-circle-fill text-red-600"></i>
                                    @endif
                                </td> -->
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
        </div>
    </div>
</x-app-layout>