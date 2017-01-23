@extends('alumno/main')

@section('style')
   <!-- DataTables CSS -->
    <link href="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

   <!-- DataTables Responsive CSS -->
    <link href="{{ asset('vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@stop

@section('container')

                <div class="col-lg-12" style="padding-top: 20px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <h4> Horarios </h4>                                   
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    {!! Form::open(['route' => 'alumno.horario', 'method' => 'GET']) !!}
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Día</label>
                                            <select class="form-control" name="dia">
                                                <option name="dia" value="Lunes">Lunes</option>
                                                <option name="dia" value="Martes">Martes</option>
                                                <option name="dia" value="Miercoles">Miércoles</option>
                                                <option name="dia" value="Jueves">Jueves</option>
                                                <option name="dia" value="Viernes">Viernes</option>
                                                <option name="dia" value="Sabado">Sábado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label>Bloque</label>
                                            <select class="form-control" name="bloque">
                                                <option name="bloque" value="I">I</option>
                                                <option name="bloque" value="II">II</option>
                                                <option name="bloque" value="III">III</option>
                                                <option name="bloque" value="IV">IV</option>
                                                <option name="bloque" value="V">V</option>
                                                <option name="bloque" value="VI">VI</option>
                                                <option name="bloque" value="VII">VII</option>
                                                <option name="bloque" value="VIII">VIII</option>  
                                                <option name="bloque" value="IX">IX</option> 
                                            </select>
                                        </div> 
                                    </div> 
                                    <button type="submit" class="btn btn-success">Aceptar</button>                                   
                                    {!! Form::close() !!}
                                </div>
                           </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Bloque</th>
                                        <th>Curso</th>
                                        <th>Docente</th>
                                        <th>Sección</th>
                                        <th>Sala</th>
                                        <th>Comentario</th>
                                        <th>Asistencia</th>
                                        <th>Cant. alumnos</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($horarios as $horario)
                                    <tr class="text-center" data-id="{{ $horario->id }}">
                                        <td class="center">{{ $horario->bloque }}</td>
                                        <td class="center">{{ $horario->asignatura }}</td>
                                        <td class="center">{{ $horario->nombres_docente }} {{ $horario->apellidos_docente }}</td>
                                        <td class="center">{{ $horario->seccion }}</td>
                                        <td class="center">{{ $horario->sala }}</td>
                                        <td class="center">{{ $horario->comentario }}</td>
                                        <td class="center">{{ $horario->asistencia_docente }}</td>
                                        <td class="center">{{ $horario->cantidad_alumnos }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
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
   
});
</script>

@stop