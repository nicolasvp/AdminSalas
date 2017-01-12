@extends('administrador/main')

@section('style')
<link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">
@stop

@section('container')

            <div class="col-lg-12">
                <h1 class="page-header">Editar Horario</h1>
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
                                        <div class="form-group">
                                            <label>Duración</label>
                                            <select name="duracion" id="duracion" class="form-control">
                                                <option name="duracion" value="0">Seleccione</option>
                                                <option name="duracion" id="duracion_semestral" value="semestral">Semestral</option>
                                                <option name="duracion" id="duracion_dia" value="dia">Día</option>
                                            </select>
                                        </div>                                        
                                        <div class="form-group" id="form-fecha" style="display:none;">
                                            <label>Fecha</label>
                                            <input type="text" class="form-control" id="fecha" name="fecha">
                                        </div>
                                        <div class="form-group" id="form-fecha-ini" style="display:none;">
                                            <label>Fecha Inicio</label>
                                            <input type="text" class="form-control" id="fecha_ini" name="fecha_inicio">
                                        </div>
                                        <div class="form-group" id="form-fecha-term" style="display:none;">
                                            <label>Fecha Término</label>
                                            <input type="text" class="form-control" id="fecha_term" name="fecha_termino">
                                        </div>
                                        <div class="form-group">
                                            <label>Día</label>
                                            <br>
                                            <label class="radio-inline">
                                                <input type="radio" name="dia" id="lunes" value="lunes">Lunes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="dia" id="martes" value="martes">Martes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="dia" id="miercoles" value="miercoles">Miércoles
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="dia" id="jueves" value="jueves">Jueves
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="dia" id="viernes" value="viernes">Viernes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="dia" id="sabado" value="sabado">Sábado
                                            </label>                                            
                                        </div>  
                                      <div class="form-group">
                                          <label>Curso - Sección</label>
                                          <select name="curso" id="curso" class="form-control">
                                          @foreach($cursos as $curso)
                                              <option name="curso" id="curso_{{ $curso->id }}" value="{{ $curso->id }}">{{ $curso->asignatura }} - {{ $curso->seccion }}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Docente</label>
                                          <select name="docente" id="docente" class="form-control">
                                          @foreach($docentes as $docente)
                                              <option name="docente" id="docente_{{ $docente->id }}" value="{{ $docente->id }}">{{ $docente->nombres }} {{ $docente->apellidos }}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                        <div class="form-group">
                                            <label>Sala</label>
                                           <select name="sala" id="sala" class="form-control">
                                            @foreach($salas as $sala)
                                                <option name="sala" id="sala_{{ $sala->id }}" value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Período</label>
                                           <select name="periodo" id="periodo" class="form-control">
                                            @foreach($periodos as $periodo)
                                                <option name="periodo" id="periodo_{{ $periodo->id }}" value="{{ $periodo->id }}">{{ $periodo->bloque }}</option>
                                            @endforeach
                                            </select>
                                        </div> 
                                        <label>Comentario</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="comentario" placeholder="Ej: Sala no disponible...">
                                        </div> 
                                        <label>Asistencia Docente</label>
                                        <div class="form-group">
                                            <input type="radio" name="asistencia_docente" id="asistencia_si" value="si"> Sí</input>
                                            <input type="radio" name="asistencia_docente" id="asistencia_no" value="no"> No</input>
                                        </div> 
                                        <label>Cantidad de Alumnos</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cantidad_alumnos" placeholder="Ej: 20">
                                        </div>                                                                                 
                                        <input type="hidden" id="curso_id" value="{{ $horario->curso_id }}">
                                        <input type="hidden" id="docente_id" value="{{ $curso->docente_id }}">
                                        <input type="hidden" id="sala_id" value="{{ $horario->sala_id }}">                              
                                        <input type="hidden" id="periodo_id" value="{{ $horario->periodo_id }}">
                                        <input type="hidden" id="fecha_id" value="{{ $horario->fecha }}">
                                        <input type="hidden" id="fecha_inicio" value="{{ $fecha_inicio }}">
                                        <input type="hidden" id="fecha_termino" value="{{ $fecha_termino }}">
										                    <input type="hidden" id="permanencia" value="{{ $horario->permanencia }}">
										                    <input type="hidden" id="dia" value="{{ $horario->dia }}">

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

$("#duracion").change(function(){

    var opcion = $(this).val();

    if(opcion == 'semestral'){
        $("#form-fecha").css('display','none'); 
        $("#form-fecha-ini").css('display','block'); 
        $("#form-fecha-term").css('display','block'); 
        return;
    }
    if(opcion == 'dia'){
        $("#form-fecha-ini").css('display','none'); 
        $("#form-fecha-term").css('display','none');
        $("#form-fecha").css('display','block');
        return; 
    }

        $("#form-fecha").css('display','none'); 
        $("#form-fecha-ini").css('display','none'); 
        $("#form-fecha-term").css('display','none'); 

});

$(document).ready(function(){

  var curso_id = $("#curso_id").val();
  $("#curso option[id='curso_"+curso_id+"']").attr('selected','selected');

  var docente_id = $("#docente_id").val();
  $("#docente option[id='docente_"+docente_id+"']").attr('selected','selected');

  var sala_id = $("#sala_id").val();
  $("#sala option[id='sala_"+sala_id+"']").attr('selected','selected');

  var periodo_id = $("#periodo_id").val();
  $("#periodo option[id='periodo_"+periodo_id+"']").attr('selected','selected');

  var permanencia = $("#permanencia").val();
  $("#duracion option[id='duracion_"+permanencia+"']").attr('selected','selected');

  var dia = $("#dia").val();
  $("#"+dia).prop('checked',true);



  $("#fecha").datepicker();
  $("#fecha").datepicker('option', {dateFormat: 'dd-mm-yy'});
  $("#fecha_ini").datepicker();
  $("#fecha_ini").datepicker('option', {dateFormat: 'dd-mm-yy'});
  $("#fecha_term").datepicker();
  $("#fecha_term").datepicker('option', {dateFormat: 'dd-mm-yy'});

  var fecha = $("#fecha_id").val();
  var fecha_separada = fecha.split('-');
  var fecha_formateada = fecha_separada[2]+"-"+fecha_separada[1]+"-"+fecha_separada[0];

  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_inicio_separada = fecha_inicio.split('-');
  var fecha_inicio_formateada = fecha_inicio_separada[2]+"-"+fecha_inicio_separada[1]+"-"+fecha_inicio_separada[0];

  var fecha_termino = $("#fecha_termino").val();
  var fecha_termino_separada = fecha_termino.split('-');
  var fecha_termino_formateada = fecha_termino_separada[2]+"-"+fecha_termino_separada[1]+"-"+fecha_termino_separada[0];


  $("#fecha_ini").val(fecha_inicio_formateada);
  $("#fecha_term").val(fecha_termino_formateada);

  $("#fecha").val(fecha_formateada);

	var opcion = $("#duracion").val();

	if(opcion == 'semestral'){
	    $("#form-fecha").css('display','none'); 
	    $("#form-fecha-ini").css('display','block'); 
	    $("#form-fecha-term").css('display','block'); 
	    return;
	}
	if(opcion == 'dia'){
	    $("#form-fecha-ini").css('display','none'); 
	    $("#form-fecha-term").css('display','none');
	    $("#form-fecha").css('display','block');
	    return; 
	}

	    $("#form-fecha").css('display','none'); 
	    $("#form-fecha-ini").css('display','none'); 
	    $("#form-fecha-term").css('display','none');







});
</script>
@stop