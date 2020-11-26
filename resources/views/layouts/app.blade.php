<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('plugins/images/virus.png')}}">
    <title>Davita - RH</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{URL::asset('css/app.css') }}" rel="stylesheet">
    <!-- ===== Bootstrap CSS ===== -->
    <link href="{{URL::asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/estilo-login.css')}}" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="{{URL::asset('css/colors/green-dark.css')}}" id="theme" rel="stylesheet">

</head>
<body>

    
<body class="mini-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
        @yield('content')




    <!-- Scripts -->
    <script src="{{URL::asset('js/app.js')}}" defer></script>
    <!-- jQuery -->
    <script src="{{URL::asset('plugins/components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{URL::asset('js/sidebarmenu.js')}}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{URL::asset('js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{URL::asset('js/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{URL::asset('js/custom.js')}}"></script>
    <!--Style Switcher -->
    <script src="{{URL::asset('plugins/components/styleswitcher/jQuery.style.switcher.js')}}"></script>
</body>
</html>
