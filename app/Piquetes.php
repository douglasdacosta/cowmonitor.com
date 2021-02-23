<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nascimentos;
use App\Fazendas;
use App\Lotes;
use App\Matrizes;
use App\Touros;
use Illuminate\Support\Facades\DB;

class Piquetes extends Model
{
    protected $table = 'piquetes';
    protected $id;

    public function getAllPiquetes() {

    	return $this->where('ativo', '=', 1)->get();
    }

    public function Fazenda()
    {
       return $this->hasOne(Fazendas::class);
    }

    public function lote()
    {
       return $this->hasMany(Lotes::class);
    }

    public function matriz()
    {
       return $this->hasMany(Matrizes::class);
    }

    public function touro()
    {
       return $this->hasMany(Touros::class);
    }
}
