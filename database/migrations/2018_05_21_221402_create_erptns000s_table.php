<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErptns000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erptns000s', function (Blueprint $table) {
            $table->integer     ('id');
            $table->integer     ('idPrpReg')    ->unsigned()->comment('Usuário x Empresa');
            $table->foreign     ('idPrpReg')    ->references('id')->on('users');
            $table->integer     ('CodEmp')      ->unsigned()->comment('Código da Empresa');
            $table->integer     ('CodTns')      ->unsigned()->comment('Código da Transação');
            $table->string      ('DesTns',200)  ->comment('Nome da Transação');
            $table->string      ('LisMod',200)  ->comment('Módulo da Transação');
            $table->integer     ('SitTns')      ->unsigned()->comment('Situação');
            $table->primary     (['CodEmp','CodTns']);
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
        Schema::dropIfExists('erptns000s');
    }
}
