<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use App\Nascimentos as Nascimentos;

class DashboardController extends BaseController {

    public function index() {

        
        $data = array(
				'totalNascidosMes' => (new Nascimentos)->getAllNascimentosMes(),
				'totalNascidosMesFemea' => (new Nascimentos)->getAllNascimentosMesFemea(),
				'totalNascidosMesMacho' => (new Nascimentos)->getAllNascimentosMesMacho(),
				'Nascimentos6Mes1ano' => (new Nascimentos)->getAllNascimentos6Mes1ano(),
				'NaoParidasA1ano' => ((new Nascimentos)->getAllNaoParidasA1ano())[0]->matrizes,
				'totalMatrizes' => (new Nascimentos)->getAllMatrizes(),
				'totalTouros' => (new Nascimentos)->getAllTouros()
			);
        \Log::info($data);
        return view('dashboard',$data);

    }


}
