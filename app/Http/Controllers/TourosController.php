<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Touros;
use App\Fazendeiros;
use App\Fazendas;
use App\Lotes;
use App\Http\Middleware\DateHelpers;
use App\Historicos;
use App\TiposLancamentos;

class TourosController extends BaseController {

    public function index() {

        $tela = 'pesquisa';
        $data = array(
            'tela' => $tela,
            'rotaIncluir' => 'inclui-touros',
            'rotaAlterar' => 'altera-touros'
        );
        return redirect()->route('pesquisa-touros');
    }

    public function pesquisar($id = null, $nome = null, Request $request) {


        $id = !empty($request->input('id')) ? ($request->input('id')) : (!empty($id) ? $id : false );

        $touros = new Touros();
        if ($id) {
            $touros = $touros->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
            $touros = $touros->where('nome', 'like', '%' . $request->input('nome') . '%');
        }

        $touros = $touros->get();

        $tela = 'pesquisa';
        $data = array(
            'tela' => $tela,
            'touros' => $touros,
            'request' => $request,
            'rotaIncluir' => 'inclui-touros',
            'rotaAlterar' => 'altera-touros'
        );

        return view('touros', $data);
    }

    public function incluir(Request $request) {

        $metodo = $request->method();

        if ($metodo == 'POST') {

            $touros_id = $this->salva($request);

            return redirect()->route('pesquisa-touros', ['id' => $touros_id]);
        }

        $tela = 'incluir';
        $data = array(
            'tela' => $tela,
            'request' => $request,
            'fazendeiros' => $this->getAllFazendeiros(),
            'lotes' => $this->getAllLotes(),
            'fazendas' => $this->getAllFazendas()
        );

        return view('touros', $data);
    }

    public function alterar(Request $request) {

        $touros = new Touros();
        $tipos_lancamentos = new TiposLancamentos();
        $historicos = new Historicos();
        $touros = $touros->where('id', '=', $request->input('id'))->get();

        $metodo = $request->method();

        if ($metodo == 'POST') {

            $touros_id = $this->salva($request);

            return redirect()->route('pesquisa-touros', ['id' => $touros_id]);
        }

        $data = array(
            'tela' => 'alterar',
            'touro' => $touros,
            'fazendeiros' => $this->getAllFazendeiros(),
            'lotes' => $this->getAllLotes(),
            'fazendas' => $this->getAllFazendas(),
            'tipos_lancamentos' => $tipos_lancamentos->getAllTiposLancamentos(),
            'tipo_tela_id' => 1,
            'historicos' => $historicos->getHistoricosPorTipoTela(1, $request->input('id')),
            'id_referencia' => $request->input('id')
        );
        return view('touros', $data);
    }

    public function getAllTouros() {
        $touros = new Touros();
        return $touros->where('ativo', '=', 1)->get();
    }

    public function getAllLotes() {
        $lotes = new Lotes();
        return $lotes->where('ativo', '=', 1)->get();
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
        $touros = new Touros();

        if ($request->input('id')) {
            $touros = $touros::find($request->input('id'));
        }
        $touros->nome = $request->input('nome');
        $touros->codigo = $request->input('codigo');
        $touros->fazendeiro_id = $request->input('fazendeiro_id');
        $touros->fazenda_id = $request->input('fazenda_id');
        $touros->lote_id = $request->input('lote_id');
        $touros->piquete_id = $request->input('piquete_id');
        $touros->data_compra = DateHelpers::formatDate_dmY($request->input('data_compra'));
        $touros->emprestado = $request->input('emprestado');
        $touros->data_emprestimo = DateHelpers::formatDate_dmY($request->input('data_emprestimo'));
        $touros->emprestado_para = $request->input('emprestado_para');
        $touros->causa_morte = $request->input('causa_morte');
        $touros->ativo = $request->input('ativo') == 'on' ? 1 : 0;
        $touros->save();

        return $touros->id;
    }

}
