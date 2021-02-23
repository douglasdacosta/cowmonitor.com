<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Compradores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compradores', function($tabela){
            $tabela->increments('id');
            $tabela->string('nome', 300);
            $tabela->string('inscricao_estadual', 200)->nullable();
            $tabela->string('cpf_cnpf', 15)->nullable();
            $tabela->string('telefone_1')->nullable();
            $tabela->string('telefone_2')->nullable();
            $tabela->string('endereco', 300)->nullable();
            $tabela->string('cidade', 150)->nullable();
            $tabela->string('estado', 2)->nullable();
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();  
        });
        
        DB::table('compradores')->insert(
            array(
                array('id' => 1, 'nome'=>'Anderson Montori')
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
        Schema::drop('compradores');
    }
}
