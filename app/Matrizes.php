<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fazendas;
use App\Fazendeiros;
use App\Lotes;
use App\Piquetes;
use App\Nascimentos;
use App\Racas;

class Matrizes extends Model
{
    protected $table = 'matrizes';
    protected $id;

    public function getAllMatrizes() {

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

    public function nascimento()
    {
       return $this->hasMany(Nascimentos::class);
    }

    public function raca()
    {
       return $this->hasOne(Racas::class);
    }
}
