@extends('layouts.default.layout')
@extends('layouts.default.rodape')
@extends('layouts.default.menu')
@section('conteudo')

<div class="right_col" role="main">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h3>Piquetes</h3>

                @foreach ($piquetes as $piquete)
                <div class="col-sm-6 col-md-4 piquetes border border-success" data-piquete="{{ $piquete->id }}" id="piquete_{{ $piquete->id }}" ondrop="drop(event)" ondragover="allowDrop(event)"> 
                    <h4 class="nome-piquete" ondrop="return false;">{{ $piquete->nome}}  @if (isset($arraylotes[$piquete->id])) {{' - ( ' . count($arraylotes[$piquete->id]) . " )"}} @else @endif</h4>

                    @if (isset($arraylotes[$piquete->id])) 

                    @foreach ($arraylotes[$piquete->id] as $lote)

                    <div class="col-md-2 lotes" id='{{ $lote['lote_id'] }}' draggable="true" ondragstart="drag(event)" ondrop="return false;">
                        <h6 class="texto-lote" ondrop="return false;">Lote {{ $lote['lote_nome'] }}</h6>
                        <img src="imagens/lote.jpeg" alt="lote" data-lote='{{ $lote['lote_id'] }}' class="rounded-pill img-lote" ondrop="return false;"/>
                    </div>

                    @endforeach

                    @endif                 

                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="x_panel">
            <div class="x_title" >
                <h3>Lotes fora de piquetes</h3>
                <div id="sem-piquetes" class="sem-piquetes" ondrop="drop(event)" ondragover="allowDrop(event)">
                    @foreach ($lotesSemPiquetes as $loteSemPiquete)
                    <div class="col-md-2 lotes" id="{{ $loteSemPiquete->lote_id }}" draggable="true" ondragstart="drag(event)" ondrop="return false;">
                        <h6 class="texto-lote" ondrop="return false;">{{ $loteSemPiquete->lote_nome }}</h6>
                        <img src="imagens/lote.jpeg" alt="lote" data-lote='{{ $loteSemPiquete->lote_id }}' class="rounded-pill img-lote" ondrop="return false;">
                    </div>
                    @endforeach
                </div>            
            </div>            
        </div>            

    </div>            
    @stop