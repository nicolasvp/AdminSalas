@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.docente.index') }}">Docentes</a></li>
    <li class="active">Ingresar Docente</li>
@stop


@section('container')

    <div class="col-lg-12">
        <h1 class="page-header">Docente</h1>
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
                            {!! Form::open(['route' => ['administrador.docente.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input class="form-control" name="nombres" placeholder="Ej: Mauro">
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input class="form-control" name="apellidos" placeholder="Ej: Castillo">
                                </div> 
                                <div class="form-group">
                                    <label>Rut</label>
                                    <input class="form-control" name="rut" placeholder="Ej: 6671231...">
                                </div>  
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email" placeholder="Ej: mcast@utem.cl">
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

@stop