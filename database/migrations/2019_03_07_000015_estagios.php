<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Estagios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estagios', function($tabela){
            $tabela->increments('id');
            $tabela->string('nome', 300);
            $tabela->smallInteger('inicio');
            $tabela->smallInteger('fim');
            $tabela->smallInteger('ativo')->default(1);
            $tabela->timestamps();
            $tabela->softDeletes();  
        });

        DB::table('estagios')->insert(
            array(
                array(
                    'id' => 1, 
                    'inicio' => 1,
                    'fim' => 4,
                    'nome' => 'Nascimento 1 - 4 meses', 
                    'ativo' => 1
                ),
                array(
                    'id' => 2,  
                    'inicio' => 5,
                    'fim' => 8,
                    'nome' => 'Nascimento 4 - 8 meses', 
                    'ativo' => 1
                ),
                array(
                    'id' => 3,  
                    'inicio' => 9,
                    'fim' => 12,
                    'nome' => 'Bezerro/Bezerra (Desmama) 8 - 12 meses', 
                    'ativo' => 1
                ),
                array(
                    'id' => 4,  
                    'inicio' => 13,
                    'fim' => 24,
                    'nome' => 'Garrote/novilha 12 -24 meses', 
                    'ativo' => 1
                ),
                array(
                    'id' => 5,  
                    'inicio' => 25,
                    'fim' => 999,
                    'nome' => 'Vaca / Boi 24 a 36+', 
                    'ativo' => 1
                ),

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
        Schema::drop('estagios');
    }
}
