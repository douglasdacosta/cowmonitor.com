<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Historicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function($tabela){
            $tabela->increments('id');
            $tabela->integer('tipo_lancamento')->unsigned()->index();;
            $tabela->integer('tipo_tela_id')->unsigned()->index();
            $tabela->integer('id_referencia')->unsigned()->index();
            $tabela->longText('texto');
            $tabela->dateTime('data_hora');
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();

            $tabela->foreign('tipo_tela_id')->references('id')->on('tipo_telas');
            $tabela->foreign('tipo_lancamento')->references('id')->on('tipos_lancamentos');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('historicos');
    }
}
