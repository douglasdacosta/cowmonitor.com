<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fazendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fazendas', function($tabela){
            $tabela->increments('id');
            $tabela->string('nome', 100);
            $tabela->string('endereco', 500);
            $tabela->smallInteger('ativo')->default(1);
            $tabela->integer('fazendeiro_id')->unsigned()->index()->nullable(); 
            $tabela->timestamps();
            $tabela->softDeletes();            
            $tabela->foreign('fazendeiro_id')->references('id')->on('fazendeiros');
        });

        DB::table('fazendas')->insert(
            array(
                array('id' => 1, 'nome' => 'Encantos da Natureza', 'endereco' => 'Estrada, numero 10', 'fazendeiro_id' => 1, 'ativo' => 1)
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
        Schema::drop('fazendas');
    }
}
