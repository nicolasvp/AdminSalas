@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.escuela.index') }}">Escuelas</a></li>
    <li class="active">Ingresar Escuela</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h1 class="page-header">Escuela</h1>
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
                            {!! Form::open(['route' => ['administrador.escuela.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: Informática">
                                </div>
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <select class="form-control" name="departamento">
                                    @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Escuela de Informática">
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