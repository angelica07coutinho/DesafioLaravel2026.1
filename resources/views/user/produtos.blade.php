<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            @if (session('success'))
            <div class="text-green-600 text-center">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="text-red-600 text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="w-full gap-4 flex">
                <x-secondary-button type="button" class="text-nowrap" data-bs-toggle="modal" data-bs-target="#createProdutoModal">Criar Produto</x-secondary-button>
                <x-filtro-categoria route='user.produtos.index'></x-filtro-categoria>
                <x-pesquisa-produto route='user.produtos.index'></x-pesquisa-produto>
            </div>
            <div class="overflow-auto sm:rounded-lg border-2 border-[#a066a6]">
                <table class="min-w-full">
                    <thead class="bg-[#a066a6] text-[#f8e9f9]">
                        <tr>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-5">ID</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051]">Produto</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Quantidade</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Status</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Preço</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] w-20">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#4a0051c6] divide-y-2 divide-[#a066a6] text-[#f8e9f9]">
                        @foreach ($produtos as $produto)
                        <tr>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $produto->id }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">{{ $produto->nome }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $produto->quantidade }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center text-lg">
                                @if ($produto->status === 'disponivel')
                                <i class="bi bi-check-circle-fill text-green-600"></i>
                                @else
                                <i class="bi bi-x-circle-fill text-red-600"></i>
                                @endif
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">R${{ $produto->preco }}</td>
                            <td class="px-3 whitespace-nowrap">
                                <a href="#" class="text-xl hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#viewProdutoModal{{ $produto->id }}"><i class="bi bi-eye-fill"></i></a>
                                <a href="#" class="text-xl ms-3 hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#editProdutoModal{{ $produto->id }}"><i class="bi bi-pencil-fill"></i></a>
                                <a href="#" class="text-xl ms-3 hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#deleteProdutoModal{{ $produto->id }}"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                        <!-- Modal de Editar Produto -->
                        @include('user.edit-produto', ['produto' => $produto])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal de Criar Produto -->
        @include('user.create-produto')
    </div>
</x-app-layout>