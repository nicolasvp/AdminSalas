<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>..::ADMIN SALAS::..</title>

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
                <a class="navbar-brand" href="{{ asset('/administrador/inicio') }}" style="color: #fff;">
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
                        Hola, {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}
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
                            <a href="{{ asset('/administrador/inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a>
                        </li>
                        <li>
                            <a href="{{ route('administrador.horario.index') }}"><i class="fa fa-cog"></i> Horarios</a>
                        </li>   
                        <li>
                            <a href="{{ route('administrador.horario.display') }}"><i class="fa fa-cog"></i> Ver Horarios</a>
                        </li>                                                                                                          
                        <li>
                            <a href="{{ route('administrador.usuario.index') }}"><i class="fa fa-cog"></i> Usuarios</a>
                        </li>                         
                        <li>
                            <a href="#"><i class="fa fa-cog"></i> Configuración<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="{{ route('administrador.campus.index') }}"><i class="fa fa-cog"></i> Campus</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.facultad.index') }}"><i class="fa fa-cog"></i> Facultades</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.departamento.index') }}"><i class="fa fa-cog"></i> Departamentos</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.escuela.index') }}"><i class="fa fa-cog"></i> Escuelas</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.carrera.index') }}"><i class="fa fa-cog"></i> Carreras</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.asignatura.index') }}"><i class="fa fa-cog"></i> Asignaturas</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.docente.index') }}"><i class="fa fa-cog"></i> Docentes</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.curso.index') }}"><i class="fa fa-cog"></i> Cursos</a>
                                </li>     
                                <li>
                                    <a href="{{ route('administrador.rol.index') }}"><i class="fa fa-cog"></i> Roles</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.tipo_sala.index') }}"><i class="fa fa-cog"></i> Tipos Salas</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.sala.index') }}"><i class="fa fa-cog"></i> Salas</a>
                                </li>
                                <li>
                                    <a href="{{ route('administrador.periodo.index') }}"><i class="fa fa-cog"></i> Periodos</a>
                                </li>                        
                            </ul>
                        </li>                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                @yield('container')
            </div>

        </div>
        <!-- /#page-wrapper -->

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
