<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Produto') }}
        </h2>
    </x-slot>

    <x-container>
        <!-- Formulário de cadastro de produto -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                <input type="text" name="name" id="name" required 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       value="{{ old('name') }}">
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea name="description" id="description" rows="4" required 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="purchase_price" class="block text-sm font-medium text-gray-700">Preço de Compra</label>
                <input type="number" name="purchase_price" id="purchase_price" required step="0.01" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       value="{{ old('purchase_price') }}">
                @error('purchase_price') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="sale_price" class="block text-sm font-medium text-gray-700">Preço de Venda</label>
                <input type="number" name="sale_price" id="sale_price" required step="0.01" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       value="{{ old('sale_price') }}">
                @error('sale_price') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantidade em Estoque</label>
                <input type="number" name="quantity" id="quantity" required 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       value="{{ old('quantity') }}">
                @error('quantity') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                <select name="category" id="category" required 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">Selecione uma Categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Imagem</label>
                <input type="file" name="image" id="image" required 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cadastrar Produto
                </button>
            </div>
        </form>
    </x-container>
</x-app-layout>
