@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.escuela.index') }}">Escuelas</a></li>
    <li class="active">Ingresar Escuela</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Escuela</h2>
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
                            {!! Form::open(['route' => ['administrador.escuela.upload'], 'method' => 'POST', 'files' => true]) !!}
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
                            {!! Form::open(['route' => ['administrador.escuela.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: Escuela de Informática" required>
                                </div>
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <select class="form-control" name="departamento" required>
                                        <option value="">Seleccione</option>
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
                                <a href="{{ URL::previous() }}" class="btn btn-default" role="button">Cancelar</a>
                          	{!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop