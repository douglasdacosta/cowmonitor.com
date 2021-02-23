<?php

namespace App\Http\Controllers;

use App\Compradores;
use App\Http\Middleware\DateHelpers;
use App\Lotes;
use App\Nascimentos;
use App\Vendas;
use App\VendasItens;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;
use function redirect;
use function view;
use Illuminate\Database\QueryException;

class VendasController extends BaseController {

    /**
     *
     * @return type
     */
    public function index() {

        $tela = 'pesquisa';
        $data = array(
            'tela' => $tela,
            'rotaIncluir' => 'inclui-vendas',
            'rotaAlterar' => 'altera-vendas'
        );
        return redirect()->route('pesquisa-vendas');

        return view('vendas', $data);
    }

    public function pesquisar($id = null, Request $request) {

        $id = !empty($request->input('id')) ? ($request->input('id')) : (!empty($id) ? $id : false );

        $vendas = new Vendas();
        if ($id) {
            $vendas = $vendas->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
            $vendas = $vendas->where('nome', 'like', '%' . $request->input('nome') . '%');
        }

        $vendas = $vendas->get();

        $tela = 'pesquisa';

        $data = array(
            'tela' => $tela,
            'vendas' => $vendas,
            'request' => $request,
            'rotaIncluir' => 'inclui-vendas',
            'rotaAlterar' => 'altera-vendas'
        );

        return view('vendas', $data);
    }

    public function incluir(Request $request) {

        $metodo = $request->method();

        if ($metodo == 'POST') {

            $vendas_id = $this->salva($request);

            return redirect()->route('pesquisa-vendas', ['id' => $vendas_id]);
        }

        $lotes = new Lotes();
        $compradores = new Compradores();
        $tela = 'incluir';
        $data = array(
            'tela' => $tela,
            'request' => $request,
            'lotes' => $lotes->getAllLotes(),
            'compradores' => $compradores->getAllCompradores()
        );

        return view('vendas', $data);
    }

    public function alterar(Request $request) {

        $vendas = new Vendas();
        $vendas = $vendas->where('id', '=', $request->input('id'))->get();
        $lotes = new Lotes();
        $compradores = new Compradores();
        $metodo = $request->method();
        
        if ($metodo == 'POST') {

            $vendas_id = $this->salva($request);
            if (!$vendas_id) {
                return redirect()->back()->withErrors(['message', 'Erro ao realizar a operação']);
            }

            return redirect()->route('pesquisa-vendas', ['id' => $vendas_id]);
        }

        $data = array(
            'tela' => 'alterar',
            'venda' => $vendas,
            'lotes' => $lotes->withTrashed()->get(),
            'compradores' => $compradores->getAllCompradores(),
            'id_referencia' => $request->input('id')
        );
        return view('vendas', $data);
    }

    public function salva($request) {
        DB::beginTransaction();
        try {
            $vendas = new Vendas();
            $vendasItens = new VendasItens();
            $Nascimentos = new Nascimentos();
            $lotes = new Lotes();


            $lotes::where('id', '=', $request->input('lote_id'))->delete();
            if ($request->input('id')) {
                $vendas = Vendas::find($request->input('id'));
                $vendasItens::where('vendas_id', '=', $vendas->id)->delete();
                if($vendas->lote_id != $request->input('lote_id')) {
                    $lotes::where('id', '=', $vendas->lote_id)->restore();
                }
                $Nascimentos::where('lote_id', '=', $vendas->lote_id)->restore();
            }


            $vendas->comprador_id = $request->input('comprador_id');
            $vendas->observacao = $request->input('observacao');
            $vendas->lote_id = $request->input('lote_id');
            $vendas->valor = DateHelpers::formatFloatValue($request->input('valor'));
            $vendas->data_hora = DateHelpers::formatDate_dmY($request->input('data_hora'));
            $vendas->ativo = $request->input('ativo') == 'on' ? 1 : 0;

            $vendas->save();
            
            if($request->input('ativo') != 'on') {
                $lotes::where('id', '=', $vendas->lote_id)->restore();  
                $Nascimentos::where('lote_id', '=', $vendas->lote_id)->restore();                
                
            } else {
                $Nascimentos = $Nascimentos::where('lote_id', '=', $request->input('lote_id'))->get();
                foreach ($Nascimentos as $nascimento) {

                    $vendasItens = new $vendasItens();
                    $vendasItens->vendas_id = $vendas->id;
                    $vendasItens->nascimentos_id = $nascimento->id;
                    $nascimento->delete();
                    $vendasItens->save();
                }
            }

            
            DB::commit();
            return $vendas->id;
        } catch (QueryException $exc) {
            DB::rollBack();
            return false;
        }
    }

}
