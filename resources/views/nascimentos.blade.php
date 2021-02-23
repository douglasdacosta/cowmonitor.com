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
                        <h2>Pesquisa de Nascimento<small></small></h2>
                        @include('layouts.default.nav-open-incluir', ['rotaIncluir => $rotaIncluir'])
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <form id="filtro" action="/pesquisa-nascimentos" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
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
                <h2>Nascimentos</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Brinco</th>
                      <th>Nome</th>
                      <th>Situação</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($nascimentos))
                        @foreach ($nascimentos as $nascimentos)
                            <tr>
                              <th scope="row"><a href='{{ URL::route('altera-nascimentos', array('id' => $nascimentos->id )) }}'>{{$nascimentos->codigo}}</a></th>
                              <td>{{$nascimentos->nome}}</td>
                              <td>@if ( $nascimentos->ativo == 1 ) <span class='label label-success' >Vivo</span> @else  <span class='label label-danger' >Inativo</span> @endif </td>
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
                        <h2>@if($tela == 'alterar') Alteração @else Cadastro @endif de Nascimentos<small></small></h2>
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
                            <form id="alterar" action="/altera-nascimentos" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="id" name="id" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($nascimentos[0]->id)){{$nascimentos[0]->id}}@else{{''}}@endif">
                                </div>
                            </div>
                        @else
                            <form id="incluir" action="/inclui-nascimentos" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                        @endif
                            @csrf <!--{{ csrf_field() }}-->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="codigo">Número do Brinco<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="codigo" name="codigo" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($nascimentos[0]->codigo)){{$nascimentos[0]->codigo}}@else{{''}}@endif" maxlength="100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($nascimentos[0]->nome)){{$nascimentos[0]->nome}}@else{{''}}@endif" maxlength="100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_nascimento">Data do nascimento<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="data_nascimento" name="data_nascimento" class="form-control campo-data" aria-describedby="inputSuccess2Status" value="@if (isset($nascimentos[0]->data_nascimento)){{ Carbon\Carbon::parse($nascimentos[0]->data_nascimento)->format('d/m/Y') }}@else {{ date('d/m/Y', strtotime('-1 day'))  }} @endif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="idade">Idade
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" value=" @if (isset($idade)) {{ Carbon\Carbon::now()->diffInMonths($nascimentos[0]->data_nascimento)}} meses" @else 0 @endif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_compra">Data da compra<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="data_compra" name="data_compra" class="form-control campo-data" aria-describedby="inputSuccess2Status" value="@if (isset($nascimentos[0]->data_compra)){{ Carbon\Carbon::parse($nascimentos[0]->data_compra)->format('d/m/Y') }}@else{{''}}@endif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Pai</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="touro_id" name="touro_id">
                                        @if(isset($touros))
                                            @foreach ($touros as $touro)
                                                <option @if (isset($nascimentos[0]->touro_id) && $nascimentos[0]->touro_id == $touro->id) selected="selected" @else{{''}}@endif value="{{ $touro->id }}">{{ $touro->codigo . ' (' .  $touro->nome . ')'}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Mãe</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="matriz_id" name="matriz_id">
                                        @if(isset($matrizes))
                                            @foreach ($matrizes as $matriz)
                                                <option @if (isset($nascimentos[0]->matriz_id) && $nascimentos[0]->matriz_id == $matriz->id) selected="selected" @else{{''}}@endif value="{{ $matriz->id }}">{{ $matriz->codigo . ' (' .  $matriz->nome . ')'}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sexo</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" id="sexo" name="sexo">
                                            <option @if (isset($nascimentos[0]->sexo) && $nascimentos[0]->sexo == 'M') selected="selected" @else{{''}}@endif value="M">Macho</option>
                                            <option @if (isset($nascimentos[0]->sexo) && $nascimentos[0]->sexo == 'F') selected="selected" @else{{''}}@endif value="M">Femea</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Proprietário</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="fazendeiro_id" name="fazendeiro_id">
                                        @if(isset($fazendeiros))
                                            @foreach ($fazendeiros as $fazendeiro)
                                                <option @if (isset($nascimentos[0]->fazendeiro_id) && $nascimentos[0]->fazendeiro_id == $fazendeiro->id) selected="selected" @else{{''}}@endif value="{{ $fazendeiro->id }}">{{ $fazendeiro->nome }}</option>
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
                                                <option @if (isset($nascimentos[0]->fazenda_id) && $nascimentos[0]->fazenda_id == $fazenda->id) selected="selected" @else{{''}}@endif value="{{ $fazenda->id }}">{{ $fazenda->nome }}</option>
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
                                                <option @if (isset($nascimentos[0]->lote_id) && $nascimentos[0]->lote_id == $lote->id) selected="selected" @else{{''}}@endif value="{{ $lote->id }}">{{ $lote->nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Estágio </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="estagio_id" name="estagio_id">
                                        @if(isset($estagios))
                                            @foreach ($estagios as $estagio)
                                                <option @if (isset($nascimentos[0]->estagio_id) && $nascimentos[0]->estagio_id == $estagio->id) selected="selected" @else{{''}}@endif value="{{ $estagio->id }}">{{ $estagio->nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ativo"></label>
                                <input type="checkbox" data-toggle="toggle" data-on="Vivo" id="ativo" name="ativo" data-off="Morto" data-onstyle="success" data-offstyle="danger" @if (!isset($nascimentos[0]->ativo) || $nascimentos[0]->ativo == 1) checked @else{{''}}@endif>
                            </div>
                            <div class="form-group @if (isset($nascimentos[0]->ativo) && $nascimentos[0]->ativo == 0)  @else hide @endif">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Causa da morte
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="causa_morte" name="causa_morte" required="required" class="form-control col-md-7 col-xs-12 causa_morte" value="@if (isset($nascimentos[0]->causa_morte)){{$nascimentos[0]->causa_morte}}@else{{''}}@endif" maxlength="100">
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
                                @include('layouts.default.historico', ['tela => nascimentos']);
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
