<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <span class="w-12 h-12">
        <i class="fas fa-store text-3xl"></i>
        </span>
        <h1 class="text-2xl font-bold hidden sm:block">Sistema de Vendas</h1>
    </div>
    <nav class="space-x-6">
        <a href="#sobre" class="text-gray-700 hover:text-blue-500">Sobre</a>
        <a href="/" class="text-gray-700 hover:text-blue-500">Funcionalidades</a>
        <a href="#documentacao" class="text-gray-700 hover:text-blue-500">Documentação</a>
    </nav>
    </div>
</header>
<x-guest-layout>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <!-- Caixa de Login -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg rounded-lg overflow-hidden">
            
            <!-- Área Restrita -->
            <div class="text-center mb-6">
                <h1 class="text-gray-900 text-3xl font-bold">Área Restrita</h1>
            </div>

            <!-- Status da Sessão -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Erros de Validação -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Endereço de E-mail -->
                <div>
                    <x-label for="email" :value="__('E-mail')" class="text-gray-700 font-semibold" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-gray-600 focus:ring-gray-600 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Senha -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Senha')" class="text-gray-700 font-semibold" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-gray-600 focus:ring-gray-600 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Lembrar de Mim -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-600 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2">{{ __('Lembrar-me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-gray-900 font-semibold" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif
                </div>

                <!-- Botão de Login -->
                <div class="mt-6 mb-4">
                    <x-button class="w-full justify-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-900 text-white font-bold rounded-md hover:from-gray-500 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-150 ease-in-out shadow-md">
                        {{ __('Entrar') }}
                    </x-button>
                </div>
            </form>
        </div>

        <!-- Adiciona espaçamento extra abaixo do card -->
        <div class="mt-8"></div>
    </div>
</x-guest-layout>
