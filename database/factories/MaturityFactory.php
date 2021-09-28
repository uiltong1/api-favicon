<?php

namespace Database\Factories;

use App\Models\Maturity;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaturityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Maturity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_id' => Service::factory(),
            'user_id' => User::factory(),
            'date_maturity' => $this->faker->date('Y-m-d'),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}
