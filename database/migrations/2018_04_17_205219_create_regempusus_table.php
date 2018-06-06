<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegempususTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regempusus', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('user_id')     ->unsigned()->comment('Usuário da Entidade');
            $table->foreign     ('user_id')     ->references('id')->on('users');
            $table->integer     ('idPrpEnt')    ->unsigned()->comment('Proprietário da Entidade');
            $table->foreign     ('idPrpEnt')    ->references('id')->on('users');
            $table->integer     ('idRegEnt')    ->unsigned()->comment('Entidade');
            $table->foreign     ('idRegEnt')    ->references('id')->on('regent000s');
            $table->integer     ('idRegEmp')    ->unsigned()->comment('Empresa');
            $table->foreign     ('idRegEmp')    ->references('id')->on('regemp000s');
            $table->integer     ('SitReg')      ->unsigned()->comment('Situação do Registro');
            $table->integer     ('SitEmp')      ->default('0')->comment('Situação da Empresa');
            $table->integer     ('SitUsu')      ->unsigned()->comment('Situação do Usuário');
            $table->softDeletesTz();
            $table->timestamps();
            $table->unique(['user_id', 'idRegEnt', 'idRegEmp']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regempusus');
    }
}
