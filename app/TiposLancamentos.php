<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tipos;
use Illuminate\Support\Facades\DB;

class TiposLancamentos extends Model
{
    protected $table = 'tipos_lancamentos';
    protected $id;

    public function tipo()
    {
       return $this->hasOne(Tipos::class);
    }

    public function getAllTiposLancamentos(){
        return DB::table('tipos_lancamentos')
            ->where('ativo', '=', '1')
            ->get()->toArray();
    }

}
