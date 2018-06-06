<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegcli000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regcli000s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer     ('idUsuReg')    ->unsigned()->comment('Criador do Registro');
            $table->foreign     ('idUsuReg')    ->references('id')->on('users');
            $table->integer     ('idPrpReg')    ->comment('Proprietário do Registro');
            $table->integer     ('idUsuEdt')    ->comment('Editor do Registro');
            $table->integer     ('idRegEnt')    ->comment('Entidade Proprietária');
            $table->integer     ('idRegEmp')    ->comment('Organização Proprietária');
            $table->integer     ('idRegPsa')    ->comment('Pessoa');
            $table->char        ('SitReg', 1)   ->comment('Situação do Registro');
            $table->char        ('SitCli', 1)   ->comment('Situação do Cliente');
            $table->float       ('CapEmp',15, 2)->comment('Capital Empresarial')->nullable();
            $table->string      ('NatJur',90)   ->comment('Natureza Jurídica')->nullable();
            $table->string      ('CodCne',20)   ->comment('CNAE da Atividade')->nullable();
            $table->string      ('CodErp',20)   ->comment('Código do Cliente Importado')->nullable();
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
        Schema::dropIfExists('regcli000s');
    }
}
