<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasksroles', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idRegRol')    ->unsigned()->comment('Papéis');
            $table->foreign     ('idRegRol')    ->references('id')->on('usersroles');
            $table->integer     ('idRegEnt')    ->unsigned()->comment('Entidade x Usuário');
            $table->foreign     ('idRegEnt')    ->references('id')->on('regent000s');
            $table->integer     ('idRegTsk')    ->unsigned()->comment('Tarefa/Permissão');
            $table->foreign     ('idRegTsk')    ->references('id')->on('userstasks');
            $table->char        ('SitTsk', 1)   ->comment('Situação da Tarefa/Permissão');
            $table->unique     (['idRegRol','idRegEnt','idRegTsk']);
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
        Schema::dropIfExists('tasksroles');
    }
}
