@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.curso.index') }}">Cursos</a></li>
    <li class="active">Ingresar Cursos</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Curso</h2>
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
                            {!! Form::open(['route' => ['administrador.curso.upload'], 'method' => 'POST', 'files' => true]) !!}
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
                            {!! Form::open(['route' => ['administrador.curso.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Asignatura</label>
                                    <select name="asignatura" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    @foreach($asignaturas as $asignatura)
                                        <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>                                    
                                <div class="form-group">
                                    <label>Docente</label>
                                    <select name="docente" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    @foreach($docentes as $docente)
                                        <option value="{{ $docente->id }}">{{ $docente->nombres }} {{ $docente->apellidos }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Semestre</label>
                                    <select class="form-control" name="semestre" required>
                                        <option value="">Seleccione</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>                                        
                                <div class="form-group">
                                    <label>Año</label>
                                    <input class="form-control" type="number" name="anio" placeholder="Ej: 2016" required>
                                </div>
                                <div class="form-group">
                                    <label>Sección</label>
                                    <input class="form-control" type="number" name="seccion" placeholder="Ej: 3" required>
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