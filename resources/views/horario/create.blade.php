@extends('main')

@section('style')
<link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">
@stop


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
                                <div class="col-lg-4">
                                    {!! Form::open(['route' => ['horario.store'], 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input type="text" class="form-control" id="fecha" name="fecha">
                                        </div>
                                        <div class="form-group">
                                            <label>Curso - Sección</label>
                                            <select name="curso" class="form-control">
                                            @foreach($cursos as $curso)
                                                <option name="curso" value="{{ $curso->id }}">{{ $curso->asignatura }} - {{ $curso->seccion }}</option>
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
                                            <label>Sala</label>
                                           <select name="sala" class="form-control">
                                            @foreach($salas as $sala)
                                                <option name="sala" value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Período</label>
                                           <select name="periodo" class="form-control">
                                            @foreach($periodos as $periodo)
                                                <option name="periodo" value="{{ $periodo->id }}">{{ $periodo->bloque }}</option>
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

@section('scripts')
<script src="{{ asset('dist/js/jquery-ui.js') }}"></script>
<script>
$(document).ready(function(){
    $("#fecha").datepicker();
    $("#fecha").datepicker('option', {dateFormat: 'dd-mm-yy'});
});
</script>
@stop