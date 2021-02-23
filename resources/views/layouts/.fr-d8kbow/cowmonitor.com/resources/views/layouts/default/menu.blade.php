@section('menu')
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Cow Monitor</span></a>
        </div>

        <div class="clearfix"></div>
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ URL::to('/') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Cadastros <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ URL::to('/fazendeiro') }}">Fazendeiro</a></li>
                            <li><a href="{{ URL::to('/fazenda') }}">Fazenda</a></li>
                            <li><a href="{{ URL::to('/piquetes') }}">Piquetes</a></li>
                            <li><a href="{{ URL::to('/lote') }}">Lote</a></li>
                            <li><a href="{{ URL::to('/raca') }}">Raças</a></li>
                            <li><a href="{{ URL::to('/touros') }}">Touros</a></li>
                            <li><a href="{{ URL::to('/matrizes') }}">Matrizes</a></li>
                            <li><a href="{{ URL::to('/nascimentos') }}">Nascimentos</a></li>
                            <li><a href="{{ URL::to('/comprador') }}">Compradores</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-edit"></i> Controle <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ URL::to('/controle-lote') }}">Controle de lotes</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bar-chart"></i> Relatórios <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ URL::to('/nascimento') }}">Nascimentos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>                       
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>


        <!-- /menu footer buttons -->
    </div>
</div>
@stop