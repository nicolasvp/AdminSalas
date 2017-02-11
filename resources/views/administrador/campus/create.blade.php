@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.campus.index') }}">Campus</a></li>
    <li class="active">Ingresar Campus</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Campus</h2>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Ingrese los datos </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::open(['route' => ['administrador.campus.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: Macul">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="direccion" placeholder="Ej: Jose Pedro Alessandri #123">
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Campus de Ingenieria y Ciencias..">
                                </div>
                                <div class="form-group">
                                    <label>Rut Encargado</label>
                                    <select class="form-control" name="encargado" id="encargado">
                                        @foreach($encargados as $encargado)
                                        <option name="encargado" value="{{ $encargado->rut }}">{{ $encargado->rut }}</option>
                                        @endforeach
                                    </select>
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