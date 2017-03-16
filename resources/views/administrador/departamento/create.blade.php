@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.departamento.index') }}">Departamentos</a></li>
    <li class="active">Ingresar Departamento</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Departamento</h2>
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
                            {!! Form::open(['route' => ['administrador.departamento.upload'], 'method' => 'POST', 'files' => true]) !!}
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
                            {!! Form::open(['route' => ['administrador.departamento.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: Matemática" required>
                                </div>
                                <div class="form-group">
                                    <label>Facultad</label>
                                    <select name="facultad" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    @foreach($facultades as $facultad)
                                        <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Departamento de Matemática">
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