@if (isset($tipo_tela_id))
<div class="form-group">
  <label class="control-label col-md-1 col-sm-1 col-xs-12" for=""></label>
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Lançamento de Histórico</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">

             <div class="x_content">
                <form action="" method="POST" class="form-horizontal form-label-left">
                <input type="hidden" value="{{$tipo_tela_id}}" id="tipo_tela_id" />
                <input type="hidden" value="{{$id_referencia}}" id="id_referencia" />
              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tipos de lançamento</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control" id="tipo_lancamento" required name="tipo_lancamento">
                        <option value=""></option>
                        @foreach ($tipos_lancamentos as $tipo_lancamento)
                      <option value="{{$tipo_lancamento->id}}">{{$tipo_lancamento->nome}}</option>
                        @endforeach
                      </select>
                  </div>
              </div>
              <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">Data<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="data" name="data" required class="form-control col-md-7 col-xs-12 campo-data" value="">
                    </div>
                </div>

                  <div id="alerts"></div>
                    <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                      <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        </ul>
                      </div>

                      <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                      </div>

                      <div class="btn-group">
                        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                      </div>

                      <div class="btn-group">
                        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                      </div>

                      <div class="btn-group">
                        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                      </div>

                      <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                        <div class="dropdown-menu input-append">
                          <input class="span2" placeholder="URL" type="text" data-edit="createLink">
                          <button class="btn" type="button">Add</button>
                        </div>
                        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                      </div>

                      <div class="btn-group">
                        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                      </div>
                    </div>

                    <div id="editor-one" class="editor-wrapper placeholderText" contenteditable="true"></div>
                  </div>

                <div class="clearfix"></div>
                    <button type="button" id="salvar_historico" onclick="salvaHistorico();" class="btn btn-success">Salvar histórico</button>
                <div class="clearfix"></div>
            </form>
        </div>
      </div>
  </div>
  </div>
  <div class="clearfix"></div>
  <div class="form-group">
        <div class="x_panel col-md-12 col-sm-12 col-xs-12">
          <div class="x_title">
            <h2>Históricos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content" style="display: block;">
            <div class="dashboard-widget-content">
              <ul class="list-unstyled timeline widget">


                @if(isset($historicos))
                  @foreach ($historicos as $historico)
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                          <a>{{ $historico->tipo_lancamento }}</a>
                          </h2>
                          <div class="title">
                            <span>{{ $historico->data_hora }}</span>
                          </div>
                          <p class="excerpt">
                            {{ $historico->texto }}
                          </p>
                        </div>
                      </div>
                    </li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
@endif
