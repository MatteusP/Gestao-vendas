<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Produtos') }}
        </h2>
    </x-slot>

    <x-container>
        <!-- Botão para cadastrar novo produto -->
        <div class="flex justify-between items-center mb-4">
            <!-- Filtro por nome -->
            <form action="{{ route('products.index') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nome"
                       class="shadow border rounded py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Buscar</button>
            </form>
            <a href="{{ route('products.create') }}"
               class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
               Cadastrar Produto
            </a>  
        </div>

        <!-- Botão de Alternância para Modo de Visualização -->
        <div class="flex justify-end mb-4">
            <div class="shadow p-2 rounded flex space-x-4 bg-gray-300">
                <button id="listViewButton" class="text-gray-800 font-bold py-2 px-4 rounded flex items-center hover:bg-gray-400">
                    <i class="fa-solid fa-list"></i> <!-- Ícone de lista -->
                </button>
                <button id="gridViewButton" class="text-gray-800 font-bold py-2 px-4 rounded flex items-center hover:bg-gray-400">
                    <i class="fa-solid fa-th-large"></i> <!-- Ícone de visualização de grade -->
                </button>
            </div>
        </div>

        <!-- Listagem de produtos (alterna entre grade e lista) -->
        <div id="productContainer" class="grid grid-cols-1 gap-4"> <!-- Inicialmente em lista -->
            @foreach($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="border p-4 rounded-lg shadow flex items-center justify-between hover:bg-gray-100 transition">
                <div>
                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p class="font-semibold">Preço: R$ {{ number_format($product->sale_price, 2, ',', '.') }}</p>
                    <p>Estoque: {{ $product->stock_quantity }}</p>
                </div>
                <img src="{{ asset('images/products/' . $product->image) }}"
                     alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-lg">
            </a>
            @endforeach
        </div>

        <!-- Links de paginação -->
        <div class="mt-4">
            {{ $products->links(('components.pagination')) }}
        </div>
    </x-container>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const listViewButton = document.getElementById('listViewButton');
            const gridViewButton = document.getElementById('gridViewButton');
            const productContainer = document.getElementById('productContainer');
            let isGridView = false; // Inicialmente em modo lista

            // Mudar para modo lista
            listViewButton.addEventListener('click', function() {
                if (!isGridView) return; // Já está no modo lista, não faz nada
                isGridView = false;
                productContainer.classList.remove('grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-4');
                productContainer.classList.add('grid-cols-1'); // Ajusta o layout para lista
                listViewButton.classList.add('bg-gray-400'); // Desabilita botão de lista
                gridViewButton.classList.remove('bg-gray-400'); // Habilita botão de grade
            });

            // Mudar para modo grade
            gridViewButton.addEventListener('click', function() {
                if (isGridView) return; // Já está no modo grade, não faz nada
                isGridView = true;
                productContainer.classList.remove('grid-cols-1');
                productContainer.classList.add('grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-4'); // Ajusta o layout para grid
                gridViewButton.classList.add('bg-gray-400'); // Desabilita botão de grade
                listViewButton.classList.remove('bg-gray-400'); // Habilita botão de lista
            });
        });
    </script>
</x-app-layout>
