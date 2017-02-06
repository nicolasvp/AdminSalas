@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.asignatura.index') }}">Asignaturas</a></li>
    <li class="active">Ingresar Asignatura</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h1 class="page-header">Asignatura</h1>
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
                            {!! Form::open(['route' => ['administrador.asignatura.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: Ingeniería de Software">
                                </div>
                                <div class="form-group">
                                    <label>Código</label>
                                    <input class="form-control" name="codigo" placeholder="Ej: INF-2134">
                                </div> 
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Asignatura orientada a la creacion y gestion...">
                                </div>                                                                                
                                <div class="form-group">
                                    <label>Departamentos</label>
                                    <select class="form-control" name="departamento">
                                    @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
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