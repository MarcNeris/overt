<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmtfa000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crmtfa000s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users');//Criador do Registro
            $table->integer('usuown000s');//Proprietário do Registro
            $table->integer('erpent000s');//Entidade Proprietária
            $table->integer('erporg000s');//Organização Proprietária
            $table->integer('erpunt000s');//Unidade Proprietária
            $table->integer('crmcta000s');//Conta da Tarefa
            $table->integer('SitReg');//Situaçãoda do Registro
            $table->integer('SitTfa');//Situaçãoda da Tarefa
            $table->string('NomTfa',90);//Nome daTarefa
            $table->longText('DscTfa');//Descrição da Tarefa
            $table->string('CorTfa',7);//Cor da Tarefa
            $table->integer('UsuTfa');//Usuário Resposável Pela Tarefa
            $table->dateTime('DatIni');
            $table->dateTime('DatFim');
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
        Schema::dropIfExists('crmtfa000s');
    }
}
