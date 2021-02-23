<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Piquetes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piquetes', function($tabela){
            $tabela->increments('id');
            $tabela->string('nome', 100);
            $tabela->integer('fazenda_id')->unsigned()->index()->nullable(); 
            $tabela->longText('benfeitorias');
            $tabela->smallInteger('ativo')->default(1);
            $tabela->foreign('fazenda_id')->references('id')->on('fazendas');
            $tabela->timestamps();
            $tabela->softDeletes();  
        });

        DB::table('piquetes')->insert(
            array(
                array('id' => 1, 'nome' => 'piquete 1', 'fazenda_id' => 1, 'benfeitorias' => '', 'ativo' => 1),
                array('id' => 2, 'nome' => 'piquete 2', 'fazenda_id' => 1, 'benfeitorias' => '', 'ativo' => 1),
                array('id' => 3, 'nome' => 'piquete 3', 'fazenda_id' => 1, 'benfeitorias' => '', 'ativo' => 1),
                array('id' => 4, 'nome' => 'piquete 4', 'fazenda_id' => 1, 'benfeitorias' => '', 'ativo' => 1)
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
        Schema::drop('piquetes');
    }
}
