@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.curso.index') }}">Cursos</a></li>
    <li class="active">Editar Cursos</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar Curso: {{ $nombre_curso->nombre }}</h2>
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
                        {!! Form::model($curso, ['route' => ['administrador.curso.update', $curso], 'method' => 'PUT']) !!}
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                          <div class="form-group">
                              <label>Asignaturas</label>
                              <select name="asignatura" id="asignatura" class="form-control" required>
                                <option value="">Seleccione</option>
                              @foreach($asignaturas as $asignatura)
                                  <option id="asignatura_{{ $asignatura->id }}" value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                              @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Docentes</label>
                              <select name="docente" id="docente" class="form-control" required>
                                <option value="">Seleccione</option>
                              @foreach($docentes as $docente)
                                <option id="docente_{{ $docente->id }}" value="{{ $docente->id }}">{{ $docente->nombres }} {{ $docente->apellidos }}</option>
                              @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                           {!! Form::label('semestre', 'Semestre') !!}
                           <select class="form-control" name="semestre" id="semestre" required>
                             <option value="">Seleccione</option>
                             <option value="1" id="semestre_1">1</option>
                             <option value="2" id="semestre_2">2</option>
                           </select>
                          </div>
                          <div class="form-group">
                           {!! Form::label('anio', 'Año') !!}
                           {!! Form::number('anio', null,['class' => 'form-control', 'placeholder' => 'Ej: 2016', 'required']) !!}
                          </div>
                          <div class="form-group">
                           {!! Form::label('seccion', 'Seccion') !!}
                           {!! Form::number('seccion', null,['class' => 'form-control', 'placeholder' => 'Ej: 3', 'required']) !!}
                          </div>

                          <input type="hidden" id="asignatura_id" value="{{ $curso->asignatura_id }}">
                          <input type="hidden" id="docente_id" value="{{ $curso->docente_id }}">

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

@section('scripts')
<script>
$(document).ready(function(){

  var asignatura_id = $("#asignatura_id").val();

  $("#asignatura option[id='asignatura_"+asignatura_id+"']").attr('selected','selected');


  var docente_id = $("#docente_id").val();

  $("#docente option[id='docente_"+docente_id+"']").attr('selected','selected');

  $("#semestre option[id='semestre_"+{{ $semestre }}+"']").attr('selected','selected');

});
</script>
@stop