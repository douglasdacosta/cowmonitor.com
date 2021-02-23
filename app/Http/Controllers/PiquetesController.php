<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Piquetes;
use App\Fazendas;
use Carbon\Carbon;
use App\Historicos;
use App\TiposLancamentos;


class PiquetesController extends BaseController {

    public function index() {

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'rotaIncluir' => 'inclui-piquetes',
				'rotaAlterar' => 'altera-piquetes'
			);
        return redirect()->route('pesquisa-piquetes' );

    }

    public function pesquisar($id = null, $nome = null, Request $request) {

        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $piquetes = new Piquetes();

        if ($id) {
        	$piquetes = $piquetes->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
        	$piquetes = $piquetes->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $piquetes = $piquetes->get();

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'piquetes'=> $piquetes,
				'request' => $request,
				'rotaIncluir' => 'inclui-piquetes',
				'rotaAlterar' => 'altera-piquetes'
			);

        return view('piquetes', $data);

    }

    public function incluir(Request $request) {

    	$metodo = $request->method();

    	if ($metodo == 'POST') {
    		$piquete_id = $this->salva($request);

	    	return redirect()->route('pesquisa-piquetes', [ 'id' => $piquete_id ] );

    	}

    	$fazendas = new Fazendas();

        $tela = 'incluir';
    	$data = array(
				'tela' => $tela,
				'request' => $request,
				'fazendas' => $fazendas->getAllFazendas()
			);

        return view('piquetes', $data);

    }


    public function alterar(Request $request) {

        $piquetes = new Piquetes();
        $tipos_lancamentos = new TiposLancamentos();
        $historicos = new Historicos();
        $piquete = $piquetes->where('id', '=', $request->input('id'))->get();

		$metodo = $request->method();
		if ($metodo == 'POST') {

    		$piquete_id = $this->salva($request);

	    	return redirect()->route('pesquisa-piquetes', [ 'id' => $piquete_id ] );

    	}

    	$fazendas = new Fazendas();

    	$data = array(
				'tela' => 'alterar',
				'piquete' => $piquete,
				'fazendas' => $fazendas->getAllFazendas(),
                'tipos_lancamentos' => $tipos_lancamentos->getAllTiposLancamentos(),
                'tipo_tela_id' => 4,
                'historicos' => $historicos->getHistoricosPorTipoTela(4, $request->input('id')),
                'id_referencia' => $request->input('id')
			);
        return view('piquetes', $data);

    }

    public function salva($request) {
    		$piquetes = new Piquetes();

    		if($request->input('id')) {
    			$piquetes = $piquetes::find($request->input('id'));
    		}

    		$piquetes->nome = $request->input('nome');
            $piquetes->fazenda_id = $request->input('fazenda_id');
            $piquetes->benfeitorias = '';
    		// $piquetes->benfeitorias = $request->input('benfeitorias');
    		$piquetes->ativo = $request->input('ativo') == 'on' ? 1 : 0;
    		$piquetes->save();

    		return $piquetes->id;

    }

}
