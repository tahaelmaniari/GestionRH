<?php

use App\Models\Employe;
use App\Models\TypeConge;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Conges',function(BluePrint $table)
        {
        $table->id()->autoIncrement();
        $table->foreignIdFor(Employe::class);
        $table->integer('typeConge_id');
        $table->date('dateDebut')->nullable();
        $table->date('dateFin')->nullable();
        $table->integer('admin_id');
        $table->foreignIdFor(User::class);
        $table->integer('status')->default(0);
        $table->integer('nombreCongeDemandeEmploye')->default(0);
        $table->integer('nombreCongeDemandeByEmploye')->default(0);
        $table->integer('nombreCongeDemande')->default(0);
        $table->string('cause')->nullable();
        $table->date('dateAccorde')->nullable();
        $table->integer('tentative')->default(0);
        $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
