<?php

use App\Models\Employe;
use App\Models\TypeContrat;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Contrats', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('typeContrat');
            $table->foreignIdFor(Employe::class);
            $table->foreignIdFor(User::class);
            $table->date('dateContrat')->nullable();
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
        Schema::dropIfExists('contrats');
    }
}
