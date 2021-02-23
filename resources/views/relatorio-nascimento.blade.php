@extends('layouts.default.layout')
@extends('layouts.default.rodape')
@extends('layouts.default.menu')
@section('conteudo')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Relatórios de nascimentos<small></small></h2>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <form id="filtro" action="/pesquisa-vendas" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_nascimento">Data do nascimento<span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="data_a" name="data_a" class="form-control campo-data" value="{{  date("d/m/Y", strtotime(' -1 month')) }}">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="data_b" name="data_b" class="form-control campo-data" value="{{ date('d/m/Y') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </div>
    </form>
    
</div>
@stop
