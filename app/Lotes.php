<?php

namespace App;

use App\Matrizes;
use App\Nascimentos;
use App\Piquetes;
use App\Touros;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Lotes extends Model
{
    protected $table = 'lotes';
    protected $id;
    use SoftDeletes;

    public function getAllLotes() {

    	return $this->where('ativo', '=', 1)->get();
    }

    public function getLotesPiquete(){
        return DB::table('lotes')
                    ->select('piquetes.nome as piquete_nome', 'piquetes.id as piquete_id', 'lotes.id as lote_id', 'lotes.nome as lote_nome' )
                    ->leftjoin('piquetes', 'piquetes.id', '=', 'lotes.piquete_id')
                    ->where('lotes.ativo', '=', '1')
                    ->whereNotIn('lotes.id', DB::table('vendas')->pluck('lote_id'))
                    ->get();
    }

    public function getLotesSemPiquete(){
        return DB::table('lotes')
                    ->select('lotes.id as lote_id', 'lotes.nome as lote_nome')
                    ->where('lotes.piquete_id', '=', null)
                    ->where('lotes.ativo', '=', '1')
                    ->whereNotIn('lotes.id', DB::table('vendas')->pluck('lote_id'))
                    ->get();
    }

    public function matriz()
    {
       return $this->hasMany(Matrizes::class);
    }

    public function touro()
    {
       return $this->hasMany(Touros::class);
    }

    public function Piquete()
    {
       return $this->hasOne(Piquetes::class);
    }

    public function nascimento()
    {
       return $this->hasMany(Nascimentos::class);
    }

}
