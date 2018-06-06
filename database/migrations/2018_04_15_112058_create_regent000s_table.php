<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegent000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regent000s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            //$table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitEnt', 1)   ->comment('Situação do Registro');
            $table->string      ('RegFed',20)   ->comment('Registro Federal');
            $table->string      ('NomEnt',90)   ->comment('Nome da Entidade');
            $table->string      ('CodCne',20)   ->comment('CNAE da Atividade');
            $table->date        ('DatReg')      ->comment('Data de Registro');
            $table->softDeletesTz();
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
        Schema::dropIfExists('regent000s');
    }
}
