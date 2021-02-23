<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Historicos;
use App\Tipos;

class Unificador extends Model
{
    protected $table = 'unificador';
    protected $id;

    public function tipo()
    {
       return $this->hasMany(Tipos::class);
    }

    public function historico()
    {
       return $this->hasOne(Historicos::class);
    }
}
