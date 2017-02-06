<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/40px-utemcito-azul.png') }}"/>

    <title>..:: DOCENTE SALAS ::..</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('/vendor/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!--link href="{{ asset('css/salas.css') }}" rel="stylesheet" type="text/css"-->
    @yield('style')


</head>

<body>
<style>
a {
	color: #585858;
}
.btn {
	border-radius: 0px;
}
</style>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #438eb9;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('docente..index') }}" style="color: #fff;">
               <small style="font-size: 27px">
                <img src="{{ asset('img/utemcito-blanco-sintitulo.png') }}" height="27px">
                UTEM
                </small>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown" style="color: #fff;">  
                    <b>{{ $rol }}</b>
                </li>
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #fff;">
                        <i class="fa fa-user fa-fw"></i>
                        Hola,
                        @foreach(explode(' ', Auth::user()->nombres) as $nombre) 
                            {{ $nombre }}
                            @break;
                        @endforeach                         
                    </a>
                    <ul class="dropdown-menu dropdown-user" >
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search" style="text-align: center;">
                            <span><b>MENÚ</b></span>
                        </li>
                        <li>
                            <a href="{{ route('docente..index') }}"><i class="fa fa-home"></i> Inicio</a>
                        </li>
                        <li>
                            <a href="{{ route('docente.horario') }}"><i class="fa fa-eye"></i> Ver Horarios</a>
                        </li>  
                        <li>
                            <a href="{{ route('contacto.index') }}"><i class="fa fa-send"></i> Contáctanos</a>                 
                        </li>                                                                                                 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row" style="margin-right: 0px; margin-left: 0px;">
                <div class="breadcrumbs" id="breadcrumbs">
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i><a href="{{ route('docente..index') }}"> Inicio</a>
                        </li>
                        @yield('option')
                    </ol>
                </div>    
                @yield('container')
            </div>
        </div>
        <!-- /#page-wrapper -->
        @include('layouts/footer')
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('/vendor/metisMenu/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/vendor/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('/data/morris-data.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/dist/js/sb-admin-2.js') }}"></script>

    @yield('scripts')

</body>

</html>
