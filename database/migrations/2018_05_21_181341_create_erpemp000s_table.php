<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErpemp000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erpemp000s', function (Blueprint $table) {
            $table->integer     ('id')          ->unsigned();
            $table->integer     ('user_id')     ->unsigned()->comment('Usuário x Empresa');
            $table->foreign     ('user_id')     ->references('id')->on('users');
            $table->integer     ('CodEmp')      ->unsigned()->comment('Código da Empresa');
            $table->integer     ('CodFil')      ->unsigned()->comment('Código da Filial');
            $table->integer     ('SitEmp')      ->unsigned()->comment('Situação');
            $table->string      ('NomSis',200)      ->comment('Nome do Sistema');
            $table->string      ('SigEmp',200)      ->comment('Sigla da Empresa');
            $table->string      ('SigFil',200)      ->comment('Sigla da Filial');
            $table->primary     (['id','user_id','CodEmp','CodFil']);
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
        Schema::dropIfExists('erpemp000s');
    }
}
