<x-modais id="deleteUserModal{{ $user->id }}" maxWidth="lg">
    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('delete')
        <div class="flex flex-col gap-2">
            <p class="text-center text-lg font-bold text-[#4a0051]">Essa ação não pode ser desfeita.</p>
            <p class="text-center text-lg font-medium text-[#4a0051]">Deseja deletar este usuário?</p>
            <p class="text-center text-base text-[#a066a6]">{{ $user->name }} - {{ $user->email }}</p>

            <div class="flex items-center justify-center mt-4 gap-4">
                <x-primary-button type="button" data-bs-dismiss="modal">Cancelar</x-primary-button>
                <x-secondary-button type="submit">{{ __('Deletar') }}</x-secondary-button>
            </div>
        </div>
    </form>
</x-modais>