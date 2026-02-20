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
                <x-filtro-categoria route='admin.produtos.index'></x-filtro-categoria>
                <x-pesquisa-produto route='admin.produtos.index'></x-pesquisa-produto>
            </div>
            <div class="overflow-auto sm:rounded-lg border-2 border-[#a066a6]">
                <table class="min-w-full">
                    <thead class="bg-[#a066a6] text-[#f8e9f9]">
                        <tr>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-5">ID</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-2/3">Produto</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-1/3">Vendedor</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Preço</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] w-20">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#4a0051c6] divide-y-2 divide-[#a066a6] text-[#f8e9f9]">
                        @foreach ($produtos as $produto)
                        <tr>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $produto->id }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">{{ $produto->nome }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">
                                <div class="flex justify-between items-center gap-2">
                                    <p>{{ $produto->vendedor->name }}</p>
                                    <a href="#" class="text-xl hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#sendEmailModal{{ $produto->vendedor->id }}"><i class="bi bi-envelope-fill"></i></a>
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">R${{ $produto->preco }}</td>
                            <td class="px-3 whitespace-nowrap">
                                <a href="#" class="text-xl hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#viewProdutoModal{{ $produto->id }}"><i class="bi bi-eye-fill"></i></a>
                                <a href="#" class="text-xl ms-3 hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#deleteProdutoModal{{ $produto->id }}"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                        <!-- Modal de Visualizar Produto -->
                        @include('admin.view-produto', ['produto' => $produto])
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Paginação -->
            {{ $produtos->links() }}
        </div> 
    </div>
</x-app-layout>

@foreach ($produtos as $produto)
    <!-- Modal de Enviar Email -->
    @include('admin.send-email', ['user' => $produto->vendedor])
    <!-- Modal de Deletar Produto -->
    @include('admin.delete-produto', ['produto' => $produto])
@endforeach