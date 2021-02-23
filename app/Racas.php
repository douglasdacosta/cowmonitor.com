<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Matrizes;
use App\Touros;
use App\Nascimentos;

class Racas extends Model
{
    protected $table = 'racas';
    protected $id;

    public function getAllRacas() {

    	return $this->where('ativo', '=', 1)->get();
    }

    public function matriz()
    {
       return $this->hasMany(Matrizes::class);
    }

    public function touro()
    {
       return $this->hasMany(Touros::class);
    }

    public function nascimento()
    {
       return $this->hasMany(Nascimentos::class);
    }
}
