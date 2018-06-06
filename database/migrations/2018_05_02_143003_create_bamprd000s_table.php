<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBamprd000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bamprd000s', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Organização Proprietária');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitBam', 1)   ->comment('Situação do BAM');
            $table->enum        ('TipBam', ['RealTime', 'Estático'])->comment('Tipo do Monitoramento');
            $table->string      ('CodBam',20)   ->comment('Código do BAM')->nullable();
            $table->string      ('NomBam',90)   ->comment('Nome objeto do BAM')->nullable();
            $table->string      ('TitBam',90)   ->comment('Título do BAM')->nullable();
            $table->string      ('TitLin',20)   ->comment('Título da Linha')->nullable();
            $table->string      ('TitBar',20)   ->comment('Título da Barra')->nullable();
            $table->text        ('DscBam')      ->comment('Descrição do BAM')->nullable();
            $table->integer     ('TmpUdt')      ->comment('Tempo do Update em Milisegundos')->nullable();
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
        Schema::dropIfExists('bamprd000s');
    }
}
