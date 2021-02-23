
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nascimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nascimentos', function($tabela){
            $tabela->increments('id');
            $tabela->integer('codigo');
            $tabela->string('nome', 100)->nullable();
            $tabela->dateTime('data_nascimento');
            $tabela->dateTime('data_compra');
            $tabela->integer('fazendeiro_id')->unsigned()->index()->nullable();
            $tabela->integer('fazenda_id')->unsigned()->index()->nullable();
            $tabela->integer('lote_id')->unsigned()->index()->nullable();
            $tabela->integer('matriz_id')->unsigned()->index()->nullable();
            $tabela->integer('touro_id')->unsigned()->index();
            $tabela->integer('raca_id')->unsigned()->index()->nullable();
            $tabela->char('sexo', 1)->nullable();
            $tabela->integer('estagio_id')->unsigned()->index()->nullable();
            $tabela->string('causa_morte', 300)->nullable();

            $tabela->smallInteger('ativo')->default(1);

            $tabela->timestamps();
            $tabela->softDeletes();

            $tabela->foreign('fazendeiro_id')->references('id')->on('fazendeiros');
            $tabela->foreign('fazenda_id')->references('id')->on('fazendas');
            $tabela->foreign('lote_id')->references('id')->on('lotes');
            $tabela->foreign('matriz_id')->references('id')->on('matrizes');
            $tabela->foreign('raca_id')->references('id')->on('racas');

        });
        
        
        DB::table('nascimentos')->insert(
            array(
                array('id' => 1, 'codigo' => 1, 'nome' => '1', 'data_nascimento' => '2020-01-01', 'data_compra' => '2020-01-01', 'fazendeiro_id' => '1', 'sexo' => '1', 'estagio_id' => '1', 'fazenda_id' => '1', 'touro_id' => '1', 'matriz_id' => '1', 'lote_id'=> '1', 'raca_id'=> '1', 'causa_morte' => '', 'ativo' => 1),
                array('id' => 2, 'codigo' => 2, 'nome' => '1', 'data_nascimento' => '2020-01-01', 'data_compra' => '2020-01-01', 'fazendeiro_id' => '1', 'sexo' => '1', 'estagio_id' => '1', 'fazenda_id' => '1', 'touro_id' => '1', 'matriz_id' => '1', 'lote_id'=> '1', 'raca_id'=> '1', 'causa_morte' => '', 'ativo' => 1),
                array('id' => 3, 'codigo' => 3, 'nome' => '1', 'data_nascimento' => '2020-01-01', 'data_compra' => '2020-01-01', 'fazendeiro_id' => '1', 'sexo' => '1', 'estagio_id' => '1', 'fazenda_id' => '1', 'touro_id' => '1', 'matriz_id' => '1', 'lote_id'=> '1', 'raca_id'=> '1', 'causa_morte' => '', 'ativo' => 1),
                array('id' => 4, 'codigo' => 4, 'nome' => '1', 'data_nascimento' => '2020-01-01', 'data_compra' => '2020-01-01', 'fazendeiro_id' => '1', 'sexo' => '1', 'estagio_id' => '1', 'fazenda_id' => '1', 'touro_id' => '1', 'matriz_id' => '1', 'lote_id'=> '2', 'raca_id'=> '1', 'causa_morte' => '', 'ativo' => 1)
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
        Schema::drop('nascimentos');
    }
}
