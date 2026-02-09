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
                <x-secondary-button type="button" class="text-nowrap" data-bs-toggle="modal" data-bs-target="#createUserModal">Criar Usuário</x-secondary-button>
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="inline-flex gap-2 items-center px-3 py-2 border-2 border-[#a066a6] text-base font-bold rounded-lg text-[#f8e9f9] bg-[#4a0051] hover:text-[#a066a6] focus:outline-none transition ease-in-out duration-150">
                            <div>
                                @if(request('tipo') == 'admin')
                                    {{ __('Admins') }}
                                @elseif(request('tipo') == 'padrao')
                                    {{ __('Padrão') }}
                                @else
                                    {{ __('Todos') }}
                                @endif
                            </div>
                            <div>
                                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('users.index')">
                            {{ __('Todos') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('users.index', ['tipo' => 'admin'])">
                            {{ __('Admins') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('users.index', ['tipo' => 'padrao'])">
                            {{ __('Padrão') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <div class="w-full relative">
                    <input type="text" placeholder="Pesquisar Usuário..."
                        class="w-full bg-[#a066a6] border-2 border-[#4a0051] text-[#4a0051] placeholder:text-[#4a005180] rounded-lg px-3 py-2 focus:border-[#000] focus:ring-[#a066a6] focus:outline-none">
                    <i class="bi bi-search absolute right-3 top-1/2 transform -translate-y-1/2 text-[#4a0051] text-lg"></i>
                </div>
            </div>
            <div class="bg-[#a066a6] overflow-hidden sm:rounded-lg border-2 border-[#a066a6]">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-5">ID</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051]">Nome</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051]">Email</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] border-r border-[#4a0051] w-20">Tipo</th>
                            <th class="px-3 py-2 text-center text-lg font-bold text-[#4a0051] w-20">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#4a0051] divide-y-2 divide-[#a066a6] text-[#f8e9f9]">
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $user->id }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">{{ $user->name }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6]">{{ $user->email }}</td>
                            <td class="px-3 py-2 whitespace-nowrap border-r border-[#a066a6] text-center">{{ $user->tipo }}</td>
                            <td class="px-3 whitespace-nowrap">
                                <a href="#" class="text-xl hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}"><i class="bi bi-eye-fill"></i></a>
                                <a href="#" class="text-xl ms-3 hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}"><i class="bi bi-pencil-fill"></i></a>
                                <a href="#" class="text-xl ms-3 hover:text-[#a066a6]" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                        <!-- Modal de Visualizar Usuário -->
                        @include('admin.view-user', ['user' => $user])
                        <!-- Modal de Editar Usuário -->
                        @include('admin.edit-user', ['user' => $user])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal de Criar Usuário -->
        @include('admin.create-user')        
    </div>
</x-app-layout>

@foreach ($users as $user)
    <!-- Modal de Deletar Usuário -->
    @include('admin.delete-user', ['user' => $user])
@endforeach