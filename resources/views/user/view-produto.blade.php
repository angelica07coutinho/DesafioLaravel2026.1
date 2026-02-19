<x-modais id="viewProdutoModal{{ $produto->id }}" title="Visualizar Produto">
    <form action="">
        @csrf
        <div class="flex flex-col gap-3">
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Nome do Produto *')" />
                    <x-text-input id="create-nome-produto" class="block mt-1 w-full" type="text" name="nome" value="{{ $produto->nome }}" readonly />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>                
            </div>
            <div class="flex gap-4">
                <div>
                    <x-input-label class="text-nowrap" :value="__('Foto do Produto')" />
                    <x-text-input id="create-foto" class="block mt-1 h-48 w-48" type="file" name="foto_produto" value="{{ $produto->foto_produto }}" readonly/>
                    <x-input-error :messages="$errors->get('foto_produto')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <div>
                        <x-input-label :value="__('Categoria *')" />
                        <x-text-input id="create-categoria" class="block mt-1 w-full" type="text" name="categoria" value="{{ $produto->categoria->nome }}" readonly/>
                        <x-input-error :messages="$errors->get('id_categoria')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Preço (R$)*')" />
                        <x-text-input id="create-preco" class="block mt-1 w-full" type="number" name="preco" value="{{ $produto->preco }}" readonly />
                        <x-input-error :messages="$errors->get('preco')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label :value="__('Estoque *')" />
                        <x-text-input id="create-quantidade" class="block mt-1 w-full" type="number" name="quantidade" value="{{ $produto->quantidade }}" readonly />
                        <x-input-error :messages="$errors->get('quantidade')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Descrição *')" />
                    <x-text-input id="create-descricao" class="block mt-1 w-full" type="text" name="descricao" value="{{ $produto->descricao }}" readonly />
                    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                </div>                
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 gap-2">
            <div class="w-full align-center flex gap-2">
            <x-secondary-button type="button" data-bs-dismiss="modal">Fechar</x-secondary-button>
        </div>
    </form>
</x-modais>