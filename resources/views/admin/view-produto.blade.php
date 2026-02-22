<x-modais id="viewProdutoModal{{ $produto->id }}" title="Visualizar Produto">
    <form action="">
        @csrf
        <div class="flex flex-col gap-3">
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Nome do Produto *')" />
                    <x-text-input id="view-nome-produto" class="block mt-1 w-full" type="text" name="nome" value="{{ $produto->nome }}" readonly />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>                
            </div>
            <div class="flex gap-4">
                <div>
                    <x-input-label class="text-nowrap" :value="__('Foto do Produto')" />
                    @if($produto->foto_produto)
                        <img src="{{ asset('storage/' . $produto->foto_produto) }}" alt="Foto do produto" class="block mt-1 h-48 w-48 object-cover rounded">
                    @else
                        <div class="block mt-1 h-48 w-48 bg-[#f8e9f9] rounded flex items-center justify-center text-[#a066a6]">Sem foto</div>
                    @endif
                    <x-input-error :messages="$errors->get('foto_produto')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <div>
                        <x-input-label :value="__('Categoria *')" />
                        <x-text-input id="view-categoria" class="block mt-1 w-full" type="text" name="categoria" value="{{ $produto->categoria->nome }}" readonly/>
                        <x-input-error :messages="$errors->get('id_categoria')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Preço (R$)*')" />
                        <x-text-input id="view-preco" class="block mt-1 w-full" type="number" name="preco" value="{{ $produto->preco }}" readonly />
                        <x-input-error :messages="$errors->get('preco')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label :value="__('Estoque *')" />
                        <x-text-input id="view-quantidade" class="block mt-1 w-full" type="number" name="quantidade" value="{{ $produto->quantidade }}" readonly />
                        <x-input-error :messages="$errors->get('quantidade')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Descrição *')" />
                    <x-textarea id="view-descricao" class="block mt-1 w-full" name="descricao" value="{{ $produto->descricao }}" rows="5" readonly />
                    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                </div>                
            </div>
            <h2 class="text-lg font-bold text-[#4a0051] mt-2">Informações do Vendedor</h2>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Nome *')" />
                    <x-text-input id="view-vendedor" class="block mt-1 w-full" type="text" name="vendedor" value="{{ $produto->vendedor->name }}" readonly />
                    <x-input-error :messages="$errors->get('vendedor')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('Email *')" />
                    <x-text-input id="view-email-vendedor" class="block mt-1 w-full" type="text" name="email_vendedor" value="{{ $produto->vendedor->email }}" readonly />
                    <x-input-error :messages="$errors->get('email_vendedor')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 gap-2">
            <div class="w-full align-center flex gap-2">
            <x-secondary-button type="button" data-bs-dismiss="modal">Fechar</x-secondary-button>
        </div>
    </form>
</x-modais>