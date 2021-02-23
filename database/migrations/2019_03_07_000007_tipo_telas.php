<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoTelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_telas', function($tabela){
            $tabela->increments('id');
            $tabela->string('nome', 100);
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();
        });

        DB::table('tipo_telas')->insert(
            array(
                array('id' => 1, 'nome' => 'Touro', 'ativo' => 1),
                array('id' => 2, 'nome' => 'Matriz', 'ativo' => 1),
                array('id' => 3, 'nome' => 'Nascimento', 'ativo' => 1),
                array('id' => 4, 'nome' => 'Piquete', 'ativo' => 1),
                array('id' => 5, 'nome' => 'Lote', 'ativo' => 1),
                array('id' => 6, 'nome' => 'Fazenda', 'ativo' => 1),
                array('id' => 7, 'nome' => 'Fazendeiro', 'ativo' => 1),
                array('id' => 8, 'nome' => 'vendas', 'ativo' => 1),

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
        Schema::drop('tipo_telas');
    }
}
