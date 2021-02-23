@extends('layouts.default.layout')
@extends('layouts.default.rodape')
@extends('layouts.default.menu')
@if(isset($tela) && $tela == 'pesquisa')
    @section('conteudo')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Pesquisa de Compradores<small></small></h2>
                        @include('layouts.default.nav-open-incluir')
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <form id="filtro" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
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
                <h2>Filhos</h2>
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
                    @if(isset($compradores))
                        @foreach ($compradores as $comprador)                
                            <tr>
                              <th scope="row"><a href='{{ URL::route('altera-comprador', array('id' => $comprador->id )) }}'>{{$comprador->id}}</a></th>
                              <td>{{$comprador->nome}}</td>
                              <td>@if ( $comprador->ativo == 1 ) <span class='label label-success' >Ativo</span> @else  <span class='label label-danger' >Inativo</span> @endif </td>
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
                    <h2>@if($tela == 'alterar') Alteração @else Cadastro @endif do Compradores<small></small></h2>
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
                            <form id="alterar" action="/altera-comprador" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="id" name="id" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($comprador[0]->id)){{$comprador[0]->id}}@else{{''}}@endif">
                                </div>
                            </div>
                        @else
                            <form id="incluir" action="/inclui-comprador" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                        @endif
                            @csrf <!--{{ csrf_field() }}-->

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($comprador[0]->nome)){{$comprador[0]->nome}}@else{{''}}@endif" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inscricao_estadual">Inscrição Estadual<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="inscricao_estadual" name="inscricao_estadual" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($comprador[0]->inscricao_estadual)){{$comprador[0]->inscricao_estadual}}@else{{''}}@endif" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf_cnpf">CPF/CNPJ<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="cpf_cnpf" name="cpf_cnpf" required="required"  class="form-control col-md-7 col-xs-12" value="@if (isset($comprador[0]->cpf_cnpf)){{$comprador[0]->cpf_cnpf}}@else{{''}}@endif" maxlength="15">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefone_1">Telefone 1<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telefone_1" name="telefone_1" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($comprador[0]->telefone_1)){{$comprador[0]->telefone_1}}@else{{''}}@endif" maxlength="500">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefone_2">Telefone 2<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telefone_2" name="telefone_2" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($comprador[0]->telefone_2)){{$comprador[0]->telefone_2}}@else{{''}}@endif" maxlength="500">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endereco">Endereço<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="endereco" name="endereco" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($comprador[0]->endereco)){{$comprador[0]->endereco}}@else{{''}}@endif" maxlength="500">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">Cidade
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="cidade" name="cidade" required="required" class="form-control col-md-7 col-xs-12" value="@if (isset($comprador[0]->cidade)){{$comprador[0]->cidade}}@else{{''}}@endif" maxlength="80">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado
                            </label>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <input type="text" id="estado" name="estado" required="required" class="form-control col-md-2 col-xs-12" value="@if (isset($comprador[0]->estado)){{$comprador[0]->estado}}@else{{''}}@endif" maxlength="2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome"></label>
                            <input type="checkbox" @if (!isset($comprador[0]->ativo) || $comprador[0]->ativo == 1) checked @else{{''}}@endif"  data-toggle="toggle" data-on="Ativo" id="ativo" name="ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-danger" onclick="window.history.back();" type="button">Cancelar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@endif