<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Arquivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function($tabela){
            $tabela->increments('id');
            $tabela->integer('tipo_id');
            $tabela->integer('animail_id');
            $tabela->dateTime('data_hora');
            $tabela->string('nome', 300);
            $tabela->string('nome_arquivo', 300);
            $tabela->string('extencao', 4);
            $tabela->string('hash', 100);
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('arquivos');
    }
}
