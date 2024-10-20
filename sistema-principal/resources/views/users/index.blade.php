<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Usuários') }}
        </h2>
    </x-slot>
    <x-container>
        <div class="card-body">
            <!-- <x-alert /> -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('register') }}" class="bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                    Cadastrar Usuário
                </a>
            </div>

            <table class="min-w-full bg-white table-auto">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Id</th>
                        <th class="py-3 px-6 text-left">Nome</th>
                        <th class="py-3 px-6 text-left hidden md:table-cell">E-mail</th>
                        <th class="py-3 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $user->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                        <td class="py-3 px-6 text-left hidden md:table-cell">{{ $user->email }}</td>
                        <td class="py-3 px-6 flex justify-center space-x-2">
                            <a href="{{ route('user.show', ['user' => $user->id]) }}"
                                class="bg-blue-300 hover:bg-blue-400 text-white font-bold py-1 px-2 rounded text-sm flex items-center space-x-1">
                                <i class="fa-regular fa-eye"></i>
                                <span>Visualizar</span>
                            </a>

                            <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                class="bg-yellow-300 hover:bg-yellow-400 text-white font-bold py-1 px-2 rounded text-sm flex items-center space-x-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Editar</span>
                            </a>

                            <form id="formDelete{{ $user->id }}" method="POST"
                                action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="bg-red-300 hover:bg-red-400 text-white font-bold py-1 px-2 rounded text-sm flex items-center space-x-1"
                                    onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <span>Apagar</span>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="py-3 px-6 text-center">
                            <div class="bg-red-100 text-red-800 p-3 rounded-md">
                                Nenhum usuário encontrado.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                 <!-- Componente de paginação -->
                 {{ $users->links('components.pagination') }}
            </div>
        </div>
    </x-container>

</x-app-layout>