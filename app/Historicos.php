<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tipos;
use Illuminate\Support\Facades\DB;

class Historicos extends Model
{
    protected $table = 'historicos';
    protected $id;

    public function tipo()
    {
       return $this->hasOne(Tipos::class);
    }

    public function getHistoricosPorTipoTela($tipo_tela_id, $id_referencia){
        return DB::table('historicos')
            ->select('historicos.texto', 'historicos.data_hora', 'tipos_lancamentos.nome as tipo_lancamento')
            ->leftjoin('tipos_lancamentos', 'tipos_lancamentos.id', '=', 'historicos.tipo_lancamento')
            ->where('historicos.ativo', '=', '1')
            ->where('historicos.tipo_tela_id', '=', $tipo_tela_id)
            ->where('historicos.id_referencia', '=', $id_referencia)
            ->get()->toArray();
    }

}
