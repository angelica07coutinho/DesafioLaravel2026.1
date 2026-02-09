<x-modais id="editUserModal{{ $user->id }}" title="Editar Usuário">
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-3">
            <div class="flex gap-4">
                <div class="flex flex-col gap-3 w-full">
                    <div>
                        <x-input-label :value="__('Nome *')" />
                        <x-text-input id="edit-name" class="block mt-1 w-full" type="text" name="name" required value="{{ $user->name }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Email *')" />
                        <x-text-input id="edit-email" class="block mt-1 w-full" type="email" name="email" required value="{{ $user->email }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label class="text-nowrap" :value="__('Foto de Perfil')" />
                    <x-text-input id="edit-foto" class="block mt-1 h-28 w-28" type="file" name="foto" value="{{ $user->foto }}" />
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('CPF *')" />
                    <x-text-input id="edit-cpf" class="block mt-1 w-full" type="text" name="cpf" required value="{{ $user->cpf }}" />
                    <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('Data de Nascimento *')" />
                    <x-text-input id="edit-data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" required autocomplete="data_nascimento" value="{{ $user->data_nascimento }}" />
                    <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Telefone *')" />
                    <x-text-input id="edit-telefone" class="block mt-1 w-full" type="text" name="telefone" required value="{{ $user->telefone }}" />
                    <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('CEP *')" />
                    <x-text-input id="edit-cep-{{ $user->id }}" class="block mt-1 w-full" type="text" name="cep" required value="{{ $user->endereco->cep }}" />
                    <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Estado *')" />
                    <x-text-input id="edit-estado-{{ $user->id }}" class="block mt-1 w-full" type="text" name="estado" required readonly value="{{ $user->endereco->estado }}" />
                    <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('Cidade *')" />
                    <x-text-input id="edit-cidade-{{ $user->id }}" class="block mt-1 w-full" type="text" name="cidade" required readonly value="{{ $user->endereco->cidade }}" />
                    <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                </div>
            </div>
            <div class="w-full">
                <x-input-label :value="__('Bairro *')" />
                <x-text-input id="edit-bairro-{{ $user->id }}" class="block mt-1 w-full" type="text" name="bairro" required readonly value="{{ $user->endereco->bairro }}" />
                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Logradouro *')" />
                    <x-text-input id="edit-logradouro-{{ $user->id }}" class="block mt-1 w-full" type="text" name="logradouro" required readonly value="{{ $user->endereco->logradouro }}" />
                    <x-input-error :messages="$errors->get('logradouro')" class="mt-2" />
                </div>
                <div>
                    <x-input-label :value="__('Número *')" />
                    <x-text-input id="edit-numero-{{ $user->id }}" class="block mt-1 w-28" type="text" name="numero" required value="{{ $user->endereco->numero }}" />
                    <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                </div>
            </div>
            <div class="w-full">
                <x-input-label :value="__('Complemento')" />
                <x-text-input id="edit-complemento-{{ $user->id }}" class="block mt-1 w-full" type="text" name="complemento" value="{{ $user->endereco->complemento }}" />
                <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 gap-2">
            <div class="w-full align-center flex gap-2">
                <input type="checkbox" id="edit-tipo-{{ $user->id }}" name="tipo" value="admin" {{ $user->tipo === 'admin' ? 'checked' : '' }}
                    class="w-5 h-5 text-[#4a0051] cursor-pointer border-2 border-[#4a0051] rounded checked:bg-[#4a0051] checked:border-[#4a0051] focus:ring-2 focus:ring-[#4a0051] focus:outline-none">
                <label for="edit-tipo-{{ $user->id }}" class="text-base font-medium text-[#4a0051] cursor-pointer select-none">
                    Admin?
                </label>
            </div>
            <x-primary-button type="button" data-bs-dismiss="modal">Cancelar</x-primary-button>
            <x-secondary-button type="submit">{{ __('Salvar') }}</x-secondary-button>
        </div>
    </form>
</x-modais>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cepInput = document.getElementById('edit-cep-{{ $user->id }}');

        if (!cepInput) {
            alert('Digite um CEP válido.');
            return;
        }
        cepInput.addEventListener('blur', async function() {
            const cep = this.value.replace(/\D/g, '');

            if (cep.length === 8) {
                try {
                    const response = await fetch(`/api/cep/${cep}`);
                    const data = await response.json();

                    if (!data.error && !data.erro) {
                        document.getElementById('edit-estado-{{ $user->id }}').value = data.estado || '';
                        document.getElementById('edit-cidade-{{ $user->id }}').value = data.localidade || '';
                        document.getElementById('edit-bairro-{{ $user->id }}').value = data.bairro || '';
                        document.getElementById('edit-logradouro-{{ $user->id }}').value = data.logradouro || '';
                    } else {
                        alert('CEP não encontrado. Por favor, verifique o CEP e tente novamente.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('Erro ao buscar CEP. Tente novamente.');
                }
            }
        });
    });
</script>