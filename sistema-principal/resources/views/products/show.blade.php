<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Produto') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p class="font-semibold">Preço: R$ {{ number_format($product->sale_price, 2, ',', '.') }}</p>
                <p>Estoque: {{ $product->stock_quantity }}</p>
            </div>
            <img src="{{ asset('images/products/' . $product->image) }}"
                 alt="{{ $product->name }}" class="w-60 h-60 object-cover rounded-lg">
        </div>

        <!-- Seção para quantidade e total -->
        <div class="mb-6">
            <label for="quantity" class="block font-semibold text-gray-800">Quantidade:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}"
                   class="shadow border rounded py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>

        <!-- Exibição do total da compra -->
        <div class="mb-4">
            <p class="font-semibold text-lg">Total: R$ <span id="totalPrice">{{ number_format($product->sale_price, 2, ',', '.') }}</span></p>
        </div>

        <!-- Aplicar cupom de desconto -->
        <div class="mb-4">
            <label for="coupon_code" class="block font-semibold text-gray-800">Cupom de Desconto:</label>
            <input type="text" id="coupon_code" name="coupon_code" placeholder="Insira o código do cupom"
                   class="shadow border rounded py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            <button id="applyCoupon" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-2">Aplicar Cupom</button>
        </div>

        <!-- Total após aplicação de cupom -->
        <div class="mb-4">
            <p class="font-semibold text-lg">Total com Desconto: R$ <span id="discountedTotal">--</span></p>
        </div>

        <!-- Botão para realizar a venda -->
        <button id="makePurchase" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Realizar Venda</button>
    </x-container>

    <!-- Modal para inserir dados do cliente -->
    <div id="customerModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl relative">
            <!-- Botão para fechar o modal -->
            <button id="closeModal" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full">X</button>
            
            <h2 class="text-2xl font-semibold mb-4">Dados do Cliente</h2>
            
            <form id="purchaseForm" method="POST" action="{{ route('sales.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="quantityField">
                <input type="hidden" name="coupon_code" id="couponCodeField">
                <input type="hidden" name="total_price" id="totalPriceField">

                <div class="mb-4">
                    <label for="name" class="block font-semibold">Nome:</label>
                    <input type="text" id="name" name="name" required class="shadow border rounded py-2 px-3 text-gray-700 w-full">
                </div>

                <div class="mb-4">
                    <label for="cpf" class="block font-semibold">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required class="shadow border rounded py-2 px-3 text-gray-700 w-full">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block font-semibold">Telefone:</label>
                    <input type="text" id="phone" name="phone" required class="shadow border rounded py-2 px-3 text-gray-700 w-full">
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-semibold">Email:</label>
                    <input type="email" id="email" name="email" required class="shadow border rounded py-2 px-3 text-gray-700 w-full">
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">Finalizar Compra</button>
                    <button type="button" id="closeModal" class="ml-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
            const salePrice = {{ $product->sale_price }};
            const totalPriceElement = document.getElementById('totalPrice');
            const discountedTotalElement = document.getElementById('discountedTotal');
            const quantityInput = document.getElementById('quantity');
            const applyCouponButton = document.getElementById('applyCoupon');
            const couponCodeInput = document.getElementById('coupon_code');
            const makePurchaseButton = document.getElementById('makePurchase');
            const modal = document.getElementById('customerModal');
            const closeModalButton = document.getElementById('closeModal');
            const totalPriceField = document.getElementById('totalPriceField');
            const couponCodeField = document.getElementById('couponCodeField');
            const quantityField = document.getElementById('quantityField');
            
            // Atualiza o total de acordo com a quantidade
            quantityInput.addEventListener('input', function() {
                const quantity = parseInt(quantityInput.value);
                const total = salePrice * quantity;
                totalPriceElement.innerText = total.toFixed(2).replace('.', ',');
                discountedTotalElement.innerText = '--'; // Resetar o total com desconto
            });

            // Aplicar o cupom de desconto
            applyCouponButton.addEventListener('click', function() {
                const couponCode = couponCodeInput.value;

                if (!couponCode) {
                    alert('Por favor, insira um código de cupom.');
                    return;
                }

                // Chamada AJAX para validar o cupom no backend
                fetch('/apply-coupon', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        coupon_code: couponCode,
                        total: parseFloat(totalPriceElement.innerText.replace(',', '.'))
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        discountedTotalElement.innerText = data.discountedTotal.toFixed(2).replace('.', ',');
                    } else {
                        alert(data.message);
                    }
                });
            });

            // Abrir modal ao clicar em realizar venda
            makePurchaseButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
                quantityField.value = quantityInput.value;
                couponCodeField.value = couponCodeInput.value;
                totalPriceField.value = discountedTotalElement.innerText !== '--'
                    ? discountedTotalElement.innerText.replace(',', '.')
                    : totalPriceElement.innerText.replace(',', '.');
            });

            // Fechar modal
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });

    </script>
</x-app-layout>
