<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run()
    {
        // Generate 25 branches using the factory
        Branch::factory()->count(25)->create();
    }
}
