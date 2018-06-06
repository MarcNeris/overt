<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegcne000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('regcne000s', function (Blueprint $table) {
            $table->increments  ('id');
            $table->string      ('CodCne',20)   ->comment('Código do CNAE');
            $table->text        ('DscCne')      ->comment('Descrição do CNAE');
            $table->softDeletesTz();
            $table->timestamps();

            //DB::select('DROP TABLE IF EXISTS overt.regcne000s');
            //DB::select('CREATE TABLE overt.regcne000s SELECT * FROM overt_sys.regcne000s');
            //DB::select("INSERT INTO regmun000s (CodMun, NomMun, CodUfe) VALUES (1100015, 'Alta Floresta D''Oeste', 'RO');");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regcne000s');
    }
}
