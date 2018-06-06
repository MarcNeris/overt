<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegcto000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regcto000s', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Organização Proprietária');
            $table->integer     ('idRegCta')    ->comment('Conta')->nullable();
            $table->integer     ('idRegPsa')    ->comment('Pessoa')->nullable();
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitCto', 1)   ->comment('Situação do Contato');
            $table->string      ('TipCto',20)   ->comment('Tipo do Contato');
            $table->string      ('RegFed', 20)  ->comment('Registro Federal')->nullable();
            $table->string      ('NomCto', 90)  ->comment('Nome do Contato');
            $table->string      ('CodCrg', 20)  ->comment('Codigo do Cargo');
            $table->string      ('NomCrg', 90)  ->comment('Nome do Cargo');
            $table->string      ('TelCto', 20)  ->comment('Telefone do Contato')->nullable();
            $table->string      ('EmlCto', 90)  ->comment('Email do Contato')->nullable();
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
        Schema::dropIfExists('regcto000s');
    }
}
