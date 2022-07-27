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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Nascimentos extends Model
{
    use SoftDeletes;
    
    protected $table = 'nascimentos';
    protected $id;

    public function getAllNascimentos() {

    	return $this->where('ativo', '=', 1)->get();
    }
    
    public function getAllMatrizes() {

    	return (new Matrizes)->getAllMatrizes()->count();
    }
    public function getAllTouros() {

    	return (new Touros)->getAllTouros()->count();
    }
    
    public function getAllNascimentosMes() {
        
        $nowdate =  Carbon::now()->format('Y-m');
    	return $this->where('ativo', '=', 1)->whereDate('data_nascimento', '>=', "$nowdate-1")->get()->count();
    }
    
    public function getAllNascimentosMesFemea() {
        
        $nowdate =  Carbon::now()->format('Y-m');
    	return $this->where('ativo', '=', 1)->where('sexo', '=', 'F')->whereDate('data_nascimento', '>=', "$nowdate-1")->get()->count();
    }
    
    public function getAllNascimentosMesMacho() {
        
        $nowdate =  Carbon::now()->format('Y-m');
    	return $this->where('ativo', '=', 1)->where('sexo', '=', 'M')->whereDate('data_nascimento', '>=', "$nowdate-1")->get()->count();
    }
    
    public function getAllNascimentos6Mes1ano() {
        
        $MonthAgo =  Carbon::now()->subMonths(12)->format('Y-m-d');
        \Log::info($MonthAgo);
    	return $this->where('ativo', '=', 1)->whereDate('data_nascimento', '>=', $MonthAgo)->get()->count();
    }
    
    public function getAllNaoParidasA1ano() {
        
        $MonthAgo =  Carbon::now()->subMonths(12)->format('Y-m-d');
        \Log::info($MonthAgo);
    	return DB::select("select count(A.id) as matrizes from matrizes A where (select count(X.id) from nascimentos X where X.matriz_id=A.id and convert(X.data_nascimento, DATE) >= '$MonthAgo')=0");
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
