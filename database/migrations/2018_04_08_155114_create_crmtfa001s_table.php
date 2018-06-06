<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmtfa001sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crmtfa001s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users');//Criador do Registro
            $table->integer('usuown000s');//Proprietário do Registro
            $table->integer('erpent000s');//Entidade Proprietária
            $table->integer('erporg000s');//Organização Proprietária
            $table->integer('erpunt000s');//Unidade Proprietária
            $table->integer('crmcta000s');//Conta da Tarefa
            $table->integer('crmtfa000s');//Tarefa Pai
            $table->integer('SitReg');//Situaçãoda do Registro
            $table->integer('AscTfa');//crm000tfas Tarefa Ascendente
            $table->integer('SucTfa');//crm000tfas Tarefa Sucessora
            $table->integer('SitTfa');//Situaçãoda Tarefa
            $table->integer('ColTfa');//Coluna da Tarefa
            $table->integer('LinTfa');//Linha da Tarefa
            $table->string('NomTfa',90);//Nome daTarefa
            $table->longText('TxtTfa');//Descrição da Tarefa
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
        Schema::dropIfExists('crmtfa001s');
    }
}
