<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogeml001sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logeml001s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->string      ('NomDst',200)  ->comment('Nome do Destinatário')->nullable();
            $table->string      ('EmlDst',200)  ->comment('Email do Destinatário')->nullable();
            $table->string      ('NomEmt',200)  ->comment('Nome do Emitente')->nullable();
            $table->string      ('EmlEmt',200)  ->comment('Email do Emitente')->nullable();
            $table->string      ('EmlTit',200)  ->comment('Título do Email')->nullable();
            $table->text        ('EmlDsc')      ->comment('Descrição do Email')->nullable();
            $table->string      ('EmlFin',200)  ->comment('Finalidade do Email')->nullable();
            $table->string      ('NomFta',200)  ->comment('Nome Fantasia da Entidade')->nullable();
            $table->char        ('SitEml', 1)   ->comment('Situação do Email');
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
        Schema::dropIfExists('logeml001s');
    }
}
