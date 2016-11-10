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
    <link href="<?php echo e(asset('/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo e(asset('/vendor/metisMenu/metisMenu.min.css')); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo e(asset('/dist/css/sb-admin-2.css')); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo e(asset('/vendor/morrisjs/morris.css')); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo e(asset('/vendor/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">


    <?php echo $__env->yieldContent('style'); ?>
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
                <a class="navbar-brand" href="/" style="color: #fff;">
               <small>
                <img src="<?php echo e(asset('img/utemcito-blanco-sintitulo.png')); ?>" height="27px">
                UTEM
                </small>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #fff;">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #fff;">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user" >
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo e(asset('/login')); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo e(asset('/')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('campus.index')); ?>"><i class="fa fa-cog"></i> Campus</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('facultad.index')); ?>"><i class="fa fa-cog"></i> Facultades</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('departamento.index')); ?>"><i class="fa fa-cog"></i> Departamentos</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('escuela.index')); ?>"><i class="fa fa-cog"></i> Escuelas</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('carrera.index')); ?>"><i class="fa fa-cog"></i> Carreras</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('asignatura.index')); ?>"><i class="fa fa-cog"></i> Asignaturas</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('docente.index')); ?>"><i class="fa fa-cog"></i> Docentes</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('curso.index')); ?>"><i class="fa fa-cog"></i> Cursos</a>
                        </li>     
                        <li>
                            <a href="<?php echo e(route('rol.index')); ?>"><i class="fa fa-cog"></i> Roles</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('tipo_sala.index')); ?>"><i class="fa fa-cog"></i> Tipos Salas</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('sala.index')); ?>"><i class="fa fa-cog"></i> Salas</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('periodo.index')); ?>"><i class="fa fa-cog"></i> Periodos</a>
                        </li>                        
                        <li>
                            <a href="<?php echo e(route('horario.index')); ?>"><i class="fa fa-cog"></i> Horarios</a>
                        </li>                                                                                            
                        <li>
                            <a href="<?php echo e(route('usuario.index')); ?>"><i class="fa fa-cog"></i> Usuarios</a>
                        </li> 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">

                <?php echo $__env->yieldContent('container'); ?>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo e(asset('/vendor/jquery/jquery.min.js')); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(asset('/vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo e(asset('/vendor/metisMenu/metisMenu.min.js')); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo e(asset('/vendor/raphael/raphael.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendor/morrisjs/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/data/morris-data.js')); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo e(asset('/dist/js/sb-admin-2.js')); ?>"></script>

    <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
