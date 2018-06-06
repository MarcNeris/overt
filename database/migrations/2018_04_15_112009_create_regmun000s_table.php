<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegmun000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regmun000s', function (Blueprint $table) {
            $table->increments('id');
            $table->string      ('CodMun',20)   ->comment('Código do CNAE');
            $table->string      ('NomMun',255)  ->comment('Nome do Município');
            $table->char        ('CodUfe',2)    ->comment('Código da Unidade Federativa');
            $table->softDeletesTz();
            $table->timestamps();
            //DB::select('DROP TABLE IF EXISTS overt.regmun000s');//MySql
            //DB::select('CREATE TABLE overt.regmun000s SELECT * FROM overt_sys.regmun000s');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regmun000s');
    }
}
