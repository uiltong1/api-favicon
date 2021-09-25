<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Internet',
            'ds_service' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 1),
            'periodic' => $this->faker->numberBetween(0, 1),
            'date_init' => $this->faker->date('Y-m-d'),
            'value' => $this->faker->numberBetween(0, 100),
            'user_id' => User::factory(),
            'reminder' => $this->faker->numberBetween(0, 1)
        ];
    }
}
