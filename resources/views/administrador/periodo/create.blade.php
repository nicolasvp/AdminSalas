@extends('administrador/main')

@section('style')
<link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">

@stop
@section('container')

    <div class="col-lg-12">
        <h1 class="page-header">Período</h1>
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
                                <label>Archivo Excel</label>
                                <button role="button" type="submit" class="btn btn-success" style="float: right;">Subir</button>
                                <input type="file" name="file" style="float: right;"> 
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2">
                            {!! Form::open(['route' => ['periodo.store'], 'method' => 'POST']) !!}
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
@stop

@section('scripts')
<script src="{{ asset('dist/js/jquery-ui.js') }}"></script>

@stop