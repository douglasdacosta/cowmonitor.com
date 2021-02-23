<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fazendeiros;
use App\Piquetes;
use App\Fazendas;
use App\Lotes;
use App\Matrizes;
use App\Touros;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Nascimentos extends Model
{
    use SoftDeletes;
    
    protected $table = 'nascimentos';
    protected $id;

    public function getAllNascimentos() {

    	return $this->where('ativo', '=', 1)->get();
    }

    public function Fazendeiro()
    {
       return $this->hasOne(Fazendeiros::class);
    }

    public function Fazenda()
    {
       return $this->hasOne(Fazendas::class);
    }

    public function lote()
    {
       return $this->hasOne(Lotes::class);
    }

    public function matriz()
    {
       return $this->hasOne(Matrizes::class);
    }

    public function touro()
    {
       return $this->hasOne(Touros::class);
    }

    
}
