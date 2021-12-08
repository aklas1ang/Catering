<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'package_id' => Package::factory()->create(),
            'book_by_id' => User::factory()->create(),
            'reserved_to_id' => User::factory()->create(),
            'schedule' => Carbon::now()
        ];
    }
}
