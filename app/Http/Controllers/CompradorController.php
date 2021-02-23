<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Compradores;
use Carbon\Carbon;

class CompradorController extends BaseController {
    
    public function index() {
        
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'rotaIncluir' => 'inclui-comprador',
				'rotaAlterar' => 'altera-comprador'
			);
		return redirect()->route('pesquisa-comprador');
        
    }

    public function pesquisar($id = null, $nome = null, Request $request) {
        
        	
        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $compradores = new Compradores();
        if ($id) {
        	$compradores = $compradores->where('id', '=', $id);
        }
        
        if ($request->input('nome') != '') {
        	$compradores = $compradores->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $compradores = $compradores->get();        
        //dd($request);
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
				'compradores'=> $compradores,
				'request' => $request,
				'rotaIncluir' => 'inclui-comprador',
				'rotaAlterar' => 'altera-comprador'
			);

        return view('compradores', $data);
        
    }

    public function incluir(Request $request) {
    	
    	$metodo = $request->method();
    	
    	if ($metodo == 'POST') {

    		$comprador_id = $this->salva($request);
    	
	    	return redirect()->route('pesquisa-comprador', [ 'id' => $comprador_id ] );

    	} 

        $tela = 'incluir';
    	$data = array(
				'tela' => $tela,
				'request' => $request,
				'compradores' => $this->getAllComprador()
			);

        return view('compradores', $data);
        
    }


    public function alterar(Request $request) {
        
        $compradores = new Compradores();
        $comprador = $compradores->where('id', '=', $request->input('id'))->get();

		$metodo = $request->method();
		if ($metodo == 'POST') {

    		$comprador_id = $this->salva($request);
    	
	    	return redirect()->route('pesquisa-comprador', [ 'id' => $comprador_id ] );

    	} 
    	$data = array(
				'tela' => 'alterar',
				'comprador' => $comprador
			);
        return view('compradores', $data);
        
    }

    public function getAllComprador() {
    	$compradores = new Compradores;
    	return $compradores->where('ativo', '=', 1)->get();

    }

    public function salva($request) {
    		$compradores = new Compradores();
    		
    		if($request->input('id')) {
    			$compradores = $compradores::find($request->input('id'));
    		}
    		$compradores->nome = $request->input('nome');
            $compradores->inscricao_estadual = $request->input('inscricao_estadual');
            $compradores->cpf_cnpf = $request->input('cpf_cnpf');
            $compradores->telefone_1 = $request->input('telefone_1');
            $compradores->telefone_2 = $request->input('telefone_2');
            $compradores->endereco = $request->input('endereco');
    		$compradores->cidade = $request->input('cidade');
    		$compradores->estado = $request->input('estado');
    		$compradores->ativo = $request->input('ativo') == 'on' ? 1 : 0;
    		$compradores->save();
    		
    		return $compradores->id;

    }

}
