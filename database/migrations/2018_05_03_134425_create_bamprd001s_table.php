<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBamprd001sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bamprd001s', function (Blueprint $table) {//Movimentos da Produção
            $table->increments  ('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Organização Proprietária');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->integer     ('idRegBam')    ->comment('id da Tabela bamprd000s');
            $table->char        ('SitBam', 1)   ->comment('Situação do BAM');
            $table->string      ('CodBam',20)   ->comment('Código do BAM')->nullable();
            $table->dateTime    ('DatMov')      ->comment('Data e Hora do Movimento')->nullable();
            $table->string      ('NomMov',200)  ->comment('Nome objeto do BAM')->nullable();
            $table->string      ('CodMov',20)   ->comment('Código do Movimento')->nullable();
            $table->float       ('VlrLin',15, 2)->comment('Valor do Movimento Linha')->nullable();
            $table->float       ('VlrBar',15, 2)->comment('Valor do Movimento Barra')->nullable();
            $table->string      ('UniMed',20)   ->comment('Unidade de Medida do Movimento')->nullable();
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
        Schema::dropIfExists('bamprd001s');
    }
}
