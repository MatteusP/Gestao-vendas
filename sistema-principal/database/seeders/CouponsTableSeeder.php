<?php

namespace Database\Seeders;

use App\Models\Coupons;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados dos cupons manuais
        $coupons = [
            [
                'code' => 'DESCONTO10',
                'discount_percent' => 10,
                'expiration_date' => Carbon::now()->addMonth(1), // 1 mês de validade
                'user_id' => 1, // Altere para o ID do usuário correto
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'DESCONTO20',
                'discount_percent' => 20,
                'expiration_date' => Carbon::now()->addMonth(2), // 2 meses de validade
                'user_id' => 1, // Altere para o ID do usuário correto
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'DESCONTO30',
                'discount_percent' => 30,
                'expiration_date' => Carbon::now()->addMonth(3), // 3 meses de validade
                'user_id' => 1, // Altere para o ID do usuário correto
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insere os cupons no banco de dados
        DB::table('coupons')->insert($coupons);
    }
}
