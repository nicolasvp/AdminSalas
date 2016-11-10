@extends('main')

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
                                    {!! Form::model($horario, ['route' => ['horario.update', $horario], 'method' => 'PUT']) !!}
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                                      <div class="form-group"> 
                                       <input class="form-control" name="fecha" type="text" id="fecha">    
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

                                        <input type="hidden" id="curso_id" value="{{ $horario->curso_id }}">
                                        <input type="hidden" id="docente_id" value="{{ $curso->docente_id }}">
                                        <input type="hidden" id="sala_id" value="{{ $horario->sala_id }}">                              
                                        <input type="hidden" id="periodo_id" value="{{ $horario->periodo_id }}">
                                        <input type="hidden" id="fecha_id" value="{{ $horario->fecha }}">

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

  var curso_id = $("#curso_id").val();
  $("#curso option[id='curso_"+curso_id+"']").attr('selected','selected');

  var docente_id = $("#docente_id").val();
  console.log(docente_id);
  $("#docente option[id='docente_"+docente_id+"']").attr('selected','selected');

  var sala_id = $("#sala_id").val();
  $("#sala option[id='sala_"+sala_id+"']").attr('selected','selected');

  var periodo_id = $("#periodo_id").val();
  $("#periodo option[id='periodo_"+periodo_id+"']").attr('selected','selected');

  $("#fecha").datepicker();
  $("#fecha").datepicker('option', {dateFormat: 'dd-mm-yy'});

  var fecha = $("#fecha_id").val();
  var fecha_separada = fecha.split('-');
  var fecha_formateada = fecha_separada[2]+"-"+fecha_separada[1]+"-"+fecha_separada[0];

  $("#fecha").val(fecha_formateada);

});
</script>
@stop