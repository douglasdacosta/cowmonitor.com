<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Fazendas;
use App\Fazendeiros;
use Carbon\Carbon;
use App\Historicos;
use App\TiposLancamentos;


class FazendaController extends BaseController {

    public function index() {

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'rotaIncluir' => 'inclui-fazenda',
				'rotaAlterar' => 'altera-fazenda'
			);
        return redirect()->route('pesquisa-fazenda' );
        // return view('fazenda', $data);

    }

    public function pesquisar($id = null, $nome = null, Request $request) {


        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $fazendas = new Fazendas();
        if ($id) {
        	$fazendas = $fazendas->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
        	$fazendas = $fazendas->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $fazendas = $fazendas->get();

        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'fazendas'=> $fazendas,
				'request' => $request,
				'rotaIncluir' => 'inclui-fazenda',
				'rotaAlterar' => 'altera-fazenda'
			);

        return view('fazenda', $data);

    }

    public function incluir(Request $request) {

    	$metodo = $request->method();

    	if ($metodo == 'POST') {

    		$fazenda_id = $this->salva($request);

	    	return redirect()->route('pesquisa-fazenda', [ 'id' => $fazenda_id ] );

    	}

        $tela = 'incluir';
    	$data = array(
				'tela' => $tela,
				'request' => $request,
				'fazendeiros' => $this->getAllFazendeiro()
			);

        return view('fazenda', $data);

    }


    public function alterar(Request $request) {

        $fazendas = new Fazendas();
        $tipos_lancamentos = new TiposLancamentos();
        $historicos = new Historicos();

        $fazenda = $fazendas->where('id', '=', $request->input('id'))->get();

		$metodo = $request->method();
		if ($metodo == 'POST') {

    		$fazenda_id = $this->salva($request);

	    	return redirect()->route('pesquisa-fazenda', [ 'id' => $fazenda_id ] );

    	}
    	$data = array(
				'tela' => 'alterar',
				'fazenda' => $fazenda,
                'fazendeiros' =>  $this->getAllFazendeiro(),
                'tipos_lancamentos' => $tipos_lancamentos->getAllTiposLancamentos(),
                'tipo_tela_id' => 6,
                'historicos' => $historicos->getHistoricosPorTipoTela(6, $request->input('id')),
                'id_referencia' => $request->input('id')
			);
        return view('fazenda', $data);

    }

    public function getAllFazendeiro() {
        $fazendeiros = new Fazendeiros;
        return $fazendeiros->where('ativo', '=', 1)->get();

    }

    public function getAllFazendas() {
        $fazendas = new Fazendas();
        return $fazendas->where('ativo', '=', 1)->get();

    }

    public function salva($request) {
    		$fazendas = new Fazendas();

    		if($request->input('id')) {
    			$fazendas = $fazendas::find($request->input('id'));
    		}

    		$fazendas->nome = $request->input('nome');
            $fazendas->fazendeiro_id = $request->input('fazendeiro_id');
            $fazendas->endereco = $request->input('endereco');
    		$fazendas->ativo = $request->input('ativo') == 'on' ? 1 : 0;
    		$fazendas->save();

    		return $fazendas->id;

    }

}
