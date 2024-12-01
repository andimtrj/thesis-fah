<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call the Branch seeder
        $this->call([
            // MetricGroupsSeeder::class,
            // MetricsSeeder::class,
            // TransactionTypesSeeder::class,
            // RolesSeeder::class,
            BranchSeeder::class
        ]);
    }
}
