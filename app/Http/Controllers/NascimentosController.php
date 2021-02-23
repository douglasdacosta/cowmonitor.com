<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Nascimentos;
use App\Fazendeiros;
use App\Estagios;
use App\Fazendas;
use App\Lotes;
use App\Touros;
use App\Matrizes;
use Carbon\Carbon;
use App\Http\Middleware\DateHelpers;
use App\Historicos;
use App\TiposLancamentos;


class NascimentosController extends BaseController {

    public function index() {

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'rotaIncluir' => 'inclui-nascimentos',
				'rotaAlterar' => 'altera-nascimentos'
			);
        return redirect()->route('pesquisa-nascimentos' );

    }

    public function pesquisar($id = null, $nome = null, Request $request) {


        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $nascimentos = new Nascimentos();
        if ($id) {
        	$nascimentos = $nascimentos->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
        	$nascimentos = $nascimentos->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $nascimentos = $nascimentos->get();

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'nascimentos'=> $nascimentos,
				'request' => $request,
				'rotaIncluir' => 'inclui-nascimentos',
				'rotaAlterar' => 'altera-nascimentos'
			);

        return view('nascimentos', $data);

    }

    public function incluir(Request $request) {

    	$metodo = $request->method();

    	if ($metodo == 'POST') {

    		$nascimentos_id = $this->salva($request);

	    	return redirect()->route('pesquisa-nascimentos', [ 'id' => $nascimentos_id ] );

    	}




        $tela = 'incluir';
    	$data = array(
				'tela' => $tela,
				'request' => $request,
				'touros' => $this->getAllTouros(),
				'matrizes' => $this->getAllMatrizes(),
				'fazendeiros' => $this->getAllFazendeiros(),
				'lotes' => $this->getAllLotes(),
				'fazendas' => $this->getAllFazendas(),
				'estagios' => $this->getAllEstagios()
			);

        return view('nascimentos', $data);

    }


    public function alterar(Request $request) {

        $nascimentos = new Nascimentos();
        $tipos_lancamentos = new TiposLancamentos();
        $historicos = new Historicos();
        $nascimentos = $nascimentos->where('id', '=', $request->input('id'))->get();

		$metodo = $request->method();

		if ($metodo == 'POST') {

    		$nascimentos_id = $this->salva($request);

	    	return redirect()->route('pesquisa-nascimentos', [ 'id' => $nascimentos_id ] );

    	}
        // dd($nascimentos);
        $data_nascimento = explode('-', explode(' ', $nascimentos[0]->data_nascimento)[0]);
        $data_nascimento = Carbon::createMidnightDate($data_nascimento[0], $data_nascimento[1], $data_nascimento[2]);
        $hoje = Carbon::now();
        $idade = $data_nascimento->diffInMonths($hoje);
    	$data = array(
				'tela' => 'alterar',
				'nascimentos' => $nascimentos,
				'touros' => $this->getAllTouros(),
				'matrizes' => $this->getAllMatrizes(),
				'fazendeiros' => $this->getAllFazendeiros(),
				'lotes' => $this->getAllLotes(),
				'fazendas' => $this->getAllFazendas(),
				'estagios' => $this->getAllEstagios(),
                'idade' => $idade,
                'tipos_lancamentos' => $tipos_lancamentos->getAllTiposLancamentos(),
                'tipo_tela_id' => 3,
                'historicos' => $historicos->getHistoricosPorTipoTela(3, $request->input('id')),
                'id_referencia' => $request->input('id')
			);
        return view('nascimentos', $data);

    }

    public function getAllTouros() {
        $touros = new Touros();
        return $touros->where('ativo', '=', 1)->get();

    }

    public function getAllMatrizes() {
        $matrizes = new Matrizes();
        return $matrizes->where('ativo', '=', 1)->get();

    }

    public function getAllLotes() {
        $lotes = new Lotes();
        return $lotes->where('ativo', '=', 1)->get();

    }

    public function getAllEstagios() {

        $estagios = new Estagios();
        return $estagios->where('ativo', '=', 1)->get();

    }

    public function getAllFazendeiros() {

        $fazendeiros = new Fazendeiros;
        return $fazendeiros->where('ativo', '=', 1)->get();

    }

    public function getAllFazendas() {

        $fazendas = new Fazendas;
        return $fazendas->where('ativo', '=', 1)->get();

    }

    public function salva($request) {
    		$nascimentos = new Nascimentos();

    		if($request->input('id')) {
    			$nascimentos = $nascimentos::find($request->input('id'));
    		}

    		$nascimentos->nome = $request->input('nome');
    		$nascimentos->codigo = $request->input('codigo');
            $nascimentos->fazendeiro_id = $request->input('fazendeiro_id');
            $nascimentos->fazenda_id = $request->input('fazenda_id');
            $nascimentos->lote_id = $request->input('lote_id');
            $nascimentos->touro_id = $request->input('touro_id');
            $nascimentos->matriz_id = $request->input('matriz_id');
            $nascimentos->estagio_id = $request->input('estagio_id');
            $nascimentos->causa_morte = $request->input('causa_morte');
            $nascimentos->sexo = $request->input('sexo');
            $nascimentos->data_compra = DateHelpers::formatDate_dmY($request->input('data_compra'));
            $nascimentos->data_nascimento = DateHelpers::formatDate_dmY($request->input('data_nascimento'));


    		$nascimentos->ativo = $request->input('ativo') == 'on' ? 1 : 0;
    		$nascimentos->save();

    		return $nascimentos->id;

    }

}
