<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard de Vendas') }}
        </h2>
    </x-slot>

    <x-container>
        <!-- Cards de Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold">Faturamento Mensal</h3>
                <p class="text-3xl font-bold mt-4">R$ {{ number_format($monthlyRevenue, 2, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold">Lucro Mensal</h3>
                <p class="text-3xl font-bold mt-4">R$ {{ number_format($monthlyProfit, 2, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold">Total de Vendas</h3>
                <p class="text-3xl font-bold mt-4">{{ $totalSales }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold">Descontos Aplicados</h3>
                <p class="text-3xl font-bold mt-4">R$ {{ number_format($totalDiscounts, 2, ',', '.') }}</p>
            </div>
        </div>

        <!-- Gráfico de Vendas -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Evolução das Vendas (Últimos 6 meses)</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Tabela de Vendas Recentes -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Vendas Recentes</h3>
            <table class="min-w-full bg-white table-auto">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Produto</th>
                        <th class="py-3 px-6 text-left">Quantidade</th>
                        <th class="py-3 px-6 text-left">Total</th>
                        <th class="py-3 px-6 text-left">Data</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($recentSales as $sale)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $sale->id }}</td>
                        <td class="py-3 px-6">{{ $sale->product->name }}</td>
                        <td class="py-3 px-6">{{ $sale->quantity }}</td>
                        <td class="py-3 px-6">R$ {{ number_format($sale->total_price, 2, ',', '.') }}</td>
                        <td class="py-3 px-6">{{ $sale->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginação -->
            <div class="mt-4">
                {{ $recentSales->links() }}
            </div>
        </div>
    </x-container>

    <!-- Scripts do Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months), // Array com os últimos 6 meses
                datasets: [{
                    label: 'Vendas (R$)',
                    data: @json($monthlySales), // Valores de vendas mensais
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
