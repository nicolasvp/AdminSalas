@extends('encargado/main')

@section('style')
   <!-- DataTables CSS -->
    <link href="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

   <!-- DataTables Responsive CSS -->
    <link href="{{ asset('vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
@stop

@section('option')
    <li class="active">Ver Horarios</li>
@stop

@section('container')

   <div class="col-lg-12" style="padding-top: 20px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4 col-lg-4" id="horario-title">
                        <h2> Horarios </h2>
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif                                    
                    </div>
                    <div class="col-md-8 col-lg-8">
                        {!! Form::open(['route' => 'encargado.horario.display', 'method' => 'GET']) !!}
                        <div class="hidden-xs hidden-sm col-md-2 col-lg-2" style="float: right;">
                            <button type="submit" class="btn btn-success" style="margin-top:25px; float: right;">Aceptar</button>      
                        </div>
                        <div class="col-xs-12 col-md-2 col-lg-2" style="float: right;">
                            <div class="form-group">
                                <label>Bloque</label>
                                <select class="form-control" name="bloque" id="bloque">
                                    <option name="bloque" id="bloque_0" value="0">Seleccione</option>
                                    <option name="bloque" id="bloque_I" value="I">I</option>
                                    <option name="bloque" id="bloque_II" value="II">II</option>
                                    <option name="bloque" id="bloque_III" value="III">III</option>
                                    <option name="bloque" id="bloque_IV" value="IV">IV</option>
                                    <option name="bloque" id="bloque_V" value="V">V</option>
                                    <option name="bloque" id="bloque_VI" value="VI">VI</option>
                                    <option name="bloque" id="bloque_VII" value="VII">VII</option>
                                    <option name="bloque" id="bloque_VIII" value="VIII">VIII</option>  
                                    <option name="bloque" id="bloque_IX" value="IX">IX</option> 
                                </select>
                            </div> 
                        </div>
                        <div class="col-xs-12 col-md-2 col-lg-2" style="float: right;">
                            <div class="form-group">
                                <label>Día</label>
                                <select class="form-control" name="dia" id="dia">
                                    <option name="dia" id="dia_0" value="0">Seleccione</option>
                                    <option name="dia" id="dia_Lunes" value="Lunes">Lunes</option>
                                    <option name="dia" id="dia_Martes" value="Martes">Martes</option>
                                    <option name="dia" id="dia_Miercoles" value="Miercoles">Miércoles</option>
                                    <option name="dia" id="dia_Jueves" value="Jueves">Jueves</option>
                                    <option name="dia" id="dia_Viernes" value="Viernes">Viernes</option>
                                    <option name="dia" id="dia_Sabado" value="Sabado">Sábado</option>
                                </select>
                            </div>
                        </div>                                     
                        <div class="col-xs-12 col-md-2 col-lg-2" style="float: right;">
                            <div class="form-group" id="form-fecha">
                                <label>Fecha</label>
                                <input type="text" class="form-control" id="fecha" name="fecha">
                            </div>
                        </div>
                        <div class="visible-xs visible-sm col-md-2 col-lg-2" style="text-align: center">
                            <button type="submit" class="btn btn-success">Aceptar</button>      
                        </div>                                                   
                        {!! Form::close() !!}
                    </div>
               </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Bloque</th>
                            <th>Curso</th>
                            <th>Docente</th>
                            <th>Sección</th>
                            <th>Sala</th>
                            <th>Comentario</th>
                            <th>Asistencia</th>
                            <th>Cant. alumnos</th>                                        
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($horarios as $horario)
                        <tr class="text-center" data-id="{{ $horario->id }}">
                            <td class="center">{{ $horario->fecha }}</td>
                            <td class="center">{{ $horario->bloque }}</td>
                            <td class="center">{{ $horario->asignatura }}</td>
                            <td class="center">{{ $horario->nombres_docente }} {{ $horario->apellidos_docente }}</td>
                            <td class="center">{{ $horario->seccion }}</td>
                            <td class="center">{{ $horario->sala }}</td>
                            <td class="center">{{ $horario->comentario }}</td>
                            <td class="center">{{ $horario->asistencia_docente }}</td>
                            <td class="center">{{ $horario->cantidad_alumnos }}</td>
                            <td class="center"><a href="{{ route('administrador.horario.edit',$horario->id)}}"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
            <input type="hidden" id="fecha_seleccionada" value="{{ $fecha_seleccionada }}">
            <input type="hidden" id="dia_seleccionado" value="{{ $dia }}">
            <input type="hidden" id="bloque_seleccionado" value="{{ $bloque }}">
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

@stop

@section('scripts')

<!-- DataTables JavaScript -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function() {

    $('#dataTables-example').DataTable({
        responsive: true,
        "language": {
                "decimal":        "",
                "emptyTable":     "Sin datos disponibles",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered":   "(Filtrado de un total de _MAX_ entradas)",
                "infoPostFix":    "",
                "thousands":      ".",
                "lengthMenu":     "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search":         "Buscar:",
                "zeroRecords":    "Ningún registro encontrado.",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                }
            }
    });
    $("#fecha").datepicker();
    $("#fecha").datepicker('option', {dateFormat: 'dd-mm-yy'});
   
    var fecha_seleccionada = $("#fecha_seleccionada").val();
    var dia_seleccionado = $("#dia_seleccionado").val();
    var bloque_seleccionado = $("#bloque_seleccionado").val();

    if(dia_seleccionado != 0)
        $("#dia option[id='dia_"+dia_seleccionado+"']").attr('selected','selected');        
    if(bloque_seleccionado != 0)
        $("#bloque option[id='bloque_"+bloque_seleccionado+"']").attr('selected','selected'); 
    if($("#fecha").val() != null)
    $("#fecha").val(fecha_seleccionada);    

});

$("#fecha").change(function(){
   
    if($(this).val())
    {
        $("#dia").prop('disabled',true);
    }
    else
    {
        $("#dia").prop('disabled',false);
    }

});

$("#dia").change(function(){
   
    if($(this).val())
    {
        $("#fecha").prop('disabled',true);
    }
    if($(this).val() == 0)
    {
        $("#fecha").prop('disabled',false);
    }

});
</script>

@stop