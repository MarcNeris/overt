<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegend000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regend000s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Organização Proprietária');
            $table->integer     ('idRegPsa')    ->comment('Pessoa do Endereço');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitEnd', 1)   ->comment('Situação do Registro');
            $table->char        ('TipEnd', 1)   ->comment('Tipo do Endereço');
            $table->string      ('CepEnd',20)   ->comment('CEP do Endereço');
            $table->string      ('NomEnd', 90)  ->comment('Nome do Endereço');
            $table->string      ('NumEnd', 20)  ->comment('Número do Endereço')->nullable();
            $table->string      ('CplEnd', 90)  ->comment('Complemento do Endereço')->nullable();
            $table->string      ('BroEnd', 90)  ->comment('Bairro do Endereço')->nullable();
            $table->string      ('CodMun', 20)  ->comment('Codigo do Município');
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
        Schema::dropIfExists('regend000s');
    }
}
