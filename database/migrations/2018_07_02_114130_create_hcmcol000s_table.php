<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcmcol000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hcmcol000s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Empresa Proprietária');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitAfa', 1)   ->comment('Situação do Afastamento do Colaborador');
            $table->dateTime    ('DatAdm')      ->comment('Data de Admissão do Colaborador');
            $table->dateTime    ('DatNas')      ->comment('Data de Nascimento do Colaborador');
            $table->string      ('NomFun',90)   ->comment('Nome do Colaborador');
            $table->string      ('NumCad',20)   ->comment('Cadastro do Colaborador na Folha');
            $table->string      ('NumCgc',20)   ->comment('CNPJ da Empresa na Folha');
            $table->string      ('NumCpf',20)   ->comment('CPF do Colaborador');
            $table->string      ('NumCra',20)   ->comment('Crachá do Colaborador');
            $table->string      ('NumCtp',20)   ->comment('Carteira de Trabalho');
            $table->string      ('NumEmp',20)   ->comment('Código da Empresa na Folha');
            $table->string      ('NumPis',20)   ->comment('PIS do Colaborador');
            $table->string      ('NomUsu',90)   ->comment('Nome de Tratamento do Colaborador')->nullable();
            $table->string      ('EmlUsu',90)   ->comment('Email do APP do Colaborador')->nullable();
            $table->string      ('EmlVrf',20)   ->comment('Email está Verificado?')->nullable();
            $table->string      ('UsuUid',50)   ->comment('Chave única do Colaborador')->nullable();
            $table->unique     (['idRegEmp','NumCgc','NumCpf']);
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
        Schema::dropIfExists('hcmcol000s');
    }
}
