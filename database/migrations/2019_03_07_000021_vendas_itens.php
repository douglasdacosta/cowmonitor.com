<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VendasItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas_itens', function($tabela){
            $tabela->increments('id');
            $tabela->integer('nascimentos_id')->unsigned()->index();
            $tabela->integer('vendas_id')->unsigned()->index();
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();

            $tabela->foreign('nascimentos_id')->references('id')->on('nascimentos');
            $tabela->foreign('vendas_id')->references('id')->on('vendas');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vendas_itens');
    }
}
