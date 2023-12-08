<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'prenom' => $this->faker->name,
            'ville' => $this->faker->name,
            'adresse'=> $this->faker->name,
            'numeroTelephone' => $this->faker->random_int(9,10),
            'sexe' => $this->faker->name,
            'specialite' => $this->faker->name,
        ];
    }
}
