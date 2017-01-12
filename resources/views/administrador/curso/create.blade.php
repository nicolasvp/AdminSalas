@extends('administrador/main')

@section('container')



            <div class="col-lg-12">
                <h1 class="page-header">Curso</h1>
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
                                    {!! Form::open(['route' => ['administrador.curso.store'], 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            <label>Asignatura</label>
                                            <select name="asignatura" class="form-control">
                                            @foreach($asignaturas as $asignatura)
                                                <option name="asignatura" value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>                                    
                                        <div class="form-group">
                                            <label>Docente</label>
                                            <select name="docente" class="form-control">
                                            @foreach($docentes as $docente)
                                                <option name="docente" value="{{ $docente->id }}">{{ $docente->nombres }} {{ $docente->apellidos }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Semestre</label>
                                            <input class="form-control" name="semestre" placeholder="Ej: 1">
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Año</label>
                                            <input class="form-control" name="anio" placeholder="Ej: 2">
                                        </div>
                                        <div class="form-group">
                                            <label>Seccion</label>
                                            <input class="form-control" name="seccion" placeholder="Ej: 3">
                                        </div>                                        
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                  	{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@stop