<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Piquetes;
use App\Lotes;

class ControleLoteController extends BaseController {

    /**
     *
     * @return type
     */
    public function index() {

        $piquetes = new Piquetes();

        $lotes = new Lotes();

        $lotesPiquetes = $lotes->getLotesPiquete();
        $lotesSemPiquetes = $lotes->getLotesSemPiquete();

        $arrayLotes = [];

        foreach ($lotesPiquetes as $key => $lote) {

            $arrayLotes[$lote->piquete_id][] = [
                'lote_nome' => $lote->lote_nome,
                'lote_id' => $lote->lote_id
            ];
        }

        $data = [
            'piquetes' => $piquetes->where('ativo', '=', '1' )->get(),
            'arraylotes' => $arrayLotes,
            'lotesSemPiquetes' => $lotesSemPiquetes
        ];

        return view('controle-lote', $data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function alterarLotes(Request $request) {

        $piquete_id = $request->input('piquete_id');
        $lotes = $request->input('lotes');

        $lotes =  implode(',', $lotes);

        $results = DB::update("UPDATE lotes SET piquete_id = $piquete_id WHERE id IN ( $lotes )");

        return var_dump($results);
    }

}
