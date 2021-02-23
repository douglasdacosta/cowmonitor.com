<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Racas;
use Carbon\Carbon;

class RacaController extends BaseController {
    
    public function index() {
        
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'rotaIncluir' => 'inclui-raca',
				'rotaAlterar' => 'altera-raca'
			);
        return redirect()->route('pesquisa-raca' );

    }

    public function pesquisar($id = null, $nome = null, Request $request) {
        
        	
        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $racas = new Racas();
        if ($id) {
        	$racas = $racas->where('id', '=', $id);
        }
        
        if ($request->input('nome') != '') {
        	$racas = $racas->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $racas = $racas->get();        
        
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'racas'=> $racas,
				'request' => $request,
				'rotaIncluir' => 'inclui-raca',
				'rotaAlterar' => 'altera-raca'
			);

        return view('raca', $data);
        
    }

    public function incluir(Request $request) {
    	
    	$metodo = $request->method();
    	
    	if ($metodo == 'POST') {

    		$raca_id = $this->salva($request);
    	
	    	return redirect()->route('pesquisa-raca', [ 'id' => $raca_id ] );

    	} 

        $tela = 'incluir';
    	$data = array(
				'tela' => $tela,
				'request' => $request
			);

        return view('raca', $data);
        
    }


    public function alterar(Request $request) {
        
        $racas = new Racas();
        $raca = $racas->where('id', '=', $request->input('id'))->get();

		$metodo = $request->method();
		if ($metodo == 'POST') {

    		$raca_id = $this->salva($request);
    	
	    	return redirect()->route('pesquisa-raca', [ 'id' => $raca_id ] );

    	} 
    	$data = array(
				'tela' => 'alterar',
				'raca' => $raca
			);
        return view('raca', $data);
        
    }

    public function getAllRaca() {
        $racas = new Racas();
        return $racas->where('ativo', '=', 1)->get();

    }

    public function salva($request) {
    		$racas = new Racas();
    		
    		if($request->input('id')) {
    			$racas = $racas::find($request->input('id'));
    		}

    		$racas->nome = $request->input('nome');
    		$racas->ativo = $request->input('ativo') == 'on' ? 1 : 0;
    		$racas->save();
    		
    		return $racas->id;

    }

}
