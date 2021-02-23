<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Matrizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrizes', function($tabela){
            $tabela->increments('id');
            $tabela->integer('codigo');
            $tabela->string('nome', 100)->nullable();
            $tabela->dateTime('data_compra');
            $tabela->integer('fazendeiro_id')->unsigned()->index()->nullable();
            $tabela->integer('fazenda_id')->unsigned()->index()->nullable();
            $tabela->integer('piquete_id')->unsigned()->index()->nullable();
            $tabela->integer('lote_id')->unsigned()->index()->nullable();
            $tabela->integer('raca_id')->unsigned()->index()->nullable();
            $tabela->string('causa_morte', 300)->nullable();

            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();

            $tabela->foreign('fazendeiro_id')->references('id')->on('fazendeiros');
            $tabela->foreign('piquete_id')->references('id')->on('piquetes');
            $tabela->foreign('fazenda_id')->references('id')->on('fazendas');
            $tabela->foreign('lote_id')->references('id')->on('lotes');
            $tabela->foreign('raca_id')->references('id')->on('racas');
        });
        
        DB::table('matrizes')->insert(
            array(
                array('id' => 1, 'codigo' => 1, 'nome' => '1', 'data_compra' => '2020-01-01', 'fazendeiro_id' => '1', 'fazenda_id' => '1', 'piquete_id' => '1', 'lote_id'=> '1', 'raca_id'=> '1', 'causa_morte' => '', 'ativo' => 1)
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
        Schema::drop('matrizes');
    }
}
