<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Lotes;
use App\Piquetes;
use App\Historicos;
use App\TiposLancamentos;
use Carbon\Carbon;

class LoteController extends BaseController {

    public function index() {

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'rotaIncluir' => 'inclui-lote',
				'rotaAlterar' => 'altera-lote'
			);
        return redirect()->route('pesquisa-lote' );

    }

    public function pesquisar($id = null, $nome = null, Request $request) {


        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $lotes = new Lotes();
        if ($id) {
            $lotes = $lotes->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
        	$lotes = $lotes->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $lotes = $lotes
                ->orderBy('ativo', 'desc')
                ->orderBy('id')
                ->get();

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'lotes'=> $lotes,
				'request' => $request,
				'rotaIncluir' => 'inclui-lote',
				'rotaAlterar' => 'altera-lote'
			);

        return view('lote', $data);

    }

    public function incluir(Request $request) {

    	$metodo = $request->method();

    	if ($metodo == 'POST') {

    		$lote_id = $this->salva($request);

	    	return redirect()->route('pesquisa-lote', [ 'id' => $lote_id ] );

    	}

        $tela = 'incluir';
    	$data = array(
				'tela' => $tela,
                'request' => $request,
                'tabela' => 'lote',
                'piquetes' => $this->getAllPiquetes()
			);

        return view('lote', $data);

    }


    public function alterar(Request $request) {

        $lotes = new Lotes();
        $tipos_lancamentos = new TiposLancamentos();
        $historicos = new Historicos();

        $lote = $lotes->where('id', '=', $request->input('id'))->get();

		$metodo = $request->method();
		if ($metodo == 'POST') {

    		$lote_id = $this->salva($request);

	    	return redirect()->route('pesquisa-lote', [ 'id' => $lote_id ] );

        }
        $tipos_lancamentos = new TiposLancamentos();
        $historicos = new Historicos();
    	$data = array(
				'tela' => 'alterar',
				'lote' => $lote,
                'piquetes' => $this->getAllPiquetes(),
                'tipos_lancamentos' => $tipos_lancamentos->getAllTiposLancamentos(),
                'tipo_tela_id' => 5,
                'historicos' => $historicos->getHistoricosPorTipoTela(5, $request->input('id')),
                'id_referencia' => $request->input('id')
			);
        return view('lote', $data);

    }

    public function salva($request) {
    		$lotes = new Lotes();
    		if($request->input('id')) {
    			$lotes = $lotes::find($request->input('id'));
    		}
    		$lotes->nome = $request->input('nome');
    		$lotes->piquete_id = $request->input('piquete_id');
            $lotes->ativo = $request->input('ativo') == 'on' ? 1 : 0;
    		$lotes->save();

    		return $lotes->id;

    }

    public function getAllPiquetes() {

        $piquetes = new Piquetes();
        return $piquetes->where('ativo', '=', 1)->get();

    }


}
