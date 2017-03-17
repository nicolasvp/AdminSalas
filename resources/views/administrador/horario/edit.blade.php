@extends('administrador/main')

@section('style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
@stop

@section('option')
    <li><a href="{{ route('administrador.horario.index') }}">Horarios</a></li>
    <li class="active">Editar Horario</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Editar Horario: #{{ $horario->id }}</h2>
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
                            {!! Form::model($horario, ['route' => ['administrador.horario.update', $horario], 'method' => 'PUT']) !!}
                              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                
                                <div class="form-group" id="form-fecha">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" id="fecha" name="fecha" required>
                                </div> 
                                <div class="form-group">
                                    <label>Curso - Docente - Sección</label>
                                    <select name="curso" id="curso" class="form-control" required>
                                      <option value="">Seleccione</option>
                                    @foreach($cursos as $curso)
                                      <option name="curso" id="curso_{{ $curso->id }}" value="{{ $curso->id }}">{{ $curso->asignatura }} - {{ $curso->docente_nombres }} {{ $curso->docente_apellidos }} - {{ $curso->seccion }}</option>
                                    @endforeach
                                    </select>
                                </div>                                      
                                <div class="form-group">
                                    <label>Sala</label>
                                   <select name="sala" id="sala" class="form-control" required>
                                      <option value="">Seleccione</option>
                                    @foreach($salas as $sala)
                                      <option name="sala" id="sala_{{ $sala->id }}" value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>                                        
                                <div class="form-group">
                                    <label>Período</label>
                                   <select name="periodo" id="periodo" class="form-control" required>
                                      <option value="">Seleccione</option>
                                    @foreach($periodos as $periodo)
                                      <option name="periodo" id="periodo_{{ $periodo->id }}" value="{{ $periodo->id }}">{{ $periodo->bloque }}</option>
                                    @endforeach
                                    </select>
                                </div> 
                                <label>Comentario</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="comentario" name="comentario" placeholder="Ej: Sala no disponible...">
                                </div> 
                                <label>Asistencia Docente</label>
                                <div class="form-group">
                                    <input type="radio" name="asistencia_docente" id="asistencia_si" value="Si"> Sí</input>
                                    <input type="radio" name="asistencia_docente" id="asistencia_no" value="No"> No</input>
                                </div> 
                                <label>Cantidad de Alumnos</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="cantidad_alumnos" name="cantidad_alumnos" placeholder="Ej: 20">
                                </div>                                                                                 
                                <input type="hidden" id="fecha_id" value="{{ $horario->fecha }}">
                                <input type="hidden" id="fecha_inicio" value="{{ $fecha_inicio }}">
                                <input type="hidden" id="fecha_termino" value="{{ $fecha_termino }}">
                                <input type="hidden" id="permanencia" value="{{ $horario->permanencia }}">
                                <input type="hidden" id="dia" value="{{ $horario->dia }}">
                                <input type="hidden" id="asistencia_docente" value="{{ $horario->asistencia_docente }}">
                                <input type="hidden" id="comentario_horario" value="{{ $horario->comentario }}">

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
<script src="{{ asset('dist/js/jquery-ui.js') }}"></script>
<script>

$(document).ready(function(){

  $("#curso option[id='curso_"+{{ $horario->curso_id }}+"']").attr('selected','selected');

  $("#docente option[id='docente_"+{{ $curso->docente_id }}+"']").attr('selected','selected');

  $("#sala option[id='sala_"+{{ $horario->sala_id }}+"']").attr('selected','selected');

  $("#periodo option[id='periodo_"+{{ $horario->periodo_id }}+"']").attr('selected','selected');

  $("#cantidad_alumnos").val({{ $horario->cantidad_alumnos }});


  if($("#asistencia_docente").val() == 'Si'){
    $("#asistencia_si").attr('checked', 'checked');;
  }
  if($("#asistencia_docente").val() == 'No'){
    $("#asistencia_no").attr('checked', 'checked');;
  }
  
  if($("#comentario_horario").val() != '')
  {
    $("#comentario").val($("#comentario_horario").val());
  }

  var dia = $("#dia").val();
  $("#"+dia).prop('checked',true);

  $("#fecha").datepicker();
  $("#fecha").datepicker('option', {dateFormat: 'dd-mm-yy'});

  var fecha = $("#fecha_id").val();
  var fecha_separada = fecha.split('-');
  var fecha_formateada = fecha_separada[2]+"-"+fecha_separada[1]+"-"+fecha_separada[0];

  $("#fecha").val(fecha_formateada);

  var opcion = $("#duracion").val();


});
</script>
@stop