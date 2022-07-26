<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TiposLancamentos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tipos_lancamentos', function($tabela) {
            $tabela->increments('id');
            $tabela->string('nome', 300);
            $tabela->integer('tela')->nullable();
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();
        });

        DB::table('tipos_lancamentos')->insert(
                array(
                    array('id' => 1, 'nome' => 'Vacina', 'tela' => 1, 'ativo' => 1),
                    array('id' => 2, 'nome' => 'Vacina', 'tela' => 2, 'ativo' => 1),
                    array('id' => 3, 'nome' => 'Vacina', 'tela' => 3, 'ativo' => 1),
                    array('id' => 4, 'nome' => 'Tratamento', 'tela' => 1, 'ativo' => 1),
                    array('id' => 5, 'nome' => 'Tratamento', 'tela' => 2, 'ativo' => 1),
                    array('id' => 6, 'nome' => 'Tratamento', 'tela' => 3, 'ativo' => 1),
                    array('id' => 7, 'nome' => 'Medicamento ', 'tela' => 1, 'ativo' => 1),
                    array('id' => 8, 'nome' => 'Medicamento ', 'tela' => 2, 'ativo' => 1),
                    array('id' => 9, 'nome' => 'Medicamento ', 'tela' => 3, 'ativo' => 1),
                    array('id' => 10, 'nome' => 'Resultado de Tratamento', 'tela' => 1, 'ativo' => 1),
                    array('id' => 11, 'nome' => 'Resultado de Tratamento', 'tela' => 2, 'ativo' => 1),
                    array('id' => 12, 'nome' => 'Resultado de Tratamento', 'tela' => 3, 'ativo' => 1),
                    array('id' => 13, 'nome' => 'Outros', 'tela' => NULL, 'ativo' => 1),
                )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tipos_lancamentos');
    }

}
