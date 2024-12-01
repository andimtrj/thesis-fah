<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricsSeeder extends Seeder
{
    public function run()
    {
        DB::table('metrics')->insert([
            ['id' => 1, 'metric_code' => 'ML', 'metric_name' => 'Mililitre', 'metric_seq_no' => 1, 'metric_group_id' => 1, 'created_at' => '2024-09-26 10:48:00', 'updated_at' => '2024-09-26 10:48:00', 'metric_unit' => 'ML'],
            ['id' => 2, 'metric_code' => 'CL', 'metric_name' => 'Centilitre', 'metric_seq_no' => 2, 'metric_group_id' => 1, 'created_at' => '2024-09-26 10:48:00', 'updated_at' => '2024-09-26 10:48:00', 'metric_unit' => 'CL'],
            ['id' => 3, 'metric_code' => 'DL', 'metric_name' => 'Decilitre', 'metric_seq_no' => 3, 'metric_group_id' => 1, 'created_at' => '2024-09-26 10:48:00', 'updated_at' => '2024-09-26 10:48:00', 'metric_unit' => 'DL'],
            ['id' => 4, 'metric_code' => 'L', 'metric_name' => 'Litre', 'metric_seq_no' => 4, 'metric_group_id' => 1, 'created_at' => '2024-09-26 10:48:00', 'updated_at' => '2024-09-26 10:48:00', 'metric_unit' => 'L'],
            ['id' => 5, 'metric_code' => 'DAL', 'metric_name' => 'Decalitre', 'metric_seq_no' => 5, 'metric_group_id' => 1, 'created_at' => '2024-09-26 10:48:00', 'updated_at' => '2024-09-26 10:48:00', 'metric_unit' => 'DAL'],
            ['id' => 6, 'metric_code' => 'HL', 'metric_name' => 'Hectolitre', 'metric_seq_no' => 6, 'metric_group_id' => 1, 'created_at' => '2024-09-26 10:48:00', 'updated_at' => '2024-09-26 10:48:00', 'metric_unit' => 'HL'],
            ['id' => 7, 'metric_code' => 'KL', 'metric_name' => 'Kilolitre', 'metric_seq_no' => 7, 'metric_group_id' => 1, 'created_at' => '2024-09-26 10:48:00', 'updated_at' => '2024-09-26 10:48:00', 'metric_unit' => 'KL'],
            ['id' => 8, 'metric_code' => 'MG', 'metric_name' => 'Miligram', 'metric_seq_no' => 1, 'metric_group_id' => 2, 'created_at' => '2024-09-26 10:51:00', 'updated_at' => '2024-09-26 10:51:00', 'metric_unit' => 'MG'],
            ['id' => 9, 'metric_code' => 'CG', 'metric_name' => 'Centigram', 'metric_seq_no' => 2, 'metric_group_id' => 2, 'created_at' => '2024-09-26 10:51:00', 'updated_at' => '2024-09-26 10:51:00', 'metric_unit' => 'CG'],
            ['id' => 10, 'metric_code' => 'DG', 'metric_name' => 'Decigram', 'metric_seq_no' => 3, 'metric_group_id' => 2, 'created_at' => '2024-09-26 10:51:00', 'updated_at' => '2024-09-26 10:51:00', 'metric_unit' => 'DG'],
            ['id' => 11, 'metric_code' => 'G', 'metric_name' => 'Gram', 'metric_seq_no' => 4, 'metric_group_id' => 2, 'created_at' => '2024-09-26 10:51:00', 'updated_at' => '2024-09-26 10:51:00', 'metric_unit' => 'G'],
            ['id' => 12, 'metric_code' => 'DAG', 'metric_name' => 'Decagram', 'metric_seq_no' => 5, 'metric_group_id' => 2, 'created_at' => '2024-09-26 10:51:00', 'updated_at' => '2024-09-26 10:51:00', 'metric_unit' => 'DAG'],
            ['id' => 13, 'metric_code' => 'HG', 'metric_name' => 'Hectagram', 'metric_seq_no' => 6, 'metric_group_id' => 2, 'created_at' => '2024-09-26 10:51:00', 'updated_at' => '2024-09-26 10:51:00', 'metric_unit' => 'HG'],
            ['id' => 14, 'metric_code' => 'KG', 'metric_name' => 'Kilogram', 'metric_seq_no' => 7, 'metric_group_id' => 2, 'created_at' => '2024-09-26 10:51:00', 'updated_at' => '2024-09-26 10:51:00', 'metric_unit' => 'KG'],
            ['id' => 15, 'metric_code' => 'PCS', 'metric_name' => 'Pieces', 'metric_seq_no' => 1, 'metric_group_id' => 3, 'created_at' => '2024-09-26 10:52:00', 'updated_at' => '2024-09-26 10:52:00', 'metric_unit' => 'PCS'],
        ]);
    }
}
