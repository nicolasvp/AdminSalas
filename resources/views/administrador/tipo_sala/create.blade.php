@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.tipo_sala.index') }}">Tipos de Salas</a></li>
    <li class="active">Ingresar Tipo de Sala</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Tipo de Sala</h2>
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
                            {!! Form::open(['route' => ['administrador.tipo_sala.upload'], 'method' => 'POST', 'files' => true]) !!}
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
                        <div class="col-lg-6">
                            {!! Form::open(['route' => ['administrador.tipo_sala.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: m1-201">
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Sala del Edificio m1">
                                </div>                                                                                
                                <button type="submit" class="btn btn-success">Aceptar</button>
                          	{!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop