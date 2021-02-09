<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- os "meta", "link" e "title" padrões para todas as pags -->
        @include('header')

        @yield('head')
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header">
                    <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="top-left-part">
                        <a class="logo" href="/">
                            <b>
                                <img src="{{URL::asset('plugins/images/davitaLogo.png')}}" class="logo" alt="logo" />
                            </b>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-top-links navbar-right hidden-xs">
                            @if(Auth::user()->is_admin == 'AD' || Auth::user()->is_admin == 'CL')
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-pencil fa-fw"></i> Cadastros <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @if(Auth::user()->is_admin == 'AD')
                                        <li>
                                            <a class="waves-effect" href="/users" aria-expanded="false"><i class="icon-user-follow fa-fw"></i> Cadastrar Usuário</a>
                                        </li>
                                        @endif
                                        <li>
                                            <a class="waves-effect" href="/colegas" aria-expanded="false"><i class="icon-user-follow fa-fw"></i> Cadastrar Colega</a>
                                        </li>
                                        <li>
                                            <a class="waves-effect" href="/colegas/importar" aria-expanded="false"><i class="icon-user-follow fa-fw"></i> Importar Colegas</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <li>
                                <a class="waves-effect" href="/form" aria-expanded="false"><i class="icon-chart fa-fw"></i> Form</a>
                            </li>
                            <li>
                                <a class="waves-effect" href="/resultado" aria-expanded="false"><i class="icon-chart fa-fw"></i> Resultado</a>
                            </li>

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-pie-chart fa-fw"></i> Relatórios <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/relatorios/absenteismo-total"><i class="fa fa-bar-chart-o"></i> Absenteismo Total</a>
                                    </li>
                                    <li>
                                        <a href="/relatorios/absenteismo-departamento"><i class="fa fa-bar-chart-o"></i> Indicadores de Absenteísmo por dia e por departamento </a>
                                    </li>
                                    <li>
                                        <a href="/relatorios/absenteismo-unidade"><i class="fa fa-bar-chart-o"></i> Indicadores de absenteísmo por dia e por unidade </a>
                                    </li>
                                    @if(Auth::user()->is_admin != null)
                                    <li>
                                        <a href="/relatorios/dias-afastamento"><i class="fa fa-bar-chart-o"></i> Tabela de afastados</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="/relatorios/vacinas"><i class="fa fa-bar-chart-o"></i> Vacinas </a>
                                    </li>
                                </ul>
                            </li>
                            @if(Auth::user()->is_admin != null)
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bar-chart-o"></i> Gráficos <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/graficos/atestados"><i class="fa fa-bar-chart-o"></i> Atestados</a>
                                    </li>
                                    <li>
                                        <a href="/graficos/covid"><i class="fa fa-bar-chart-o"></i> Covid</a>
                                    </li>
                                    <li>
                                        <a href="/graficos/funcao"><i class="fa fa-bar-chart-o"></i> Função</a>
                                    </li>
                                    <li>
                                        <a href="/graficos/cid"><i class="fa fa-bar-chart-o"></i> CID</a>
                                    </li>
                                    <li>
                                        <a href="/graficos/inss"><i class="fa fa-bar-chart-o"></i> Afastadis Pelo INSS</a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            <li>
                                <a href="/password"><i class="icon-lock fa-fw"></i> Alterar Senha</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="icon-close fa-fw"></i> Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="page-wrapper">

                @yield('content')

                <footer class="footer t-a-c">
                    © B2fly Consultoria e Serviços de Tecnologia LTDA 2020
                </footer>
            </div>
        </div>

        <!-- os "scripts src" padrões para todas as pags -->
        @include('scripts')

        @yield('script')
    </body>
</html>

