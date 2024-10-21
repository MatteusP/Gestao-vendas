<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Vendas por Email</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span class="w-12 h-12">
                    <i class="fas fa-store text-3xl"></i>
                </span>
                <h1 class="text-2xl font-bold hidden sm:block">Consulta de Vendas</h1>
            </div>
            <nav class="space-x-6">
                <a href="#sobre" class="text-gray-700 hover:text-blue-500">Sobre</a>
                <a href="#funcionalidades" class="text-gray-700 hover:text-blue-500">Funcionalidades</a>
                <a href="#documentacao" class="text-gray-700 hover:text-blue-500">Documentação</a>
            </nav>
        </div>
    </header>

    <div class="container mx-auto mt-10 p-5 content">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-center">Buscar Vendas por Email</h2>

            <form id="sales-form" action="{{ url('/sales') }}" method="GET" onsubmit="showModal(event)">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Buscar Vendas</button>
                </div>
            </form>
        </div>

        @if(isset($sales) && count($sales) > 0)
        <div class="mt-10 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Resultados das Vendas</h3>
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Produto</th>
                        <th class="px-4 py-2 text-left text-gray-600">Quantidade</th>
                        <th class="px-4 py-2 text-left text-gray-600">Preço Total</th>
                        <th class="px-4 py-2 text-left text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr class="border-b" onclick="openModal({{ json_encode($sale) }})">
                        <td class="px-4 py-2">{{ $sale->product->name }}</td>
                        <td class="px-4 py-2">{{ $sale->quantity }}</td>
                        <td class="px-4 py-2">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ ucfirst($sale->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @elseif(isset($sales))
        <div class="mt-10 bg-red-100 text-red-600 p-4 rounded-lg">
            <p>Nenhuma venda encontrada para o email informado.</p>
        </div>
        @endif
    </div>

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-5 w-11/12 md:w-1/3">
            <h2 class="text-xl font-bold mb-4">Detalhes da Venda</h2>
            <p id="product-name" class="text-lg"></p>
            <p id="product-quantity" class="text-lg"></p>
            <p id="product-price" class="text-lg"></p>
            <p id="product-status" class="text-lg"></p>
            <div class="flex justify-end mt-4">
                <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Fechar</button>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-gray-200 py-6">
        <div class="container mx-auto px-4 text-center">
            <div class="mb-4">
                <a href="#" class="text-gray-400 hover:text-white">Termos de Uso</a>
                <span class="mx-2">|</span>
                <a href="#" class="text-gray-400 hover:text-white">Política de Privacidade</a>
                <span class="mx-2">|</span>
                <a href="#contato" class="text-gray-400 hover:text-white">Contato</a>
            </div>
            <p>&copy; 2024 Sistema de Vendas. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        async function showModal(event) {
            event.preventDefault(); // Previne o envio do formulário

            const email = document.getElementById('email').value;

            try {
                const response = await fetch(`{{ url('/sales') }}?email=${encodeURIComponent(email)}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Para que o Laravel saiba que é uma requisição AJAX
                        'Content-Type': 'application/json',
                    },
                });

                // Verifica se a resposta foi bem-sucedida
                if (!response.ok) {
                    throw new Error('Erro ao buscar vendas');
                }

                const salesData = await response.json();

                // Verifica se encontrou vendas
                if (salesData.length > 0) {
                    // Exibir a primeira venda no modal como exemplo
                    openModal(salesData[0]);
                } else {
                    alert('Nenhuma venda encontrada para o email informado.');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Ocorreu um erro ao buscar as vendas.');
            }

        function openModal(sale) {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('product-name').innerText = `Produto: ${sale.product.name}`;
            document.getElementById('product-quantity').innerText = `Quantidade: ${sale.quantity}`;
            document.getElementById('product-price').innerText = `Preço Total: R$ ${sale.total_price.toFixed(2).replace('.', ',')}`;
            document.getElementById('product-status').innerText = `Status: ${sale.status.charAt(0).toUpperCase() + sale.status.slice(1)}`;
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

</body>
</html>
