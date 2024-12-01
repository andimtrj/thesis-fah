<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaction_types')->insert([
            ['id' => 1, 'trx_code' => 'USG', 'trx_name' => 'Usage', 'trx_desc' => 'Product Usage Transaction', 'created_at' => '2024-11-09 12:50:00', 'updated_at' => '2024-11-09 12:50:00'],
            ['id' => 2, 'trx_code' => 'PUR', 'trx_name' => 'Purchase', 'trx_desc' => 'Ingredient Purchase Transaction', 'created_at' => '2024-11-09 12:50:00', 'updated_at' => '2024-11-09 12:50:00'],
            ['id' => 3, 'trx_code' => 'ADJ', 'trx_name' => 'Adjustment', 'trx_desc' => 'Ingredient Adjustment Transaction', 'created_at' => '2024-11-09 12:50:00', 'updated_at' => '2024-11-09 12:50:00'],
        ]);
    }
}
