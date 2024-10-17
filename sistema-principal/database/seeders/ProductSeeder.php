<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Smartphone',
                'description' => 'A modern smartphone with 128GB storage and 8GB RAM.',
                'purchase_price' => 500.00,
                'sale_price' => 750.00,
                'category' => 'Electronics',
                'stock_quantity' => 50,
                'image' => 'smartphone.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop',
                'description' => 'A high-performance laptop with an Intel i7 processor and 16GB RAM.',
                'purchase_price' => 1000.00,
                'sale_price' => 1500.00,
                'category' => 'Electronics',
                'stock_quantity' => 30,
                'image' => 'laptop.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Washing Machine',
                'description' => 'Energy-efficient washing machine with 7kg load capacity.',
                'purchase_price' => 300.00,
                'sale_price' => 500.00,
                'category' => 'Appliances',
                'stock_quantity' => 20,
                'image' => 'washing_machine.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Headphones',
                'description' => 'Noise-cancelling over-ear headphones with Bluetooth connectivity.',
                'purchase_price' => 100.00,
                'sale_price' => 150.00,
                'category' => 'Accessories',
                'stock_quantity' => 100,
                'image' => 'headphones.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Refrigerator',
                'description' => 'Double-door refrigerator with a 500L capacity and frost-free technology.',
                'purchase_price' => 800.00,
                'sale_price' => 1200.00,
                'category' => 'Appliances',
                'stock_quantity' => 15,
                'image' => 'refrigerator.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
