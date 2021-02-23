<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fazendas;
use App\Matrizes;
use App\Touros;

class Compradores extends Model
{
    protected $table = 'compradores';
    protected $id;

    public function getAllCompradores() {
        
        return $this->where('ativo', '=', 1)->get();

    }

    public function venda()
    {
       return $this->hasMany(Vendas::class);
    }    

}
