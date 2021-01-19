<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('plugins/images/virus.png')}}">
        <title>Davita - RH</title>
        <!-- ===== Bootstrap CSS ===== -->
        <link href="{{URL::asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- ===== Plugin CSS ===== -->
        <link href="{{URL::asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
        <link href="{{URL::asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('plugins/components/switchery/dist/switchery.min.css')}}" rel="stylesheet">
        <!-- ===== Custom CSS ===== -->
        <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
        <!-- ===== Color CSS ===== -->
        <link href="{{URL::asset('css/colors/black.css')}}" id="theme" rel="stylesheet">
        <link href="{{URL::asset('css/estilo.css')}}" rel="stylesheet">

        <!-- Toastr -->
        <link href="{{URL::asset('css/toastr.min.css')}}" rel="stylesheet">

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

        <!-- jQuery -->
        <script src="{{URL::asset('plugins/components/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{URL::asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="{{URL::asset('js/sidebarmenu.js')}}"></script>
        <!--slimscroll JavaScript -->
        <script src="{{URL::asset('js/jquery.slimscroll.js')}}"></script>
        <!-- Custom Theme JavaScript -->
        <script src="{{URL::asset('js/custom.js')}}"></script>
        <script src="{{URL::asset('plugins/components/switchery/dist/switchery.min.js')}}"></script>
        <script src="{{URL::asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('plugins/components/icheck/icheck.js')}}"></script>
        <script src="{{URL::asset('plugins/components/icheck/icheck.init.js')}}"></script>
        <!-- start - This is for export functionality only -->
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="{{URL::asset('plugins/components/datatables/buttons.html5.js')}}"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
        <!-- end - This is for export functionality only -->
        <!-- Moment -->
        <script src="{{URL::asset('plugins/components/moment/min/moment.min.js')}}"></script>
        <!-- Toastr -->
        <script src="{{URL::asset('js/toastr.min.js')}}" type="text/javascript"></script>
        <script>
            toastr.options.closeButton = true;
            toastr.options.preventDuplicates = true;
            toastr.options.progressBar = true;
            toastr.options.positionClass = 'toast-bottom-right';
        </script>
        {!! Toastr::render() !!}

        <!-- Start of b2flyhelp Zendesk Widget script -->
        <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=2e2e981d-d4db-4603-87ca-61debe54494f"> </script>
        <!-- End of b2flyhelp Zendesk Widget script -->

        @yield('script')
    </body>
</html>

