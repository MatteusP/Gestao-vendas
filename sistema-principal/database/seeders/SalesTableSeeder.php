<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Sales;

class SalesTableSeeder extends Seeder
{
    public function run()
    {
        // Seleciona todos os usuários
        $users = User::all();

        // Cria 15 vendas fictícias
        $users->each(function ($user) {
            Sales::factory(15)->create([
                'user_id' => $user->id,
            ])->each(function ($sale) {
                // Seleciona produtos aleatórios e associa à venda
                $products = Product::inRandomOrder()->take(rand(1, 5))->get();
                foreach ($products as $product) {
                    $sale->products()->attach($product->id, [
                        'quantity' => rand(1, 10),
                        'unit_price' => $product->sale_price,
                    ]);
                }
            });
        });
    }
}

