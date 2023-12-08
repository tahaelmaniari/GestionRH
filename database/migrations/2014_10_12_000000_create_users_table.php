<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('prenom');
            $table->string('ville')->nullable();
            $table->string('adresse')->nullable();
            $table->string('numeroTelephone')->nullable();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->string('password');
            $table->integer('nombreConge')->default(50);
            $table->string('role')->default('user');
            $table->rememberToken();
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
        Schema::dropIfExists('files');
    }
}
