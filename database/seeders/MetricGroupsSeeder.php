<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricGroupsSeeder extends Seeder
{
    public function run()
    {
        DB::table('metric_groups')->insert([
            ['id' => 1, 'metric_grp_code' => 'VOLUME', 'metric_grp_name' => 'Volume', 'base_metric_seq_no' => 4, 'created_at' => '2024-09-26 10:44:00', 'updated_at' => '2024-09-26 10:44:00'],
            ['id' => 2, 'metric_grp_code' => 'WEIGHT', 'metric_grp_name' => 'Weight', 'base_metric_seq_no' => 3, 'created_at' => '2024-09-26 10:44:00', 'updated_at' => '2024-09-26 10:44:00'],
            ['id' => 3, 'metric_grp_code' => 'PIECES', 'metric_grp_name' => 'Pieces', 'base_metric_seq_no' => 1, 'created_at' => '2024-09-26 10:44:00', 'updated_at' => '2024-09-26 10:44:00'],
        ]);
    }
}
