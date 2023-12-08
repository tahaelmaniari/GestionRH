<?php

namespace Database\Factories;

use App\Models\Conge;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CongeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->name,
            'dateDebutConge' => $this->faker->date_sub(2000-01-20,2020-01-31),
            'dateFinConge' => $this->faker->date_sub(2020-02-01,2021-03-02),
        ];
    }
}
