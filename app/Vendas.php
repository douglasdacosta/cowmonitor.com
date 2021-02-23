<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $table = 'vendas';
    protected $id;

    public function getAllVendas() {
        
        return $this->where('ativo', '=', 1)->get();

    }   
        

    public function vendasItens()
    {
        return $this->hasMany('App\VendasItens');
    }

}
