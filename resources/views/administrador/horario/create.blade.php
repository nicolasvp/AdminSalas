@extends('administrador/main')

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
                                <div class="col-lg-6">
                                    {!! Form::open(['route' => ['administrador.horario.store'], 'method' => 'POST']) !!}
                                     <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                        <div class="form-group">
                                            <label>Duración</label>
                                            <select name="duracion" id="duracion" class="form-control">
                                                <option name="duracion" value="0">Seleccione</option>
                                                <option name="duracion" value="semestral">Semestral</option>
                                                <option name="duracion" value="dia">Día</option>
                                            </select>
                                        </div>                                        
                                        <div class="form-group" id="form-fecha" style="display:none;">
                                            <label>Fecha</label>
                                            <input type="text" class="form-control" id="fecha" name="fecha">
                                        </div>
                                        <div class="form-group" id="form-fecha-ini" style="display:none;">
                                            <label>Fecha Inicio</label>
                                            <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                        </div>
                                        <div class="form-group" id="form-fecha-term" style="display:none;">
                                            <label>Fecha Término</label>
                                            <input type="text" class="form-control" id="fecha_termino" name="fecha_termino">
                                        </div>
                                        <div class="form-group">
                                            <label>Día</label>
                                            <br>
                                                <input type="checkbox" name="dias[]" id="lunes" value="lunes">Lunes
                                         
                                                <input type="checkbox" name="dias[]" id="martes" value="martes">Martes
                                          
                                                <input type="checkbox" name="dias[]" id="miercoles" value="miercoles">Miércoles
                                            
                                                <input type="checkbox" name="dias[]" id="jueves" value="jueves">Jueves
                                          
                                                <input type="checkbox" name="dias[]" id="viernes" value="viernes">Viernes
                                           
                                                <input type="checkbox" name="dias[]" id="sabado" value="sabado">Sábado        
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
                                        <label>Comentario</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="comentario" placeholder="Ej: Sala no disponible...">
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
    $("#fecha_inicio").datepicker();
    $("#fecha_inicio").datepicker('option', {dateFormat: 'dd-mm-yy'});
    $("#fecha_termino").datepicker();
    $("#fecha_termino").datepicker('option', {dateFormat: 'dd-mm-yy'});

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


});
</script>
@stop