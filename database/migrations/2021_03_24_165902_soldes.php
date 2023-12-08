<?php

use App\Models\Conge;
use App\Models\Employe;
use App\Models\TypeConge;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Soldes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soldes',function(BluePrint $table)
        {
        $table->id()->autoIncrement();
        $table->foreignIdFor(Employe::class);
        $table->integer('status')->default(0);
        $table->integer('jourAnnuel')->default(0);
        $table->string('cause')->nullable();
        $table->foreignIdFor(User::class);
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
