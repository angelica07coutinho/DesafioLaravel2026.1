<x-modais id="sendEmailModal{{ $user->id }}" title="Enviar Email para {{ $user->name }}">
    <form action="{{ route('admin.users.email', $user->id) }}" method="POST">
        @csrf
        <div class="flex flex-col gap-3">
            <div>
                <x-input-label :value="__('Assunto *')" />
                <x-text-input id="email-assunto-{{ $user->id }}" class="block mt-1 w-full" type="text" name="assunto" required />
                <x-input-error :messages="$errors->get('assunto')" class="mt-2" />
            </div>
            <div>
                <x-input-label :value="__('Mensagem *')" />
                <x-textarea id="email-mensagem-{{ $user->id }}" class="block mt-1 w-full" name="mensagem" rows="5" required />
                <x-input-error :messages="$errors->get('mensagem')" class="mt-2" />
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <x-primary-button type="button" data-bs-dismiss="modal">Cancelar</x-primary-button>
                <x-secondary-button type="submit">{{ __('Enviar') }}</x-secondary-button>
            </div>
        </div>
    </form>
</x-modais>