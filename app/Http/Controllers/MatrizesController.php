<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Matrizes;
use App\Fazendeiros;
use App\Fazendas;
use App\Lotes;
use Carbon\Carbon;
use App\Http\Middleware\DateHelpers;
use App\Historicos;
use App\TiposLancamentos;

class MatrizesController extends BaseController {

    public function index() {

        $tela = 'pesquisa';
        $data = array(
            'tela' => $tela,
            'rotaIncluir' => 'inclui-matrizes',
            'rotaAlterar' => 'altera-matrizes'
        );
        return redirect()->route('pesquisa-matrizes');
        // return view('matrizes', $data);
    }

    public function pesquisar($id = null, $nome = null, Request $request) {


        $id = !empty($request->input('id')) ? ($request->input('id')) : (!empty($id) ? $id : false );

        $matrizes = new Matrizes();
        if ($id) {
            $matrizes = $matrizes->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
            $matrizes = $matrizes->where('nome', 'like', '%' . $request->input('nome') . '%');
        }

        $matrizes = $matrizes->get();

        $tela = 'pesquisa';
        $data = array(
            'tela' => $tela,
            'matrizes' => $matrizes,
            'request' => $request,
            'rotaIncluir' => 'inclui-matrizes',
            'rotaAlterar' => 'altera-matrizes'
        );

        return view('matrizes', $data);
    }

    public function incluir(Request $request) {

        $metodo = $request->method();

        if ($metodo == 'POST') {

            $matrizes_id = $this->salva($request);

            return redirect()->route('pesquisa-matrizes', ['id' => $matrizes_id]);
        }

        $tela = 'incluir';
        $data = array(
            'tela' => $tela,
            'request' => $request,
            'fazendeiros' => $this->getAllFazendeiros(),
            'lotes' => $this->getAllLotes(),
            'fazendas' => $this->getAllFazendas()
        );

        return view('matrizes', $data);
    }

    public function alterar(Request $request) {

        $matrizes = new Matrizes();
        $matrizes = $matrizes->where('id', '=', $request->input('id'))->get();

        $metodo = $request->method();

        if ($metodo == 'POST') {

            $matrizes_id = $this->salva($request);

            return redirect()->route('pesquisa-matrizes', ['id' => $matrizes_id]);
        }
        $tipos_lancamentos = new TiposLancamentos();
        $historicos = new Historicos();
        $data = array(
        'tela' => 'alterar',
        'matriz' => $matrizes,
        'fazendeiros' => $this->getAllFazendeiros(),
        'lotes' => $this->getAllLotes(),
        'fazendas' => $this->getAllFazendas(),
        'tipos_lancamentos' => $tipos_lancamentos->getAllTiposLancamentos(),
        'tipo_tela_id' => 2,
        'historicos' => $historicos->getHistoricosPorTipoTela(2, $request->input('id')),
        'id_referencia' => $request->input('id')
        );
        return view('matrizes', $data);
    }

    public function getAllMatrizes() {
        $matrizes = new Matrizes();
        return $matrizes->where('ativo', '=', 1)->get();
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
        $matrizes = new Matrizes();

        if ($request->input('id')) {
            $matrizes = $matrizes::find($request->input('id'));
        }

        $matrizes->nome = $request->input('nome');
        $matrizes->codigo = $request->input('codigo');
        $matrizes->fazendeiro_id = $request->input('fazendeiro_id');
        $matrizes->fazenda_id = $request->input('fazenda_id');
        $matrizes->lote_id = $request->input('lote_id');
        $matrizes->piquete_id = $request->input('piquete_id');
        $matrizes->causa_morte = $request->input('causa_morte');
        $matrizes->data_compra = DateHelpers::formatDate_dmY($request->input('data_compra'));
        $matrizes->ativo = $request->input('ativo') == 'on' ? 1 : 0;
        $matrizes->save();

        return $matrizes->id;
    }

}
