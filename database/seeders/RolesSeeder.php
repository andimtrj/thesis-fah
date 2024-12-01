<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['role_code' => 'TO', 'role_name' => 'Tenant Owner', 'created_at' => now(), 'updated_at' => now()],
            ['role_code' => 'BA', 'role_name' => 'Branch Admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
