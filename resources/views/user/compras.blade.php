<x-app-layout>
    <div class="flex flex-col gap-8 max-w-4xl mx-auto py-8">
        @foreach ($compras as $compra)
        <div class="flex flex-col bg-[#4a0051c3] gap-3 p-3 border-2 border-[#a066a6] rounded-lg">
            @foreach ($compra->itens as $item)
            <div class="flex gap-3 pb-3 border-b-2 border-[#a066a6] items-center">
                <div class="w-1/4">
                    <img src="/images/default.png" class="w-full h-auto object-cover">
                </div>
                <div class="w-3/4">
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