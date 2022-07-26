<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function($tabela){
            $tabela->increments('id');
            $tabela->string('nome', 100);
            $tabela->string('piquete_id', 500)->nullable();
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();  
        });

        DB::table('lotes')->insert(
            array(
                array('id' => 1, 'nome' => 'Lote 1', 'piquete_id' => 1, 'ativo' => 1)
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lotes');
    }
}
