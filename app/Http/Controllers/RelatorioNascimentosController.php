<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of RelatorioNascimentosController
 *
 * @author douglas
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Nascimentos;

class RelatorioNascimentosController extends BaseController {
    
    
    /**
     *
     * @return type
     */
    public function index() {
        
        $data = [];
        return view('relatorio-nascimento', $data);
    }
    
    /**
     *
     * @return type
     */
    public function gerarRelatorio(Request $request) {
        $data = [];
        
        $data_a = $request->input('data_a');
        $data_b = $request->input('data_b');
        
        
        
        return view('relatorio-nascimento', $data);
    }
    
    
}
