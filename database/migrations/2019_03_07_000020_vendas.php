<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function($tabela){
            $tabela->increments('id');
            $tabela->longText('observacao')->nullable();
            $tabela->dateTime('data_hora');
            $tabela->float('valor');
            $tabela->integer('comprador_id')->unsigned()->index();;
            $tabela->integer('lote_id')->unsigned()->index();;
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();

            $tabela->foreign('comprador_id')->references('id')->on('compradores');
            $tabela->foreign('lote_id')->references('id')->on('lotes');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vendas');
    }
}
