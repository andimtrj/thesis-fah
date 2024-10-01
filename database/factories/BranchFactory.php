<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    protected $model = Branch::class;

    public function definition()
    {
        return [
            'branch_code' => $this->faker->unique()->bothify('BR-####'),
            'branch_name' => $this->faker->company,
            'tenant_id' => $this->faker->numberBetween(1, 10),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'province' => $this->faker->state,
            'zip_code' => $this->faker->postcode,
            'created_by' => $this->faker->numberBetween(1, 10),
            'updated_by' => $this->faker->numberBetween(1, 10),
        ];
    }
}
