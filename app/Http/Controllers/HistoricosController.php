<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historicos;
use App\Http\Middleware\DateHelpers;

class HistoricosController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salvar(Request $request)
    {
        $historico = new Historicos();

        $historico->tipo_lancamento =  $request->input('tipo_lancamento');
        $historico->tipo_tela_id =  $request->input('tipo_tela_id');
        $historico->data_hora =  DateHelpers::formatDate_dmY($request->input('data'));
        $historico->texto =  $request->input('historico');
        $historico->id_referencia =  $request->input('id_referencia');
        $historico->ativo = 1;

        return ($historico->save()) ? '1' : 'Erro na inclusão';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
