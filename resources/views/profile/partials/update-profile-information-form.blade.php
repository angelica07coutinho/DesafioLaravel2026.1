<section>
    <header>
        <h2 class="text-lg font-bold text-[#4a0051]">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-[#a066a6]">
            {{ __("Atualize as informações do seu perfil.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label class="text-nowrap" :value="__('Foto de Perfil')" />
            @if($user->foto_perfil)
                <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="Foto atual" class="block mt-1 h-28 w-28 object-cover rounded mb-2">
            @endif
            <input type="file" name="foto_perfil" id="profile-foto" class="block w-full text-sm text-[#4a0051] file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#f8e9f9] file:text-[#a066a6] hover:file:bg-[#e0c7e0]" accept="image/*" />
            <x-input-error :messages="$errors->get('foto_perfil')" class="mt-2" />
        </div>

        <div class="flex w-full gap-4">
            <div class="w-full">
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="flex w-full gap-4">
            <div class="w-full">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf', $user->cpf)" required />
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone', $user->telefone)" required />
                <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" class="text-nowrap" />
            <x-text-input id="data_nascimento" class="block mt-1" type="date" name="data_nascimento" :value="old('data_nascimento', $user->data_nascimento)" required />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

        <h3 class="text-md font-semibold text-[#4a0051] mt-6">{{ __('Endereço') }}</h3>

        <div class="w-full pr-8">
            <x-input-label for="profile-cep" :value="__('CEP')" />
            <x-text-input id="profile-cep" class="block mt-1 w-[33%]" type="text" name="cep" :value="old('cep', $user->endereco->cep ?? '')" required />
            <x-input-error :messages="$errors->get('cep')" class="mt-2" />
        </div>
        <div class="flex w-full gap-4">
            <div class="w-full">
                <x-input-label for="profile-cidade" :value="__('Cidade')" />
                <x-text-input id="profile-cidade" class="block mt-1 w-full" type="text" name="cidade" :value="old('cidade', $user->endereco->cidade ?? '')" readonly />
                <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="profile-estado" :value="__('Estado')" />
                <x-text-input id="profile-estado" class="block mt-1 w-full" type="text" name="estado" :value="old('estado', $user->endereco->estado ?? '')" readonly />
                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="profile-bairro" :value="__('Bairro')" />
                <x-text-input id="profile-bairro" class="block mt-1 w-full" type="text" name="bairro" :value="old('bairro', $user->endereco->bairro ?? '')" required readonly />
                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
            </div>
        </div>

        <div class="flex w-full gap-4">
            <div class="w-full">
                <x-input-label for="profile-logradouro" :value="__('Logradouro')" />
                <x-text-input id="profile-logradouro" class="block mt-1 w-full" type="text" name="logradouro" :value="old('logradouro', $user->endereco->logradouro ?? '')" required readonly />
                <x-input-error :messages="$errors->get('logradouro')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="profile-numero" :value="__('Número')" />
                <x-text-input id="profile-numero" class="block mt-1 w-full" type="text" name="numero" :value="old('numero', $user->endereco->numero ?? '')" required />
                <x-input-error :messages="$errors->get('numero')" class="mt-2" />
            </div>

            <div class="w-full">
                <x-input-label for="profile-complemento" :value="__('Complemento')" />
                <x-text-input id="profile-complemento" class="block mt-1 w-full" type="text" name="complemento" :value="old('complemento', $user->endereco->complemento ?? '')" />
                <x-input-error :messages="$errors->get('complemento')" class="mt-2" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>
        </div>


        <div class="flex items-center gap-4">
            <x-secondary-button>{{ __('Salvar') }}</x-secondary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-[#a066a6]">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cepInput = document.getElementById('profile-cep');

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
                        document.getElementById('profile-estado').value = data.estado || '';
                        document.getElementById('profile-cidade').value = data.localidade || '';
                        document.getElementById('profile-bairro').value = data.bairro || '';
                        document.getElementById('profile-logradouro').value = data.logradouro || '';
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