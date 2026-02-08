<x-modais id="viewUserModal{{ $user->id }}" title="Visualizar Usuário">
    <form action="{{ route('users.view') }}" method="GET">
        @csrf
        <div class="flex flex-col gap-3">
            <div class="flex gap-4">
                <div class="flex flex-col gap-3 w-full">
                    <div>
                        <x-input-label :value="__('Nome *')" />
                        <x-text-input id="view-name" class="block mt-1 w-full" type="text" name="name" readonly value="{{ $user->name }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Email *')" />
                        <x-text-input id="view-email" class="block mt-1 w-full" type="email" name="email" readonly value="{{ $user->email }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label class="text-nowrap" :value="__('Foto de Perfil')" />
                    <x-text-input id="view-foto" class="block mt-1 h-28 w-28" type="file" name="foto" readonly />
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('CPF *')" />
                    <x-text-input id="view-cpf" class="block mt-1 w-full" type="text" name="cpf" readonly value="{{ $user->cpf }}" />
                    <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('Data de Nascimento *')" />
                    <x-text-input id="view-data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" readonly autocomplete="data_nascimento" value="{{ $user->data_nascimento }}" />
                    <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Telefone *')" />
                    <x-text-input id="view-telefone" class="block mt-1 w-full" type="text" name="telefone" readonly value="{{ $user->telefone }}" />
                    <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('CEP *')" />
                    <x-text-input id="view-cep" class="block mt-1 w-full" type="text" name="cep" readonly value="{{ $user->endereco->cep ?? '' }}" />
                    <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Estado *')" />
                    <x-text-input id="view-estado" class="block mt-1 w-full" type="text" name="estado" readonly value="{{ $user->endereco->estado ?? '' }}" />
                    <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('Cidade *')" />
                    <x-text-input id="view-cidade" class="block mt-1 w-full" type="text" name="cidade" readonly value="{{ $user->endereco->cidade ?? '' }}" />
                    <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                </div>
            </div>
            <div class="w-full">
                <x-input-label :value="__('Bairro *')" />
                <x-text-input id="view-bairro" class="block mt-1 w-full" type="text" name="bairro" readonly value="{{ $user->endereco->bairro ?? '' }}" />
                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Logradouro *')" />
                    <x-text-input id="view-logradouro" class="block mt-1 w-full" type="text" name="logradouro" readonly value="{{ $user->endereco->logradouro ?? '' }}" />
                    <x-input-error :messages="$errors->get('logradouro')" class="mt-2" />
                </div>
                <div>
                    <x-input-label :value="__('Número *')" />
                    <x-text-input id="view-numero" class="block mt-1 w-28" type="text" name="numero" readonly value="{{ $user->endereco->numero ?? '' }}" />
                    <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                </div>
            </div>
            <div class="w-full">
                <x-input-label :value="__('Complemento')" />
                <x-text-input id="view-complemento" class="block mt-1 w-full" type="text" name="complemento" readonly value="{{ $user->endereco->complemento ?? '' }}" />
                <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 gap-2">
            <x-secondary-button type="button" data-bs-dismiss="modal">Fechar</x-secondary-button>
        </div>
    </form>
</x-modais>