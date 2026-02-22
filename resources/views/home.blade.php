<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <div class="w-full gap-4 flex">
                <x-filtro-categoria route='home'></x-filtro-categoria>
                <x-pesquisa-produto route='home'></x-pesquisa-produto>
            </div>
            <div class="w-full justify-between flex flex-wrap gap-4">
                @foreach ($produtos as $produto)
                <a href="{{ route('produto', $produto->id) }}" class="w-[250px] mb-8 bg-[#4a0051c3] rounded-lg overflow-hidden border-[3px] border-[#a066a6] flex flex-col gap-2 text-[#f8e9f9] hover:-translate-y-1 duration-200">
                    <img src="{{ Storage::url($produto->foto_produto) }}" alt="{{ $produto->nome }}" class="object-cover w-[250px] h-[250px] border-[#a066a6] border-b-[3px]">
                    <div class="flex flex-col p-3 pt-2 gap-1">
                        <h2 class="text-xl text-ellipsis max-w-max">{{ $produto->nome }}</h2>
                        <p class="text-2xl font-bold text-[#B57DBA]">R${{ $produto->preco }}</p>
                        @if (!isAdmin())
                        <div class="flex mt-2 justify-between items-center">
                            <button type="button" class="items-center px-2 py-1 bg-[#E2C4E5] hover:bg-[#a066a6] rounded-md font-bold text-lg text-[#4a0051] tracking-widest focus:bg-[#4a0051] focus:text-[#f8e9f9] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 duration-200 hover:transform hover:scale-105">
                                COMPRAR
                            </button>
                            <i class="bi bi-cart-plus text-3xl text-[#E2C4E5] hover:text-[#a066a6] cursor-pointer duration-200"></i> <!-- carrinho de compras depois -->
                        </div>
                        @else
                        <p class="mt-2">De: {{ $produto->vendedor->name }}</p>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
            <!-- Paginação -->
            {{ $produtos->links() }}
        </div>
    </div>
</x-app-layout>