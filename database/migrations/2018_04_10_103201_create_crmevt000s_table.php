<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmevt000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crmevt000s', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            //$table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idEntPrp')    ->comment('Entidade Proprietária');
            $table->integer     ('idOrgPrp')    ->comment('Organização Proprietária');
            $table->integer     ('idUndPrp')    ->comment('Unidade Proprietária');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->string      ('NomEvt',50)   ->comment('Nome do Evento');
            $table->dateTime    ('DatIni')      ->comment('Data e Hora Inicial do Evento');
            $table->dateTime    ('DatFim')      ->comment('Data e Hora Final do Evento');
            $table->string      ('CorEvt')      ->comment('Cor do Evento');
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
        Schema::dropIfExists('crmevt000s');
    }
}
