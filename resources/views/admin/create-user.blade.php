<x-modais id="createUserModal" title="Adicionar Novo Usuário">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col gap-3">
            <div class="flex gap-4">
                <div class="flex flex-col gap-3 w-full">
                    <div>
                        <x-input-label :value="__('Nome *')" />
                        <x-text-input id="create-name" class="block mt-1 w-full" type="text" name="name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Email *')" />
                        <x-text-input id="create-email" class="block mt-1 w-full" type="email" name="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label class="text-nowrap" :value="__('Foto de Perfil')" />
                    <x-text-input id="create-foto" class="block mt-1 h-28 w-28" type="file" name="foto_perfil" />
                    <x-input-error :messages="$errors->get('foto_perfil')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('CPF *')" />
                    <x-text-input id="create-cpf" class="block mt-1 w-full" type="text" name="cpf" required />
                    <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('Data de Nascimento *')" />
                    <x-text-input id="create-data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" required autocomplete="data_nascimento" />
                    <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Telefone *')" />
                    <x-text-input id="create-telefone" class="block mt-1 w-full" type="text" name="telefone" required />
                    <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('CEP *')" />
                    <x-text-input id="create-cep" class="block mt-1 w-full" type="text" name="cep" required />
                    <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                </div>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Estado *')" />
                    <x-text-input id="create-estado" class="block mt-1 w-full" type="text" name="estado" required readonly />
                    <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label :value="__('Cidade *')" />
                    <x-text-input id="create-cidade" class="block mt-1 w-full" type="text" name="cidade" required readonly />
                    <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                </div>
            </div>
            <div class="w-full">
                <x-input-label :value="__('Bairro *')" />
                <x-text-input id="create-bairro" class="block mt-1 w-full" type="text" name="bairro" required readonly />
                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <x-input-label :value="__('Logradouro *')" />
                    <x-text-input id="create-logradouro" class="block mt-1 w-full" type="text" name="logradouro" required readonly />
                    <x-input-error :messages="$errors->get('logradouro')" class="mt-2" />
                </div>
                <div>
                    <x-input-label :value="__('Número *')" />
                    <x-text-input id="create-numero" class="block mt-1 w-28" type="text" name="numero" required />
                    <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                </div>
            </div>
            <div class="w-full">
                <x-input-label :value="__('Complemento')" />
                <x-text-input id="create-complemento" class="block mt-1 w-full" type="text" name="complemento" />
                <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label :value="__('Senha *')" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label :value="__('Confirmar Senha *')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 gap-2">
            <div class="w-full align-center flex gap-2">
                <input type="checkbox" id="create-tipo" name="tipo" value="admin" 
                    class="w-5 h-5 text-[#4a0051] cursor-pointer border-2 border-[#4a0051] rounded checked:bg-[#4a0051] checked:border-[#4a0051] focus:ring-2 focus:ring-[#4a0051] focus:outline-none">
                <label for="create-tipo" class="text-base font-medium text-[#4a0051] cursor-pointer select-none">
                    Admin?
                </label>
            </div>
            <x-primary-button type="button" data-bs-dismiss="modal">Cancelar</x-primary-button>
            <x-secondary-button type="submit">{{ __('Adicionar') }}</x-secondary-button>
        </div>
    </form>
</x-modais>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cepInput = document.getElementById('create-cep');

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
                        document.getElementById('create-estado').value = data.estado || '';
                        document.getElementById('create-cidade').value = data.localidade || '';
                        document.getElementById('create-bairro').value = data.bairro || '';
                        document.getElementById('create-logradouro').value = data.logradouro || '';
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