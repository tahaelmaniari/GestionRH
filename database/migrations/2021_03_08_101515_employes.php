<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes',function(BluePrint $table)
        {
            $table->id()->autoIncrement();
            $table->string('nom');
            $table->string('prenom');
            $table->string('ville')->nullable();
            $table->string('adresse')->nullable();
            $table->string('numeroTelephone')->nullable();
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();
            $table->string('specialite')->nullable();
            $table->string('photo')->nullable();
            $table->integer('nombreVacance')->default(0);
            $table->foreignIdFor(User::class);
            $table->integer('nombreConge')->default(50);
            $table->string('password');
            $table->string('role')->default('user');
            $table->integer('nombreCongeDemandeByEmploye')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('nombreConge');
        });
    }
}
