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
                array('id' => 1, 'nome' => 'Lote 1', 'piquete_id' => 1, 'ativo' => 1),
                array('id' => 2, 'nome' => 'Lote 2', 'piquete_id' => null, 'ativo' => 1),
                array('id' => 3, 'nome' => 'Lote 3', 'piquete_id' => null, 'ativo' => 1),
                array('id' => 4, 'nome' => 'Lote 4', 'piquete_id' => 2, 'ativo' => 1),
                array('id' => 5, 'nome' => 'Lote 5', 'piquete_id' => 2, 'ativo' => 1),
                array('id' => 6, 'nome' => 'Lote 6', 'piquete_id' => 2, 'ativo' => 1),
                array('id' => 7, 'nome' => 'Lote 7', 'piquete_id' => null, 'ativo' => 1),
                array('id' => 8, 'nome' => 'Lote 8', 'piquete_id' => null, 'ativo' => 1),
                array('id' => 9, 'nome' => 'Lote 9', 'piquete_id' => null, 'ativo' => 1)
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
