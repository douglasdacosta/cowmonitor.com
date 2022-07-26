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
                        <h2>Pesquisa de Lotes<small></small></h2>
                        @include('layouts.default.nav-open-incluir', ['rotaIncluir => $rotaIncluir'])
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <form id="filtro" action="pesquisa-lote" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
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
                <h2>Lotes</h2>
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
                    @if(isset($lotes))
                        @foreach ($lotes as $lote)
                            <tr>
                              <th scope="row"><a href='{{ URL::route('altera-lote', array('id' => $lote->id )) }}'>{{$lote->id}}</a></th>
                              <td>{{$lote->nome}}</td>
                              <td>@if ( $lote->ativo == 1 ) <span class='label label-success' >Ativo</span> @else  <span class='label label-danger' >Inativo</span> @endif </td>
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
                        <h2>@if($tela == 'alterar') Alteração @else Cadastro @endif de Lotes<small></small></h2>
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
                            <form id="alterar" action="altera-lote" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="id" name="id" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($lote[0]->id)){{$lote[0]->id}}@else{{''}}@endif">
                                </div>
                            </div>
                        @else
                            <form id="incluir" action="inclui-lote" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                        @endif
                            @csrf <!--{{ csrf_field() }}-->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($lote[0]->nome)){{$lote[0]->nome}}@else{{''}}@endif" maxlength="100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Piquete</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="piquete_id" name="piquete_id">
                                        <option  value=""></option>
                                        @if(isset($piquetes))
                                            @foreach ($piquetes as $piquete)
                                                <option @if (isset($touro[0]->piquete_id) && $touro[0]->piquete_id == $piquete->id) selected="selected" @else{{''}}@endif value="{{ $piquete->id }}">{{ $piquete->nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome"></label>
                                <input type="checkbox" data-toggle="toggle" data-on="Ativo" id="ativo" name="ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger" @if (!isset($lote[0]->ativo) || $lote[0]->ativo == 1) checked @else{{''}}@endif>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-danger" onclick="window.history.back();" type="button">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </div>
                            <div class="form-group">
                                @include('layouts.default.historico', ['tela => lotes']);
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
