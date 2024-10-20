<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {

        // Definindo o locale para português
        App::setLocale('pt_BR');
    
        // Ou utilizando Carbon para definir o locale
        Carbon::setLocale('pt_BR');
        
        // Obtendo os últimos 6 meses
        $months = collect([]);
        $monthlySales = collect([]);
    
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->translatedFormat('F'); // Usando translatedFormat
            $sales = Sales::whereYear('created_at', now()->subMonths($i)->year)
                ->whereMonth('created_at', now()->subMonths($i)->month)
                ->sum('total_price');
        
            $months->push($month);
            $monthlySales->push($sales);
        }
        
        // Faturamento mensal total (vendas)
        $monthlyRevenue = Sales::whereMonth('created_at', now()->month)->sum('total_price');
    
        // Calcular o custo total (usando o purchase_price da tabela products)
        $monthlyCost = Sales::join('products', 'sales.product_id', '=', 'products.id')
            ->whereMonth('sales.created_at', now()->month)
            ->sum(DB::raw('sales.quantity * products.purchase_price'));
    
        // Calcular o lucro mensal (faturamento - custo)
        $monthlyProfit = $monthlyRevenue - $monthlyCost;
    
        // Total de vendas
        $totalSales = Sales::count();

        // Calculando o total de descontos aplicados
        $totalDiscounts = Sales::join('coupons', 'sales.coupon_code', '=', 'coupons.code')
        ->whereNotNull('sales.coupon_code')
        ->sum(DB::raw('total_price * (coupons.discount_percent / 100)'));
    
        // Vendas recentes
        $recentSales = Sales::latest()->paginate(10);
    
        return view('dashboard', compact('months', 'monthlySales', 'monthlyRevenue', 'monthlyProfit', 'totalSales', 'totalDiscounts', 'recentSales'));
    }
    

}
