<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Package;

class PackageFactory extends Factory
{

    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(1000),
            'limit' => $this->faker->randomDigit(),
            'user_id' => User::factory()->create(),
            'image' => 'https://via.placeholder.com/150'
        ];
    }
}
