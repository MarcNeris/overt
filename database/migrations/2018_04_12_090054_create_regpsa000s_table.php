<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegpsa000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regpsa000s', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Organização Proprietária')->default(0);
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitPsa', 1)   ->comment('Situação da Pessoa');
            $table->string      ('RegFed',20)   ->comment('Registro Federal');
            $table->string      ('RegEst',20)   ->comment('Registro Estadual')->nullable();
            $table->string      ('RegMun',20)   ->comment('Registro Municipal')->nullable();
            $table->string      ('NomPsa',200)   ->comment('Nome ou Razão Social');
            $table->string      ('NomFta',90)   ->comment('Nome Fantasia ou Apelido')->nullable();
            $table->text        ('DscPsa')      ->comment('Descrição Pessoal')->nullable();
            $table->date        ('DatReg')      ->comment('Data de Registro ou Nascimento');
            $table->integer     ('CodMun')      ->comment('Codigo IBGE da Cidade de Registro')->nullable();
            $table->softDeletesTz();
            $table->timestamps();
            $table->unique(['idPrpReg', 'RegFed']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regpsa000s');
    }
}
