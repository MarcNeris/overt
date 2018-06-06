<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserstasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userstasks', function (Blueprint $table) {
            $table->increments  ('id');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('TipTsk', 1)   ->comment('Tipo da Tarefa/Permissão');
            $table->char        ('SitTsk', 1)   ->comment('Situação da Tarefa/Permissão');
            $table->string      ('NomTsk',200)  ->comment('Nome da Tarefa/Permissão');
            $table->text        ('DscTsk')      ->comment('Descrição da Tarefa/Permissão');
            $table->timestamps();
            $table->unique(['NomTsk']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userstasks');
    }
}
