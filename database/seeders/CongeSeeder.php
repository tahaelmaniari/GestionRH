<?php

namespace Database\Seeders;

use App\Models\Conge;
use Illuminate\Database\Seeder;

class CongeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++)
        {
            $conge = new Conge();
            $conge->employeNom = $this->faker->name;
            $conge->dateDebut = "2001-01-01";
            $conge->dateFin = "2001-02-02";
        }
    }
}
