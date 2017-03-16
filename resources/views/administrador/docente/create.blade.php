@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.docente.index') }}">Docentes</a></li>
    <li class="active">Ingresar Docente</li>
@stop


@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Docente</h2>
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
                            {!! Form::open(['route' => ['administrador.docente.upload'], 'method' => 'POST', 'files' => true]) !!}
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
                            {!! Form::open(['route' => ['administrador.docente.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input class="form-control" name="nombres" placeholder="Ej: Mauro" required>
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input class="form-control" name="apellidos" placeholder="Ej: Castillo" required>
                                </div> 
                                <div class="form-group">
                                    <label>Rut</label>
                                    <input class="form-control" name="rut" placeholder="Ej: 6671231..." required>
                                </div>                                                                                                  
                                <div class="form-group">
                                    <label>Departamentos</label>
                                    <select class="form-control" name="departamento" required>
                                        <option value="">Seleccione</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Aceptar</button>
                                <a href="{{ URL::previous() }}" class="btn btn-default" role="button">Cancelar</a>
                          	{!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop