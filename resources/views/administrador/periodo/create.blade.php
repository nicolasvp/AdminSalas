@extends('administrador/main')

@section('style')
    <link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">
@stop

@section('option')
    <li><a href="{{ route('administrador.periodo.index') }}">Períodos</a></li>
    <li class="active">Ingresar Período</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Período</h2>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <h4> Ingrese los datos </h4>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            {!! Form::open(['route' => ['administrador.periodo.upload'], 'method' => 'POST', 'files' => true]) !!}
                             <div class="form-group" style="float:right;">
	                            <label>Archivo Excel</label>
	                            <button role="button" type="submit" class="btn btn-success" style="float: right;">Subir</button>
	                            <input type="file" name="file" class="filestyle"> 
	                        </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2">
                            {!! Form::open(['route' => ['administrador.periodo.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Bloque</label>
                                    <input class="form-control" name="bloque" placeholder="Ej: I">
                                </div>
                                <div class="form-group">
                                    <label>Inicio</label>
                                    <input class="form-control" type="time" id="inicio" name="inicio" required>
                                </div>    
                                <div class="form-group">
                                    <label>Fin</label>
                                    <input class="form-control" type="time" id="fin" name="fin" required>
                                </div>                                                                                                                    
                                <button role="button" type="submit" class="btn btn-success">Aceptar</button>
                          	{!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
<script src="{{ asset('dist/js/jquery-ui.js') }}"></script>
<!--script src="{{ URL::asset('js/bootstrap-filestyle.min.js') }}"></script-->

<!--script type="text/javascript">
	$(":file").filestyle();
</script-->
@stop