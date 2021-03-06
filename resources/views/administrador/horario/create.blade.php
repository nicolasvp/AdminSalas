@extends('administrador/main')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
@stop

@section('option')
    <li><a href="{{ route('administrador.horario.index') }}">Horarios</a></li>
    <li class="active">Ingresar Horario</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Horario</h2>
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
                                    <select name="duracion" id="duracion" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        <option value="semestral">Semestral</option>
                                        <option value="dia">Día</option>
                                    </select>
                                </div>                                        
                                <div class="form-group" id="form-fecha" style="display: none;">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" id="fecha" name="fecha">
                                </div>
                                <div class="form-group" id="form-fecha-ini" style="display: none;">
                                    <label>Fecha Inicio</label>
                                    <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                </div>
                                <div class="form-group" id="form-fecha-term" style="display: none;">
                                    <label>Fecha Término</label>
                                    <input type="text" class="form-control" id="fecha_termino" name="fecha_termino">
                                </div>
                                <div class="form-group" id="form-dias" style="display: none;">
                                    <label>Día</label>
                                    <br>
                                        <input type="checkbox" name="dias[]" id="lunes" value="Lunes">Lunes
                                 
                                        <input type="checkbox" name="dias[]" id="martes" value="Martes">Martes
                                  
                                        <input type="checkbox" name="dias[]" id="miercoles" value="Miercoles">Miércoles
                                    
                                        <input type="checkbox" name="dias[]" id="jueves" value="Jueves">Jueves
                                  
                                        <input type="checkbox" name="dias[]" id="viernes" value="Viernes">Viernes
                                   
                                        <input type="checkbox" name="dias[]" id="sabado" value="Sabado">Sábado        
                                </div>                                                                                                                     
                                <div class="form-group">
                                    <label>Curso - Docente - Sección</label>
                                    <select name="curso" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    @foreach($cursos as $curso)
                                        <option name="curso" value="{{ $curso->id }}">{{ $curso->asignatura }} - {{ $curso->docente_nombres }} {{ $curso->docente_apellidos }} - {{ $curso->seccion }}</option>
                                    @endforeach
                                    </select>
                                </div>                                    
                                <div class="form-group">
                                    <label>Sala</label>
                                   <select name="sala" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    @foreach($salas as $sala)
                                        <option name="sala" value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>                                        
                                <div class="form-group">
                                    <label>Período</label>
                                   <select name="periodo" class="form-control" required>
                                        <option value="">Seleccione</option>
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
            $("#form-dias").css('display','block');
            return;
        }
        if(opcion == 'dia'){
            $("#form-fecha-ini").css('display','none'); 
            $("#form-fecha-term").css('display','none');
            $("#form-dias").css('display','none');
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