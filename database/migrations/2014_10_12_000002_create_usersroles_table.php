<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersroles', function (Blueprint $table) {
            $table->increments  ('id');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('TipRol', 1)   ->comment('Tipo do Papel');
            $table->char        ('SitRol', 1)   ->comment('Situação do Papel');
            $table->string      ('NomRol',90)   ->unique()->comment('Nome do Papel do Usuário');
            $table->text        ('DscRol')      ->comment('Descrição das Funções do Papel');
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
        Schema::dropIfExists('usersroles');
    }
}
