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
                        <h2>Pesquisa de Matrizes<small></small></h2>
                        @include('layouts.default.nav-open-incluir', ['rotaIncluir => $rotaIncluir'])
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <form id="filtro" action="pesquisa-matrizes" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
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
                <h2>Matrizes</h2>
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
                    @if(isset($matrizes))
                        @foreach ($matrizes as $matriz)
                            <tr>
                              <th scope="row"><a href='{{ URL::route('altera-matrizes', array('id' => $matriz->id )) }}'>{{$matriz->id}}</a></th>
                              <td>{{$matriz->nome}}</td>
                              <td>@if ( $matriz->ativo == 1 ) <span class='label label-success' >Vivo</span> @else  <span class='label label-danger' >Morto</span> @endif </td>
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
                        <h2>@if($tela == 'alterar') Alteração @else Cadastro @endif da Matriz<small></small></h2>
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
                            <form id="alterar" action="altera-matrizes" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="id" name="id" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($matriz[0]->id)){{$matriz[0]->id}}@else{{''}}@endif">
                                </div>
                            </div>
                        @else
                            <form id="incluir" action="inclui-matrizes" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                        @endif
                            @csrf <!--{{ csrf_field() }}-->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="codigo">Número do Brinco<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="codigo" name="codigo" required class="form-control col-md-7 col-xs-12" value="@if (isset($matriz[0]->codigo)){{$matriz[0]->codigo}}@else{{''}}@endif" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($matriz[0]->nome)){{$matriz[0]->nome}}@else{{''}}@endif" maxlength="100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_compra">Data compra<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="data_compra" name="data_compra" class="form-control campo-data" aria-describedby="inputSuccess2Status" value="@if (isset($matriz[0]->data_compra))  {{ Carbon\Carbon::parse($matriz[0]->data_compra)->format('d/m/Y') }}@else {{ date('d/m/Y', strtotime('-1 day'))  }} @endif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Proprietário</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="fazendeiro_id" name="fazendeiro_id">
                                        @if(isset($fazendeiros))
                                            @foreach ($fazendeiros as $fazendeiro)
                                                <option @if (isset($matriz[0]->fazendeiro_id) && $matriz[0]->fazendeiro_id == $fazendeiro->id) selected="selected" @else{{''}}@endif value="{{ $fazendeiro->id }}">{{ $fazendeiro->nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Fazenda</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="fazenda_id" name="fazenda_id">
                                        @if(isset($fazendas))
                                            @foreach ($fazendas as $fazenda)
                                                <option @if (isset($matriz[0]->fazenda_id) && $matriz[0]->fazenda_id == $fazenda->id) selected="selected" @else{{''}}@endif value="{{ $fazenda->id }}">{{ $fazenda->nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Lote</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="lote_id" name="lote_id">
                                        @if(isset($lotes))
                                            @foreach ($lotes as $lote)
                                                <option @if (isset($matriz[0]->lote_id) && $matriz[0]->lote_id == $lote->id) selected="selected" @else{{''}}@endif value="{{ $lote->id }}">{{ $lote->nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ativo"></label>
                                <input type="checkbox" data-toggle="toggle" data-on="Vivo" id="ativo" name="ativo" data-off="Morto" data-onstyle="success" data-offstyle="danger" @if (!isset($matriz[0]->ativo) || $matriz[0]->ativo == 1) checked @else{{''}}@endif>
                            </div>
                            <div class="form-group @if (isset($matriz[0]->ativo) && $matriz[0]->ativo == 0)  @else hide @endif">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Causa da morte
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="causa_morte" name="causa_morte" required="required" class="form-control col-md-7 col-xs-12 causa_morte" value="@if (isset($nascimentos[0]->causa_morte)){{$matriz[0]->causa_morte}}@else{{''}}@endif" maxlength="100">
                                </div>
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
                                @include('layouts.default.historico', ['tela => matrizes']);
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
