<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendasItens extends Model
{
    protected $table = 'vendas_itens';
    protected $id;

    public function getAllVendasItens() {
        
        return $this->where('ativo', '=', 1)->get();

    }
    
    public function nascimentos() {
        return $this->hasMany('App\Nascimentos');
    }

}
