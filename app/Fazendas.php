<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fazendeiros;
use App\Matrizes;
use App\Touros;
use App\Piquetes;

class Fazendas extends Model
{
    protected $table = 'fazendas';
    protected $id;

    public function getAllFazendas() {

    	return $this->where('ativo', '=', 1)->get();
    }

    public function Fazendeiro()
    {
       return $this->hasOne(Fazendeiros::class);
    }

    public function matriz()
    {
       return $this->hasMany(Matrizes::class);
    }

    public function touros()
    {
       return $this->hasMany(Touros::class);
    }
    
    public function piquetes()
    {
       return $this->hasMany(Piquetes::class);
    }
}
