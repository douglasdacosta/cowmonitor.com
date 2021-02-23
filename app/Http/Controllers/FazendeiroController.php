<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Fazendeiros;
use Carbon\Carbon;

class FazendeiroController extends BaseController {
    
    public function index() {
        
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'rotaIncluir' => 'inclui-fazendeiro',
				'rotaAlterar' => 'altera-fazendeiro'
			);
		return redirect()->route('pesquisa-fazendeiro');
        
    }

    public function pesquisar($id = null, $nome = null, Request $request) {
        
        	
        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $fazendeiros = new Fazendeiros();
        if ($id) {
        	$fazendeiros = $fazendeiros->where('id', '=', $id);
        }
        
        if ($request->input('nome') != '') {
        	$fazendeiros = $fazendeiros->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $fazendeiros = $fazendeiros->get();        
        //dd($request);
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'fazendeiros'=> $fazendeiros,
				'request' => $request,
				'rotaIncluir' => 'inclui-fazendeiro',
				'rotaAlterar' => 'altera-fazendeiro'
			);

        return view('fazendeiro', $data);
        
    }

    public function incluir(Request $request) {
    	
    	$metodo = $request->method();
    	
    	if ($metodo == 'POST') {

    		$fazendeiro_id = $this->salva($request);
    	
	    	return redirect()->route('pesquisa-fazendeiro', [ 'id' => $fazendeiro_id ] );

    	} 

        $tela = 'incluir';
    	$data = array(
				'tela' => $tela,
				'request' => $request,
				'fazendeiros' => $this->getAllFazendeiro()
			);

        return view('fazendeiro', $data);
        
    }


    public function alterar(Request $request) {
        
        $fazendeiros = new Fazendeiros();
        $fazendeiro = $fazendeiros->where('id', '=', $request->input('id'))->get();

		$metodo = $request->method();
		if ($metodo == 'POST') {

    		$fazendeiro_id = $this->salva($request);
    	
	    	return redirect()->route('pesquisa-fazendeiro', [ 'id' => $fazendeiro_id ] );

    	} 
    	$data = array(
				'tela' => 'alterar',
				'fazendeiro' => $fazendeiro
			);
        return view('fazendeiro', $data);
        
    }

    public function getAllFazendeiro() {
    	$fazendeiros = new Fazendeiros;
    	return $fazendeiros->where('ativo', '=', 1)->get();

    }

    public function salva($request) {
    		$fazendeiros = new Fazendeiros();
    		
    		if($request->input('id')) {
    			$fazendeiros = $fazendeiros::find($request->input('id'));
    		}
    		$fazendeiros->nome = $request->input('nome');
    		$fazendeiros->endereco = $request->input('endereco');
    		$fazendeiros->documento = $request->input('documento');
    		$fazendeiros->cidade = $request->input('cidade');
    		$fazendeiros->estado = $request->input('estado');
    		$fazendeiros->ativo = $request->input('ativo') == 'on' ? 1 : 0;
    		$fazendeiros->save();
    		
    		return $fazendeiros->id;

    }

}
