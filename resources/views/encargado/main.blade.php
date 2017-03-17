<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/40px-utemcito-azul.png') }}"/>

    <title>..:: ENCARGADO SALAS ::..</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!--link href="{{ asset('css/salas.css') }}" rel="stylesheet" type="text/css"-->
    @yield('style')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<style>
a {
	color: #585858;
}
.btn {
	border-radius: 0px;
}
@media (max-width: 768px) {

    #user-rol {
        margin-top: 15px;
        left: 15px;
    }
    #user-info {
        float: right;
        margin-right: 0px;        
    }  
    .new-sm {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
    } 
    #horario-title {
        text-align: center;
    }     
}
@media (min-width: 768px) {

    #user-rol {
        margin-top: 15px;
        left: 0px;
    }
    #user-info {
        float: right;
        margin-right: 15px;
    }      
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
                <a class="navbar-brand" href="{{ asset('/encargado/inicio') }}" style="color: #fff;">
               <small style="font-size: 27px">
                <img src="{{ asset('img/utemcito-blanco-sintitulo.png') }}" height="27px">
                UTEM
                </small>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown" id="user-rol" style="color: #fff;">  
                    <b>{{ $rol }} : @if($campus != ''){{ $campus }}@else Sin Campus Asignado @endif</b>
                </li>
                <li class="dropdown" id="user-info">

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
                            <a href="{{ asset('/encargado/inicio') }}"><i class="fa fa-home"></i> Inicio</a>
                        </li>
                        <li>
                            <a href="{{ route('encargado.horario.index') }}"><i class="fa fa-calendar-o"></i> Ingresar Horarios</a>
                        </li>   
                        <li>
                            <a href="{{ route('encargado.horario.display') }}"><i class="fa fa-eye"></i> Ver Horarios</a>
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-globe"></i> Accesos Directos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                <a target="_blank" href="https://www.utem.cl/">Página UTEM</a>
                                <a target="_blank" href="http://postulacion.utem.cl/">DirDoc</a>
                                <a target="_blank" href="http://reko.utem.cl/portal/">Reko</a>
                                <a target="_blank" href="http://biblioteca.utem.cl/">Catálogo Biblioteca</a>
                                <a target="_blank" href="http://bienestarestudiantil.blogutem.cl/">Bienestar Estudiantil</a>
                                <a target="_blank" href="http://validacion.utem.cl/">Validación Certificados</a>
                                </li>
                            </ul>
                        </li>                                                                                                              
                        <li>
                            <a href="{{ route('encargado.contacto.index') }}"><i class="fa fa-send"></i> Contáctanos</a>                 
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
                            <i class="fa fa-home"></i><a href="{{ asset('/encargado/inicio') }}"> Inicio</a>
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

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/dist/js/sb-admin-2.js') }}"></script>

    @yield('scripts')

</body>

</html>
