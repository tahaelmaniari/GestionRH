<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Conge;
use App\Models\PostUser;
use Illuminate\Database\Seeder;
use Database\Seeders\CongeSeeder;
use App\database\factories\UserFactory;
use Database\Factories\PostUserFactory;
use App\database\factories\CongeFactory;
use App\Models\Employe;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(20)->create();
    }
}
