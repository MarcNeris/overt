<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers0001sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users0001s', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('user_id')     ->unsigned()->comment('Usuário x Empresa');
            $table->foreign     ('user_id')     ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->unsigned()->comment('Proprietário do Registro');
            $table->foreign     ('idPrpReg')    ->references('id')->on('users');
            $table->integer     ('idRegEnt')    ->unsigned()->comment('Entidade x Usuário');
            $table->foreign     ('idRegEnt')    ->references('id')->on('regent000s');
            $table->integer     ('idRegEmp')    ->unsigned()->comment('Empresa x Usuário');
            $table->foreign     ('idRegEmp')    ->references('id')->on('regemp000s');
            $table->integer     ('idRegRol')    ->unsigned()->comment('Usuário x Papéis');
            $table->foreign     ('idRegRol')    ->references('id')->on('usersroles');
            $table->integer     ('SitReg')      ->unsigned()->comment('Situação do Registro');
            $table->integer     ('SitUsu')      ->default('0')->comment('Situação do Usuário');
            $table->string      ('EmlUsu',200)  ->nullable()->comment('Email para Login do Usuário');
            $table->timestamps();
            $table->unique(['user_id', 'idPrpReg', 'idRegEmp','idRegEnt']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users0001s');
    }
}
