<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoapsrv00sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soapsrv00s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Organização Proprietária');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitSrv', 1)   ->comment('Situação do Servico');
            $table->string      ('NomSrv',90)   ->comment('Nome do Serviço');
            $table->mediumText  ('EndSrv')      ->comment('Endereço do Serviço');
            $table->longText    ('DscSrv')      ->comment('Descrição do Serviço');
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
        Schema::dropIfExists('soapsrv00s');
    }
}
