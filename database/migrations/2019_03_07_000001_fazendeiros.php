<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fazendeiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fazendeiros', function($tabela){
            $tabela->increments('id');
            $tabela->string('nome', 100);
            $tabela->string('endereco', 500);
            $tabela->string('documento', 500);
            $tabela->string('cidade', 100);
            $tabela->string('estado', 2);
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();            
        });

        DB::table('fazendeiros')->insert(
            array(
                array('id' => 1, 'nome' => 'João', 'endereco' => 'Estrada, numero 10', 'documento' => '35496099811', 'cidade' => 'arealva', 'estado' => 'SP', 'ativo' => 1)
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
        Schema::drop('fazendeiros');
    }
}
