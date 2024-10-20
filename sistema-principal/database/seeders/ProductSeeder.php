<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Smartphone X',
                'description' => 'Um smartphone com funcionalidades avançadas.',
                'purchase_price' => 1200.00,
                'sale_price' => 1500.00,
                'category' => 'Eletrônicos',
                'stock_quantity' => 50,
                'image' => 'smartphone_x.jpg',
            ],
            [
                'name' => 'Notebook Pro',
                'description' => 'Notebook com alto desempenho para profissionais.',
                'purchase_price' => 3500.00,
                'sale_price' => 4000.00,
                'category' => 'Informática',
                'stock_quantity' => 30,
                'image' => 'notebook_pro.jpg',
            ],
            [
                'name' => 'Fone de Ouvido Bluetooth',
                'description' => 'Fone de ouvido sem fio com alta qualidade de som.',
                'purchase_price' => 100.00,
                'sale_price' => 150.00,
                'category' => 'Acessórios',
                'stock_quantity' => 100,
                'image' => 'fone_bluetooth.jpg',
            ],
            [
                'name' => 'Câmera Digital Z',
                'description' => 'Câmera de alta resolução para fotógrafos profissionais.',
                'purchase_price' => 2500.00,
                'sale_price' => 2800.00,
                'category' => 'Eletrônicos',
                'stock_quantity' => 20,
                'image' => 'camera_digital_z.jpg',
            ],
            [
                'name' => 'Smartwatch Y',
                'description' => 'Relógio inteligente com monitoramento de saúde.',
                'purchase_price' => 800.00,
                'sale_price' => 950.00,
                'category' => 'Acessórios',
                'stock_quantity' => 75,
                'image' => 'smartwatch_y.jpg',
            ],
            [
                'name' => 'Monitor 4K Ultra',
                'description' => 'Monitor com resolução 4K e alta taxa de atualização.',
                'purchase_price' => 1800.00,
                'sale_price' => 2200.00,
                'category' => 'Informática',
                'stock_quantity' => 40,
                'image' => 'monitor_4k_ultra.jpg',
            ],
            [
                'name' => 'Teclado Mecânico RGB',
                'description' => 'Teclado mecânico com iluminação RGB personalizável.',
                'purchase_price' => 300.00,
                'sale_price' => 400.00,
                'category' => 'Acessórios',
                'stock_quantity' => 120,
                'image' => 'teclado_mecanico_rgb.jpg',
            ],
            [
                'name' => 'Mouse Gamer XYZ',
                'description' => 'Mouse com alta precisão e sensor avançado para jogos.',
                'purchase_price' => 250.00,
                'sale_price' => 350.00,
                'category' => 'Acessórios',
                'stock_quantity' => 85,
                'image' => 'mouse_gamer_xyz.jpg',
            ],
            [
                'name' => 'Impressora Multifuncional ABC',
                'description' => 'Impressora com scanner, copiadora e impressão sem fio.',
                'purchase_price' => 900.00,
                'sale_price' => 1100.00,
                'category' => 'Eletrônicos',
                'stock_quantity' => 60,
                'image' => 'impressora_multifuncional_abc.jpg',
            ],
            [
                'name' => 'Tablet Pro Max',
                'description' => 'Tablet com tela grande e processador de alto desempenho.',
                'purchase_price' => 2200.00,
                'sale_price' => 2500.00,
                'category' => 'Eletrônicos',
                'stock_quantity' => 45,
                'image' => 'tablet_pro_max.jpg',
            ],
        ];


        foreach ($products as $productData) {
            // Cria o produto
            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'purchase_price' => $productData['purchase_price'],
                'sale_price' => $productData['sale_price'],
                'category' => $productData['category'], // Certifique-se que a categoria está sendo atribuída
                'stock_quantity' => $productData['stock_quantity'],
                'image' => $productData['image'],
            ]);
        }
    }
}
