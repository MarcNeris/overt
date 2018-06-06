<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers0002sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users0002s', function (Blueprint $table) {
            $table->increments  ('id');
            $table->integer     ('idRegRol')    ->unsigned()->comment('Papéis');
            $table->foreign     ('idRegRol')    ->references('id')->on('usersroles');
            $table->integer     ('idRegTsk')    ->unsigned()->comment('Tarefa/Permissão');
            $table->foreign     ('idRegTsk')    ->references('id')->on('userstasks');
            $table->char        ('SitTsk', 1)   ->comment('Situação da Tarefa/Permissão');
            $table->unique     (['idRegRol','idRegTsk']);
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
        Schema::dropIfExists('users0002s');
    }
}
