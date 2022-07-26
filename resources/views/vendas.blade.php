@extends('layouts.default.layout')
@extends('layouts.default.rodape')
@extends('layouts.default.menu')
@if(isset($tela) and $tela == 'pesquisa')
@section('conteudo')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pesquisa de lote de vendas<small></small></h2>
                    @include('layouts.default.nav-open-incluir', ['rotaIncluir => $rotaIncluir'])
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div><form id="filtro" action="pesquisa-vendas" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="id" name="id" class="form-control col-md-7 col-xs-12" value="@if (isset($request) && $request->input('id') != ''){{$request->input('id')}}@else @endif">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome</label>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="nome" name="nome" class="form-control col-md-7 col-xs-12" value="@if (isset($request) && trim($request->input('nome')) != ''){{$request->input('nome')}}@else @endif">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </div>
    </form>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lote de Vendas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($vendas))
                            @foreach ($vendas as $venda)
                            <tr>
                                <th scope="row"><a href='{{ URL::route('altera-vendas', array('id' => $venda->id )) }}'>{{$venda->id}}</a></th>
                                <td>{{$venda->nome}}</td>
                                <td>@if ( $venda->ativo == 1 ) <span class='label label-success' >Ativo</span> @else  <span class='label label-danger' >Inativo</span> @endif </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@else

@section('conteudo')

<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>@if($tela == 'alterar') Alteração @else Cadastro @endif de Venda<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if($tela == 'alterar')
                    <form id="alterar" action="altera-vendas" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="id" name="id" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($venda[0]->id)){{$venda[0]->id}}@else{{''}}@endif">
                            </div>
                        </div>
                        @else
                        <form id="incluir" action="inclui-vendas" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                            @endif
                            @csrf <!--{{ csrf_field() }}-->

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_hora">Data venda<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="data_compra" name="data_hora" class="form-control campo-data" aria-describedby="inputSuccess2Status" value="@if (isset($venda[0]->data_hora)){{ Carbon\Carbon::parse($venda[0]->data_hora)->format('d/m/Y') }}@else {{ date('d/m/Y', strtotime('-1 day'))  }}  @endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Comprador</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="comprador_id" name="comprador_id">
                                        <option value="0" @if (!isset($venda[0]->comprador_id)) selected="selected" @else{{''}}@endif></option>
                                        @if(isset($compradores))
                                        @foreach ($compradores as $comprador)
                                        <option @if (isset($venda[0]->comprador_id) && $venda[0]->comprador_id == $comprador->id) selected="selected" @else{{''}}@endif value="{{ $comprador->id }}">{{ $comprador->nome }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Lote</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="lote_id" name="lote_id">
                                        <option value="0" @if (!isset($venda[0]->lote_id)) selected="selected" @else{{''}}@endif></option>
                                        @if(isset($lotes))
                                        @foreach ($lotes as $lote)
                                        <option @if (isset($venda[0]->lote_id) && $venda[0]->lote_id == $lote->id) selected="selected" @else{{''}}@endif value="{{ $lote->id }}">{{ $lote->nome }} @if($lote->deleted_at == '') {{''}} @else {{' - VENDIDO'}} @endif </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Observações</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="observacao" name="observacao">@if (isset($venda[0]->observacao) && trim($venda[0]->observacao) != ''){{$venda[0]->observacao}}@else{{''}}@endif</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor">Valor da venda<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="valor" name="valor" class="form-control" value="@if (isset($venda[0]->valor)){{ number_format($venda[0]->valor, 2, ',', '.') }} @else{{'0,00'}}    @endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ativo"></label>
                                <input type="checkbox" data-toggle="toggle" data-on="Ativo" id="ativo" name="ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger" @if (!isset($venda[0]->ativo) || $venda[0]->ativo == 1) checked @else{{''}}@endif>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-danger" onclick="window.history.back();" type="button">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                @include('layouts.default.historico', ['tela => vendas']);
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@endif
