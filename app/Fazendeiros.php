<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fazendas;
use App\Matrizes;
use App\Touros;

class Fazendeiros extends Model
{
    protected $table = 'fazendeiros';
    protected $id;

    public function getAllFazendeiro() {
        
        return $this->where('ativo', '=', 1)->get();

    }

    public function fazenda()
    {
       return $this->hasMany(Fazendas::class);
    }    

}
