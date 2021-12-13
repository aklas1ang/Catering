<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;

class LogFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Log::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElements([
                Booking::DONE,
                Booking::CANCEL,
                Booking::PENDING,
                Booking::CONFIRMED,
                Booking::DECLINED
            ]),
            'message' => $this->faker->sentence(),
            'user_id' => User::factory()->create()
        ];
    }
}
