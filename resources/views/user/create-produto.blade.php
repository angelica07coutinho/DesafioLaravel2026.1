<x-modais id="createProdutoModal" title="Adicionar Novo Produto" maxWidth="xl">
    <form action="{{ route('user.produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col gap-3">
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Nome do Produto *')" />
                    <x-text-input id="create-nome-produto" class="block mt-1 w-full" type="text" name="nome" required />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>                
            </div>
            <div class="flex gap-4">
                <div>
                    <x-input-label class="text-nowrap" :value="__('Foto do Produto')" />
                    <input type="file" name="foto_produto" id="create-foto" class="block w-full text-sm text-[#4a0051] file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#f8e9f9] file:text-[#a066a6] hover:file:bg-[#e0c7e0]" accept="image/*" />
                    <x-input-error :messages="$errors->get('foto_produto')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <div>
                        <x-input-label :value="__('Categoria *')" />
                        <select id="create-categoria" name="id_categoria" required class="block mt-1 w-full border-[#4a0051] bg-[#f8e9f9] text-sm text-[#a066a6] focus:border-[#4a0051] focus:ring-[#4a0051] rounded-md">
                            <option value="" disabled selected>Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_categoria')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Preço (R$)*')" />
                        <x-text-input id="create-preco" class="block mt-1 w-full" type="number" name="preco" required />
                        <x-input-error :messages="$errors->get('preco')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label :value="__('Estoque *')" />
                        <x-text-input id="create-quantidade" class="block mt-1 w-full" type="number" name="quantidade" required />
                        <x-input-error :messages="$errors->get('quantidade')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Descrição *')" />
                    <x-textarea id="create-descricao" class="block mt-1 w-full" name="descricao" rows="5" required />
                    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                </div>                
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 gap-2">
            <x-primary-button type="button" data-bs-dismiss="modal">Cancelar</x-primary-button>
            <x-secondary-button type="submit">{{ __('Adicionar') }}</x-secondary-button>
        </div>
    </form>
</x-modais>