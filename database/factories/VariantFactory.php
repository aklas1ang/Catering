<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Variant;
use App\Models\Package;
use App\Models\User;

class VariantFactory extends Factory
{

    protected $model = Variant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement([
                Variant::FOOD,
                Variant::DRINKS
            ]),
            'user_id' => User::factory()->create(),
            'package_id' => Package::factory()->create(),
            'description' => $this->faker->text()
        ];
    }
}
