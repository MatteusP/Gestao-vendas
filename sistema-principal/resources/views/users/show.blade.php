<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Usuário') }}
        </h2>
    </x-slot>
    <x-container>
    <div class="flex justify-between items-center p-4 border-b">
        <span class="text-lg font-semibold">Ver detalhes do Usuário</span>
        <div class="flex space-x-2">
            <a href="{{ route('users.index') }}" class="bg-blue-500 text-white py-1 px-3 rounded text-sm hover:bg-blue-600">
                <i class="fa-solid fa-list"></i> Usuários
            </a>
            <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="bg-yellow-500 text-white py-1 px-3 rounded text-sm hover:bg-yellow-600">
                <i class="fa-solid fa-pen-to-square"></i> Editar
            </a>
            <form method="POST" id="formDelete{{ $user->id }}" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                @csrf
                @method('delete')
                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded text-sm hover:bg-red-600 btnDelete" data-delete-id="{{ $user->id }}">
                    <i class="fa-regular fa-trash-can"></i> Apagar
                </button>
            </form>
        </div>
    </div>
    <div class="p-4">
        <x-alert />
        <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <dt class="font-semibold">Id</dt>
            <dd class="md:col-span-2">{{ $user->id }}</dd>

            <dt class="font-semibold">Nome do Usuário</dt>
            <dd class="md:col-span-2">{{ $user->name }}</dd>

            <dt class="font-semibold">E-mail</dt>
            <dd class="md:col-span-2">{{ $user->email }}</dd>

            <dt class="font-semibold">Data de Cadastrado</dt>
            <dd class="md:col-span-2">{{ \Carbon\Carbon::parse($user->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</dd>

            <dt class="font-semibold">Editado em</dt>
            <dd class="md:col-span-2">{{ \Carbon\Carbon::parse($user->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</dd>
        </dl>
</div>

    </x-container>

</x-app-layout>